<?php

namespace Core\Extension\Infrastructure\Repositories;

use App\Models\ExtensionModel;
use Core\Extension\Domain\Entities\Extension;
use Core\Extension\Domain\Repositories\ExtensionRepositoryInterface;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use ZipArchive;

class EloquentExtensionRepository implements ExtensionRepositoryInterface
{
    protected string $extensionsPath;

    public function __construct()
    {
        $this->extensionsPath = base_path('extensions');
    }
    public function update(Extension $entity): ?Extension
    {
        ExtensionModel::where('id', $entity->id)->update($entity->toArray());
        return $entity;
    }
    /**
     * Upload zip & extract extension
     */
    public function create(array $data): ?Extension
    {
        /** @var UploadedFile $file */
        $file = $data['file'] ?? null;
        $originalName = $file->getClientOriginalName();
        $directory = pathinfo($originalName, PATHINFO_FILENAME);
        if (!$file instanceof UploadedFile) {
            Log::info('Extension file is required');
            return null;
        }

        // Ensure extensions directory exists
        File::ensureDirectoryExists($this->extensionsPath);

        // Store zip temporarily
        $zipPath = $file->storeAs(
            'extensions/tmp',
            $originalName,
            'local'
        );

        $fullZipPath = storage_path('app/private/' . $zipPath);

        if (!file_exists($fullZipPath)) {
            Log::info('Zip file not found at: ' . $fullZipPath);
            return null;
        }

        $zip = new ZipArchive();

        if ($zip->open($fullZipPath) !== true) {
            Log::info('Cannot open extension zip file');
            return null;
        }
        $zip->extractTo($this->extensionsPath);
        $zip->close();
        File::delete($fullZipPath);
        /**
         * Save DB and run setup
         */
        $manifestPath = $this->extensionsPath . '/' . $directory . '/extension.json';
        if (!File::exists($manifestPath)) {
            return null;
        }

        $manifest = json_decode(
            File::get($manifestPath),
            true,
            512,
            JSON_THROW_ON_ERROR
        );

        $entity = Extension::fromArray($manifest);
        ExtensionModel::updateOrInsert([
            'name' => $entity->name,
        ], [
            'name' => $entity->name,
            'version' => $entity->version,
            'directory' => $directory,
            'status' => $entity->status,
            'author' => $entity->author,
            'email' => $entity->email,
            'support_version' => $entity->support_version,
            'verified' => $entity->verified,
            'icon' => $entity->icon,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        return $entity;
    }

    /**
     * Scan extensions directory & load extension.json
     */
    public function index(array $data = []): array
    {
        return ExtensionModel::paginate(15)->toArray();
    }

    public function all(): array
    {
        /**
         * Because this function will run at provider core, so if in first setup will is not yet connect DB
         */
        try {
            DB::connection()->getPdo();
            return ExtensionModel::get()->toArray();
        } catch (\Throwable $e) {
            return [];
        }
    }

    /**
     * Delete extension folder
     */
    public function delete(Extension $entity): ?Extension
    {
        ExtensionModel::where('id', $entity->id)->delete();
        $directory = $entity->directory;

        $extensionPath = $this->extensionsPath . '/' . $directory;

        // Delete extension directory
        if (File::exists($extensionPath)) {
            File::deleteDirectory($extensionPath);
        }
        return $entity;
    }
    public function findById(array $data): ?Extension
    {
        $row = ExtensionModel::where('id', $data['id'])->first()?->toArray();
        if (!$row) {
            return null;
        }
        return Extension::fromArray($row);
    }
    /**
     * Only insert DB, because extension make manual 
     */
    public function make(Extension $entity): Extension
    {

        ExtensionModel::updateOrInsert([
            'name' => $entity->name,
        ], [
            'name' => $entity->name,
            'version' => $entity->version,
            'directory' => $entity->directory,
            'status' => $entity->status,
            'author' => $entity->author,
            'email' => $entity->email,
            'support_version' => $entity->support_version,
            'verified' => $entity->verified,
            'icon' => $entity->icon,
            'created_at' => date('Y-m-d H:i:s', time()),
            'updated_at' => date('Y-m-d H:i:s', time())
        ]);
        return $entity;
    }
}

<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class GenerateJwtKeys extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'jwt:generate-keys {--force : Overwrite existing keys}';

    /**
     * The console command description.
     */
    protected $description = 'Generate RSA key pair (private and public) for JWT RS256';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $privateKeyPath = storage_path('keys/jwt-private.pem');
        $publicKeyPath = storage_path('keys/jwt-public.pem');

        if (file_exists($privateKeyPath) || file_exists($publicKeyPath)) {
            if (!$this->option('force')) {
                $this->warn('JWT keys already exist. Use --force to overwrite.');
                return;
            }
            unlink($privateKeyPath);
            unlink($publicKeyPath);
        }

        // 🔐 Generate RSA private key (2048 bits)
        $keyPair = openssl_pkey_new([
            'private_key_bits' => 2048,
            'private_key_type' => OPENSSL_KEYTYPE_RSA,
        ]);

        // Export private key
        openssl_pkey_export($keyPair, $privateKey);

        // Get public key
        $publicKeyDetails = openssl_pkey_get_details($keyPair);
        $publicKey = $publicKeyDetails['key'];

        // Ensure folder exists
        if (!is_dir(dirname($privateKeyPath))) {
            mkdir(dirname($privateKeyPath), 0755, true);
        }

        // Save keys
        file_put_contents($privateKeyPath, $privateKey);
        file_put_contents($publicKeyPath, $publicKey);

        $this->info('✅ RSA keys generated successfully!');
        $this->line('Private: ' . $privateKeyPath);
        $this->line('Public : ' . $publicKeyPath);
    }
}

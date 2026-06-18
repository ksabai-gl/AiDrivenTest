<?php 
namespace Core\Extension\Domain\Supports;

use Core\Extension\Application\DTOs\ExtensionInstallPlan;
use Core\Extension\Domain\Entities\Extension;

interface ExtensionInstall
{
    public function installPlan(Extension $extension): ExtensionInstallPlan;

    public function uninstallPlan(Extension $extension): ExtensionInstallPlan;
}

<?php 
namespace Core\Extension\Domain\Supports;

use Core\Extension\Application\DTOs\ExtensionInstallPlan;

interface ExtensionInstallExecutor {
    function execute(ExtensionInstallPlan $plan);
}
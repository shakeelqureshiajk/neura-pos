<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use App\Events\Installer\LaravelInstallerFinished;
use App\Services\Installer\EnvironmentManager;
use App\Services\Installer\FinalInstallManager;
use App\Services\Installer\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param \App\Services\Installer\InstalledFileManager $fileManager
     * @param \App\Services\Installer\FinalInstallManager $finalInstall
     * @param \App\Services\Installer\EnvironmentManager $environment
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager, FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $this->updateInstallationStatus();
        $finalMessages = $finalInstall->runFinal();
        $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        event(new LaravelInstallerFinished);

        return view('vendor.installer.finished', compact('finalMessages', 'finalStatusMessage', 'finalEnvFile'));
    }

    public function updateInstallationStatus()
    {
        // Path to .env file
        $dotEnvPath = base_path('.env');

        // Get contents of file
        $content = file_get_contents($dotEnvPath);

        // Update specific variable
        $content = preg_replace('/^INSTALLATION_STATUS=(.*)$/m', 'INSTALLATION_STATUS=true', $content);

        // Write updated content back to file
        file_put_contents($dotEnvPath, $content);

    }
}

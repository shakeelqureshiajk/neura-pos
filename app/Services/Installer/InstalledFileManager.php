<?php

namespace App\Services\Installer;

use Illuminate\Support\Facades\Log;

class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return int
     */
    public function create()
    {
        $installedLogFile = storage_path('installed');

        $dateStamp = date('Y/m/d h:i:sa');

        if (! file_exists($installedLogFile)) {
            $message = trans('installer_messages.installed.success_log_message').$dateStamp."\n";

            file_put_contents($installedLogFile, $message);
            
            // Log installation for audit purposes
            Log::info('Application installation completed', [
                'timestamp' => now(),
                'database' => env('DB_DATABASE'),
                'app_url' => config('app.url'),
                'php_version' => phpversion(),
                'laravel_version' => app()->version(),
            ]);
        } else {
            $message = trans('installer_messages.updater.log.success_message').$dateStamp;

            file_put_contents($installedLogFile, $message.PHP_EOL, LOCK_EX);
            
            // Log update for audit purposes
            Log::info('Application update completed', [
                'timestamp' => now(),
                'database' => env('DB_DATABASE'),
                'app_url' => config('app.url'),
            ]);
        }

        return $message;
    }

    /**
     * Update installed file.
     *
     * @return int
     */
    public function update()
    {
        return $this->create();
    }
}

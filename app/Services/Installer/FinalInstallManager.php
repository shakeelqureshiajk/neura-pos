<?php

namespace App\Services\Installer;

use Exception;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Symfony\Component\Console\Output\BufferedOutput;

class FinalInstallManager
{
    /**
     * Run final commands.
     *
     * @return string
     */
    public function runFinal()
    {
        $outputLog = new BufferedOutput;

        $this->backupDatabase($outputLog);
        $this->generateKey($outputLog);
        $this->publishVendorAssets($outputLog);

        return $outputLog->fetch();
    }

    /**
     * Backup database before installation.
     *
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return void
     */
    private function backupDatabase(BufferedOutput $outputLog)
    {
        try {
            $dbHost = env('DB_HOST', 'localhost');
            $dbName = env('DB_DATABASE');
            $dbUser = env('DB_USERNAME', 'root');
            $dbPassword = env('DB_PASSWORD', '');
            
            $backupDir = storage_path('backups');
            if (!is_dir($backupDir)) {
                mkdir($backupDir, 0755, true);
            }
            
            $backupFile = $backupDir . '/' . $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';
            
            // Build mysqldump command
            $command = "mysqldump -h {$dbHost} -u {$dbUser}";
            
            if (!empty($dbPassword)) {
                $command .= " -p{$dbPassword}";
            }
            
            $command .= " {$dbName} > \"{$backupFile}\"";
            
            // Execute backup
            exec($command, $output, $returnCode);
            
            if ($returnCode === 0) {
                $outputLog->writeln('<info>Database backup created: ' . $backupFile . '</info>');
                Log::info('Database backup created', ['file' => $backupFile, 'database' => $dbName]);
            } else {
                Log::warning('Database backup failed', ['database' => $dbName, 'error' => implode("\n", $output)]);
            }
        } catch (Exception $e) {
            Log::error('Database backup error: ' . $e->getMessage());
        }
    }

    /**
     * Generate New Application Key.
     *
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return \Symfony\Component\Console\Output\BufferedOutput|array
     */
    private function generateKey(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.key')) {
                Artisan::call('key:generate', ['--force'=> true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Publish vendor assets.
     *
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return \Symfony\Component\Console\Output\BufferedOutput|array
     */
    private function publishVendorAssets(BufferedOutput $outputLog)
    {
        try {
            if (config('installer.final.publish')) {
                Artisan::call('vendor:publish', ['--all' => true], $outputLog);
            }
        } catch (Exception $e) {
            return static::response($e->getMessage(), $outputLog);
        }

        return $outputLog;
    }

    /**
     * Return a formatted error messages.
     *
     * @param  $message
     * @param  \Symfony\Component\Console\Output\BufferedOutput  $outputLog
     * @return array
     */
    private static function response($message, BufferedOutput $outputLog)
    {
        return [
            'status' => 'error',
            'message' => $message,
            'dbOutputLog' => $outputLog->fetch(),
        ];
    }
}

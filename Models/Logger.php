<?php
namespace Models;

class Logger
{
    private string $logDir;

    public function __construct(string $logDir = __DIR__ . '/../../logs')
    {
        $this->logDir = $logDir;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    public function log(string $action, string $table, bool $success = true, ?string $details = null): void
    {
        $date = new \DateTime();
        $filename = sprintf('MIHOYO_%02d_%04d.log', (int)$date->format('m'), (int)$date->format('Y'));
        $filePath = $this->logDir . DIRECTORY_SEPARATOR . $filename;

        $status = $success ? 'SUCCESS' : 'FAIL';
        $details = $details ? " - $details" : '';
        $line = sprintf("[%s] %s %s on %s%s\n", $date->format('Y-m-d H:i:s'), $action, $status, $table, $details);

        file_put_contents($filePath, $line, FILE_APPEND);
    }

    public function getAvailableLogs(): array
    {
        $files = glob($this->logDir . DIRECTORY_SEPARATOR . 'MIHOYO_*.log');
        rsort($files); // plus récent d'abord
        return $files;
    }

    public function readLog(string $filePath): array
    {
        if (!file_exists($filePath)) return [];
        return file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}

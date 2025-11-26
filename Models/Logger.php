<?php
namespace Models;

/**
 * Simple logger for recording actions and retrieving logs.
 */
class Logger
{
    /** @var string Directory where logs are stored */
    private string $logDir;

    /**
     * Constructor.
     *
     * @param string $logDir Optional directory path to store logs. Defaults to ../../logs.
     */
    public function __construct(string $logDir = __DIR__ . '/../../logs')
    {
        $this->logDir = $logDir;

        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    /**
     * Write a log entry.
     *
     * @param string $action Action performed (e.g., CREATE, UPDATE, DELETE).
     * @param string $table Table or entity affected.
     * @param bool $success Whether the action was successful. Default true.
     * @param string|null $details Optional additional details to include in the log.
     */
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

    /**
     * Get all available log files, sorted from newest to oldest.
     *
     * @return array List of log file paths.
     */
    public function getAvailableLogs(): array
    {
        $files = glob($this->logDir . DIRECTORY_SEPARATOR . 'MIHOYO_*.log');
        rsort($files); // newest first
        return $files;
    }

    /**
     * Read a log file into an array of lines.
     *
     * @param string $filePath Path to the log file.
     * @return array Array of log lines, or empty array if file does not exist.
     */
    public function readLog(string $filePath): array
    {
        if (!file_exists($filePath)) return [];
        return file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    }
}

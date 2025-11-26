<?php

namespace Controllers;

use League\Plates\Engine;

/**
 * Controller to handle application logs.
 *
 * Manages reading log files and writing new log entries.
 */
class LogsController
{
    private string $logDir;
    private Engine $templates;

    /**
     * Constructor.
     *
     * @param MainController $mainController Main controller, used for potential redirections or views.
     */
    public function __construct(MainController $mainController)
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->logDir = __DIR__ . '/../../logs';
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    /**
     * Display the list of log files and the content of a selected month.
     *
     * @param string|null $date Optional date in "MM-YYYY" format to filter logs.
     */
    public function index(?string $date = null): void
    {
        $files = glob($this->logDir . '/MIHOYO_*.log');
        $logs = [];

        foreach ($files as $file) {
            preg_match('/MIHOYO_(\d{2})_(\d{4})\.log$/', basename($file), $matches);
            if ($matches) {
                $monthYear = "{$matches[1]}-{$matches[2]}";
                $logs[$monthYear] = $file;
            }
        }

        krsort($logs); // sort from most recent to oldest

        $selectedFile = null;
        $logContent = [];
        if ($date && isset($logs[$date])) {
            $selectedFile = $logs[$date];
            $logContent = file($selectedFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        }

        echo $this->templates->render('logs', [
            'logs' => $logs,
            'selectedDate' => $date,
            'logContent' => $logContent
        ]);
    }

    /**
     * Write a log entry to the current month's log file.
     *
     * @param string $action Action performed (e.g., 'CONNEXION').
     * @param string $table Table or module affected.
     * @param bool $success Whether the action succeeded.
     * @param string $details Optional details about the action.
     */
    public function write(string $action, string $table, bool $success, string $details = ''): void
    {
        $date = new \DateTime();
        $filename = sprintf('%s/MIHOYO_%02d_%d.log', $this->logDir, $date->format('m'), $date->format('Y'));

        $status = $success ? 'SUCCESS' : 'FAIL';
        $line = sprintf(
            "[%s] [%s] %s on table %s - %s\n",
            $date->format('Y-m-d H:i:s'),
            $status,
            $action,
            $table,
            $details
        );

        file_put_contents($filename, $line, FILE_APPEND);
    }
}

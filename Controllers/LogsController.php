<?php

namespace Controllers;

use League\Plates\Engine;

class LogsController
{
    private string $logDir;

    private Engine $templates;

    public function __construct(MainController $mainController)
    {
        $this->templates = new Engine(__DIR__ . '/../Views');
        $this->logDir = __DIR__ . '/../../logs';
        if (!is_dir($this->logDir)) {
            mkdir($this->logDir, 0777, true);
        }
    }

    /**
     * Affiche la liste des fichiers et le contenu d'un mois sélectionné
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

        krsort($logs); // du plus récent au plus ancien

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
     * Enregistre un log
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

<?php

use Models\Logger;

$this->layout('template', ['title' => 'Logs']);

$logger = new Logger();
$availableLogs = $logger->getAvailableLogs();

$selectedLog = $_GET['file'] ?? $availableLogs[0] ?? null;
$logLines = $selectedLog ? $logger->readLog($selectedLog) : [];
?>

<div class="logs-container">
    <div class="logs-header">
        <h1>Journal des actions</h1>

        <form method="GET" action="./index.php" class="log-selector-form">
            <input type="hidden" name="action" value="logs">
            <div class="select-wrapper">
                <select name="file" id="file" onchange="this.form.submit()">
                    <?php foreach ($availableLogs as $file): ?>
                        <option value="<?= htmlspecialchars($file) ?>" <?= $file === $selectedLog ? 'selected' : '' ?>>
                            <?= basename($file, '.log') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>
    </div>

    <div class="log-console">
        <?php if (!empty($logLines)): ?>
            <?php foreach ($logLines as $line): ?>
                <?php
                $statusClass = 'log-info';
                if (str_contains($line, 'SUCCESS')) $statusClass = 'log-success';
                elseif (str_contains($line, 'FAIL') || str_contains($line, 'ERROR')) $statusClass = 'log-fail';
                elseif (str_contains($line, 'WARNING')) $statusClass = 'log-warning';
                ?>
                <div class="log-entry <?= $statusClass ?>">
                    <code><?= htmlspecialchars($line) ?></code>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="log-empty">
                <p>Aucun log disponible pour cette période.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
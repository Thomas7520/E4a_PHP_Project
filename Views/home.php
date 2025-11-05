<?php
$this->layout('template', ['title' => 'TP Mihoyo']);
?>

<h1>Collection <?= $this->e($gameName) ?></h1>

<h2>Liste de tous les personnages :</h2>

<?php if (!empty($listPersonnage)): ?>
    <div class="cards-grid">
        <?php foreach ($listPersonnage as $perso): ?>
            <div class="perso-card-vertical">
                <div class="perso-img-container">
                    <img src="<?= $this->e($perso->getUrlImg()) ?>" alt="<?= $this->e($perso->getName()) ?>" class="perso-img">
                    <span class="rarity-badge"><?= str_repeat("⭐", $perso->getRarity()) ?></span>
                </div>
                <div class="perso-info">
                    <h3><?= $this->e($perso->getName()) ?></h3>
                    <p><strong>Élément :</strong> <span class="element-badge"><?= $this->e($perso->getElement()) ?></span></p>
                    <p><strong>Classe :</strong> <?= $this->e($perso->getUnitclass()) ?></p>
                    <p><strong>Origine :</strong> <?= $this->e($perso->getOrigin() ?? 'Inconnue') ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p>Aucun personnage trouvé pour le moment.</p>
<?php endif; ?>

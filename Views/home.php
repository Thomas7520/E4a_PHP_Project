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
                    <img src="<?= $this->e($perso->getUrlImg()) ?>"
                         alt="<?= $this->e($perso->getName()) ?>"
                         class="perso-img">

                    <div class="rarity-stars">
                        <?php for ($i = 0; $i < $perso->getRarity(); $i++): ?>
                            <svg class="star" viewBox="0 0 24 24" fill="gold" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z"/>
                            </svg>
                        <?php endfor; ?>
                    </div>
                </div>


                <div class="perso-info">
                    <h3><?= $this->e($perso->getName()) ?></h3>

                    <p>
                        <strong>Élément :</strong>
                        <img src="<?= $this->e($elements[$perso->getElement()]->getUrlImg()) ?>"
                             alt="<?= $this->e($elements[$perso->getElement()]->getName()) ?>"
                             class="icon-small"
                             title="<?= $this->e($elements[$perso->getElement()]->getName()) ?>">
                    </p>

                    <p>
                        <strong>Classe :</strong>
                        <img src="<?= $this->e($unitclasses[$perso->getUnitclass()]->getUrlImg()) ?>"
                             alt="<?= $this->e($unitclasses[$perso->getUnitclass()]->getName()) ?>"
                             class="icon-small"
                             title="<?= $this->e($unitclasses[$perso->getUnitclass()]->getName()) ?>">
                    </p>

                    <p>
                        <strong>Origine :</strong>
                        <?php if ($perso->getOrigin() && isset($origins[$perso->getOrigin()])): ?>
                            <img src="<?= $this->e($origins[$perso->getOrigin()]->getUrlImg()) ?>"
                                 alt="<?= $this->e($origins[$perso->getOrigin()]->getName()) ?>"
                                 class="icon-small"
                                 title="<?= $this->e($origins[$perso->getOrigin()]->getName()) ?>">
                        <?php else: ?>
                            Inconnue
                        <?php endif; ?>
                    </p>
                </div>

                <div class="perso-actions">
                    <a href="./index.php?action=add-perso&id=<?= $this->e($perso->getId()) ?>"
                       class="btn btn-edit"
                       title="Modifier <?= $this->e($perso->getName()) ?>">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25z"/>
                            <path d="M20.71 7.04a1 1 0 0 0 0-1.41l-2.34-2.34a1 1 0 0 0-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"/>
                        </svg>
                        <span>Éditer</span>
                    </a>

                    <a href="./index.php?action=del-perso&id=<?= $this->e($perso->getId()) ?>"
                       class="btn btn-delete"
                       title="Supprimer <?= $this->e($perso->getName()) ?>">
                        <svg class="icon" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M9 3h6l1 2h5v2H4V5h5l1-2z"/>
                            <path d="M6 9h12l-1 11H7L6 9z"/>
                        </svg>
                        <span>Supprimer</span>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun personnage trouvé pour le moment.</p>
<?php endif; ?>

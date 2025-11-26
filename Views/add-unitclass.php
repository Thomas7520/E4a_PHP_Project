<?php $this->layout('template', ['title' => $title]) ?>

<div class="form-container">
    <h1><?= $title ?></h1>

    <form method="POST" action="./index.php?action=add-unitclass">
        <?php if ($unitclass->getId()): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($unitclass->getId()) ?>">
        <?php endif; ?>

        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($unitclass->getName()) ?>" required>

        <label>Image URL :</label>
        <input type="text" name="url_img" value="<?= htmlspecialchars($unitclass->getUrlImg()) ?>">

        <button type="submit"><?= $unitclass->getId() ? 'Mettre à jour' : 'Ajouter' ?></button>
    </form>
</div>

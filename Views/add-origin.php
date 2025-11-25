<?php $this->layout('template', ['title' => $title]) ?>

<div class="form-container">
    <h1><?= $title ?></h1>

    <form method="POST" action="./index.php?action=add-origin">
        <?php if ($origin->getId()): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php endif; ?>

        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($origin->getName()) ?>" required>

        <label>Image URL :</label>
        <input type="text" name="img_url" value="<?= htmlspecialchars($origin->getImgUrl()) ?>">

        <button type="submit"><?= $origin->getId() ? 'Mettre à jour' : 'Ajouter' ?></button>
    </form>
</div>

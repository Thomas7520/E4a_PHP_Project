<?php $this->layout('template', ['title' => $title]) ?>

<div class="form-container">
    <h1><?= $title ?></h1>

    <form method="POST" action="./index.php?action=add-element">
        <?php if ($element->getId()): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($element->getId()) ?>">
        <?php endif; ?>

        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($element->getName()) ?>" required>

        <label>Image URL :</label>
        <input type="text" name="url_img" value="<?= htmlspecialchars($element->getUrlImg()) ?>">

        <button type="submit"><?= $element->getId() ? 'Mettre à jour' : 'Ajouter' ?></button>
    </form>
</div>

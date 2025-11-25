<?php
$this->layout('template', ['title' => $title]);

$name = $perso->getName() ?? '';
$element = $perso->getElement() ?? '';
$rarity = $perso->getRarity() ?? 1;
$unitclass = $perso->getUnitclass() ?? '';
$origin = $perso->getOrigin() ?? '';
$urlImg = $perso->getUrlImg() ?? '';
$id = $perso->getId() ?? '';
?>


<div class="form-container">

    <h1><?= $title ?></h1>

    <form action="./index.php?action=add-perso" method="POST">

        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php endif; ?>

        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>

        <label>Élément :</label>
        <input type="text" name="element" value="<?= htmlspecialchars($element) ?>">

        <label>Rareté :</label>
        <input type="number" name="rarity" min="1" max="5" value="<?= htmlspecialchars($rarity) ?>">

        <label>Classe :</label>
        <input type="text" name="unitclass" value="<?= htmlspecialchars($unitclass) ?>">

        <label>Origine :</label>
        <input type="text" name="origin" value="<?= htmlspecialchars($origin) ?>">

        <label>Image URL :</label>
        <input type="text" name="urlImg" value="<?= htmlspecialchars($urlImg) ?>">

        <button type="submit"><?= $id ? 'Mettre à jour' : 'Ajouter' ?></button>
    </form>

</div>

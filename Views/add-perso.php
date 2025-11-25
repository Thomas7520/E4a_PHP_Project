<?php
$this->layout('template', ['title' => $title]);

$name = $perso->getName() ?? '';
$elementId = $perso->getElement() ?? '';
$rarity = $perso->getRarity() ?? 1;
$unitclassId = $perso->getUnitclass() ?? '';
$originId = $perso->getOrigin() ?? '';
$urlImg = $perso->getUrlImg() ?? '';
$id = $perso->getId() ?? '';
?>

<div class="form-container">

    <h1><?= $title ?></h1>

    <form action="./index.php?action=add-perso" method="POST">

        <?php if ($id): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <?php endif; ?>

        <!-- Nom -->
        <label>Nom :</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name) ?>" required>

        <!-- Élément -->
        <label>Élément :</label>
        <select name="element" required>
            <option value="">-- Sélectionner un élément --</option>
            <?php foreach ($elements as $el): ?>
                <option value="<?= htmlspecialchars($el->getId()) ?>" <?= $el->getId() == $elementId ? 'selected' : '' ?>>
                    <?= htmlspecialchars($el->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Classe -->
        <label>Classe :</label>
        <select name="unitclass" required>
            <option value="">-- Sélectionner une classe --</option>
            <?php foreach ($unitclasses as $uc): ?>
                <option value="<?= htmlspecialchars($uc->getId()) ?>" <?= $uc->getId() == $unitclassId ? 'selected' : '' ?>>
                    <?= htmlspecialchars($uc->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Origine -->
        <label>Origine :</label>
        <select name="origin">
            <option value="">-- Sélectionner une origine --</option>
            <?php foreach ($origins as $or): ?>
                <option value="<?= htmlspecialchars($or->getId()) ?>" <?= $or->getId() == $originId ? 'selected' : '' ?>>
                    <?= htmlspecialchars($or->getName()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <!-- Rareté -->
        <label>Rareté :</label>
        <input type="number" name="rarity" min="1" max="5" value="<?= htmlspecialchars($rarity) ?>" required>

        <!-- Image URL -->
        <label>Image URL :</label>
        <input type="text" name="urlImg" value="<?= htmlspecialchars($urlImg) ?>">

        <button type="submit"><?= $id ? 'Mettre à jour' : 'Ajouter' ?></button>
    </form>

</div>

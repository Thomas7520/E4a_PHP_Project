<?php $this->layout('template', ['title' => $title]) ?>

<h1>Ajouter un paramètre</h1>

<form method="POST" action="./index.php?action=add-parameter">
    <label>Type de paramètre :</label>
    <select name="type" required>
        <option value="">-- Sélectionner --</option>
        <option value="element">Élément</option>
        <option value="unitclass">Classe</option>
        <option value="origin">Origine</option>
    </select>

    <button type="submit">OK</button>
</form>

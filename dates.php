<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Validation d'une date avec checkdate()
 * Date     : 18/10/2026
 */
// Exercice 6.3 : validation de date avec checkdate()
if (isset($_GET['jour'], $_GET['mois'], $_GET['annee'])) {
    $j = (int) $_GET['jour'];
    $m = (int) $_GET['mois'];
    $a = (int) $_GET['annee'];

    if (checkdate($m, $j, $a)) {          // ordre : mois, jour, année
        echo "Date valide : " . sprintf('%02d/%02d/%04d', $j, $m, $a);
    } else {
        echo "<span style='color:red'>Date invalide.</span>";
    }
}
?>
<form method="get">
    Jour : <input type="text" name="jour" size="2">
    Mois : <input type="text" name="mois" size="2">
    Année : <input type="text" name="annee" size="4">
    <input type="submit" value="Vérifier">
</form>

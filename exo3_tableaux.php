<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Tableaux : création, affichage, statistiques, tris et opérateurs
 * Date     : 18/10/2026
 */
include 'includes/entete_inc.php';   // charge aussi config.php (require_once)
include 'includes/menu_inc.php';

// Expérience 1 : fichier inexistant
// include 'inexistant.php';  -> Warning, le script CONTINUE de s'exécuter.
// require 'inexistant.php';  -> Fatal error, le script S'ARRÊTE immédiatement.

// Expérience 2 : double inclusion
// include 'includes/menu_inc.php';
// include 'includes/menu_inc.php';       -> le menu s'affiche DEUX fois.
// include_once 'includes/menu_inc.php';
// include_once 'includes/menu_inc.php';  -> le menu ne s'affiche qu'UNE fois.

// ---------- Exercice 3.1 : création ----------
$notes = [
    "Mohamed" => 16, "Ahmed" => 14, "Hind" => 13, "Aicha" => 15,
    "Samir" => 13, "Zakaria" => 13, "Rafik" => 10, "Ilham" => 9,
    "Hamza" => 7, "Sami" => 7, "Noura" => 14
];

$modules = ["PHP", "JavaScript", "Base de données"];

echo "<h3>Modules (foreach)</h3>";
foreach ($modules as $m) {
    echo $m . "<br>";
}

echo "<h3>Modules (par indice)</h3>";
for ($i = 0; $i < count($modules); $i++) {
    echo "Module $i : " . $modules[$i] . "<br>";
}

// ---------- Exercice 3.2 : affichage HTML ----------
echo "<h3>Notes</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nom</th><th>Note</th><th>Mention</th></tr>";
foreach ($notes as $nom => $note) {
    $style = ($note < SEUIL) ? " style='color:red'" : "";
    echo "<tr$style><td>$nom</td><td>$note</td><td>" . mention($note) . "</td></tr>";
}
echo "</table>";

// ---------- Exercice 3.3 : statistiques ----------
$somme = 0;
$meilleure = NOTE_MIN;
$faible = NOTE_MAX;
foreach ($notes as $note) {
    $somme += $note;
    if ($note > $meilleure) $meilleure = $note;
    if ($note < $faible) $faible = $note;
}
$moyenne = $somme / count($notes);

echo "<h3>Statistiques (boucle)</h3>";
echo "Somme : $somme<br>";
echo "Moyenne : " . round($moyenne, 2) . "<br>";
echo "Meilleure : $meilleure<br>";
echo "Plus faible : $faible<br>";

echo "<h3>Vérification</h3>";
echo "Somme : " . array_sum($notes) . "<br>";
echo "Moyenne : " . round(array_sum($notes) / count($notes), 2) . "<br>";
echo "Max : " . max($notes) . "<br>";
echo "Min : " . min($notes) . "<br>";

$effectifs = [];
foreach ($notes as $note) {
    $m = mention($note);
    if (!isset($effectifs[$m])) {
        $effectifs[$m] = 0;
    }
    $effectifs[$m]++;
}
echo "<h3>Effectifs par mention</h3>";
foreach ($effectifs as $m => $nb) {
    echo "$m : $nb<br>";
}

// ---------- Exercice 3.4 : tri ----------
function afficher($tab) {
    foreach ($tab as $cle => $valeur) {
        echo "$cle : $valeur<br>";
    }
}

$t = $notes; ksort($t);
echo "<h3>Noms croissants (ksort)</h3>";
afficher($t);

$t = $notes; arsort($t);
echo "<h3>Notes décroissantes (arsort)</h3>";
afficher($t);

$t = $notes; krsort($t);
echo "<h3>Noms décroissants (krsort)</h3>";
afficher($t);

$t = $notes; asort($t);
echo "<h3>Notes croissantes (asort)</h3>";
afficher($t);

// Question : pour un tableau indexé comme $modules, on utilise sort() (croissant)
// ou rsort() (décroissant). Elles réindexent le tableau (0, 1, 2...),
// alors que asort/arsort/ksort/krsort conservent les clés.

// ---------- Exercice 3.5 : opérateurs de tableaux ----------
$a = ["x" => 1, "y" => 2];
$b = ["y" => 2, "x" => 1];

echo "<h3>Opérateurs de tableaux</h3>";
echo "<b>\$a + \$b :</b> ";
print_r($a + $b);          // ["x" => 1, "y" => 2]
echo "<br><b>\$a == \$b :</b> ";
var_dump($a == $b);        // true
echo "<b>\$a === \$b :</b> ";
var_dump($a === $b);       // false

// $a + $b  : union. On garde les éléments de $a, puis on ajoute ceux de $b
//            dont la clé n'existe pas déjà : résultat = $a.
// $a == $b : true, mêmes paires clé/valeur (l'ordre n'a pas d'importance).
// $a === $b: false, il faut mêmes paires, dans le même ORDRE et du même type.

include 'includes/pied_inc.php';

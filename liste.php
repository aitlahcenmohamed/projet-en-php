<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Lecture de data/notes.csv et affichage des apprenants avec moyennes et mentions
 * Date     : 18/10/2026
 */
require_once 'config.php';

$fichier = 'data/notes.csv';

// ---------- Exercice 5.2 : lecture avec fgetcsv ----------
if (!file_exists($fichier)) {
    echo "Aucune note enregistrée pour le moment.";
    exit;
}

$f = fopen($fichier, 'r');
if (!$f) {
    echo "Erreur : impossible d'ouvrir le fichier.";
    exit;
}

echo "<h3>Liste des apprenants</h3>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nom</th><th>Info</th><th>Math</th><th>Moyenne</th><th>Mention</th></tr>";

$somme = 0;
$nb = 0;
while (($ligne = fgetcsv($f, 0, ';')) !== false) {
    if (count($ligne) < 3) continue;              // ignore les lignes vides
    [$nom, $info, $math] = $ligne;
    $moy = ($info + $math) / 2;
    $style = ($moy < SEUIL) ? " style='color:red'" : "";

    echo "<tr$style>";
    echo "<td>" . htmlspecialchars($nom) . "</td>";
    echo "<td>$info</td><td>$math</td>";
    echo "<td>" . round($moy, 2) . "</td>";
    echo "<td>" . mention($moy) . "</td>";
    echo "</tr>";

    $somme += $moy;
    $nb++;
}
echo "</table>";
fclose($f);

if ($nb > 0) {
    echo "<p>Moyenne générale de la classe : " . round($somme / $nb, 2) . "</p>";
}

// ---------- Exercice 5.3 : lecture "bas niveau" ----------
echo "<h3>Lecture avec fgets / explode</h3>";
$f = fopen($fichier, 'r');
while (!feof($f)) {
    $ligne = fgets($f);
    if ($ligne === false || trim($ligne) === '') continue;
    $champs = explode(';', trim($ligne));
    echo htmlspecialchars(implode(' | ', $champs)) . "<br>";
}
fclose($f);

// Comparaison :
// fgetcsv : découpe directement en tableau, gère les guillemets et les séparateurs
//           présents DANS un champ. Plus sûr et plus court.
// fgets + explode : plus simple à comprendre (ligne brute visible), mais il faut
//           tester feof, retirer le "\n", ignorer les lignes vides, et explode
//           se trompe si un champ contient le séparateur ou des guillemets.

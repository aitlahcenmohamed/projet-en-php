<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Export des notes en JSON et démonstration de serialize/unserialize
 * Date     : 18/10/2026
 */
require_once 'config.php';

$csv = 'data/notes.csv';
$json = 'data/notes.json';

if (!file_exists($csv)) {
    echo "Aucune note à exporter. Saisissez d'abord des apprenants (saisie.html).";
    exit;
}

// 1. Lecture du CSV dans un tableau
$apprenants = [];
$f = fopen($csv, 'r');
while (($l = fgetcsv($f, 0, ';')) !== false) {
    if (count($l) < 3) continue;
    $moy = ($l[1] + $l[2]) / 2;
    $apprenants[] = [
        'nom'     => $l[0],
        'info'    => (float) $l[1],
        'math'    => (float) $l[2],
        'moyenne' => $moy,
        'mention' => mention($moy),
    ];
}
fclose($f);

// 2. Export JSON
file_put_contents($json, json_encode($apprenants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "<h3>JSON écrit dans $json</h3>";
echo "<pre>" . htmlspecialchars(json_encode($apprenants, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)) . "</pre>";

// 3. Relecture avec json_decode
$lu = json_decode(file_get_contents($json), true);
echo "<h3>Relecture (json_decode)</h3>";
foreach ($lu as $a) {
    echo htmlspecialchars($a['nom']) . " : " . $a['moyenne'] . " (" . $a['mention'] . ")<br>";
}

// 4. serialize / unserialize
$ser = serialize($apprenants);
echo "<h3>serialize</h3><pre>" . htmlspecialchars($ser) . "</pre>";
var_dump(unserialize($ser) == $apprenants);   // true

// json_encode : format lisible par tous les langages (JavaScript, Python...).
// serialize   : format propre à PHP, conserve les types PHP (dont les objets).

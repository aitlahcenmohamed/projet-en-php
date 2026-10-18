<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Traitement du formulaire POST de saisie des notes et écriture dans data/notes.csv
 * Date     : 18/10/2026
 */
require_once 'config.php';

$erreur = '';

if (!isset($_POST['nom'], $_POST['note_info'], $_POST['note_math'])
    || empty($_POST['nom'])
    || $_POST['note_info'] === ''
    || $_POST['note_math'] === '') {
    $erreur = "Tous les champs sont obligatoires.";
} else {
    $nom = $_POST['nom'];
    $note_info = $_POST['note_info'];
    $note_math = $_POST['note_math'];

    if (!is_numeric($note_info) || !is_numeric($note_math)) {
        $erreur = "Les notes doivent être des nombres.";
    } elseif ($note_info < NOTE_MIN || $note_info > NOTE_MAX
           || $note_math < NOTE_MIN || $note_math > NOTE_MAX) {
        $erreur = "Les notes doivent être comprises entre " . NOTE_MIN . " et " . NOTE_MAX . ".";
    }
}

if ($erreur !== '') {
    echo "<p style='color:red'>$erreur</p>";
    echo "<a href='saisie.html'>Retour</a>";
} else {
    $moyenne = ($note_info + $note_math) / 2;
    echo "<h3>Récapitulatif</h3>";
    echo "Nom : " . htmlspecialchars($nom) . "<br>";
    echo "Note info : " . htmlspecialchars($note_info) . "<br>";
    echo "Note math : " . htmlspecialchars($note_math) . "<br>";
    echo "Moyenne : $moyenne<br>";

    // ---------- Exercice 5.1 : écriture dans le CSV ----------
    if (!is_dir('data')) {
        mkdir('data');
    }
    $f = fopen('data/notes.csv', 'a');            // "a" = ajout à la fin
    fputcsv($f, [$nom, $note_info, $note_math], ';');
    fclose($f);

    echo "<p>Enregistré. <a href='liste.php'>Voir la liste</a></p>";
}

// Q1 : POST ne place pas les données dans l'URL : elles n'apparaissent pas dans
//      la barre d'adresse, l'historique ni les journaux. (Pas chiffré : il faut HTTPS.)
// Q2 : $_REQUEST contient le contenu de $_GET, $_POST et $_COOKIE
//      (selon request_order / variables_order de php.ini).
// Q3 : mode "w" : le fichier est VIDÉ à chaque ouverture (seul le dernier apprenant resterait).
//      mode "a" : chaque ligne est ajoutée à la suite.

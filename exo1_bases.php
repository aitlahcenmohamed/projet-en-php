<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Variables, constantes, types, conversions et chaînes de caractères
 * Date     : 18/10/2026
 */
// Partie 0 : commentaires
echo 'Hello PHP<br>';
// commentaire avec //
# commentaire avec #
/* commentaire
   sur plusieurs lignes */

// ---------- Exercice 1.1 : noms de variables ----------
// $x        : valide
// $_x       : valide (le _ est autorisé au début)
// $2x       : INVALIDE (ne peut pas commencer par un chiffre)
// $x-y      : INVALIDE (le tiret est l'opérateur moins)
// $Prix_HT  : valide
// $prix ht  : INVALIDE (l'espace n'est pas autorisé)
// $état     : valide (les caractères accentués sont tolérés)
$x = 1;
$_x = 2;
$Prix_HT = 60;
$état = "ok";

$a = "minuscule";
$A = "MAJUSCULE";
echo "$a / $A<br>";   // deux variables distinctes (sensible à la casse)

// ---------- Exercice 1.2 : constantes ----------
require 'config.php';
echo ETABLISSEMENT . '<br>';
echo NOTE_MIN . ' ' . NOTE_MAX . ' ' . SEUIL . '<br>';
var_dump(defined('SEUIL'));     // bool(true)
var_dump(defined('INCONNUE'));  // bool(false)

// Constante non définie : PHP 8 => erreur fatale (Error "Undefined constant").
//   PHP 7 => avertissement, et la constante est traitée comme une chaîne.
// const  : défini à la compilation, uniquement au niveau global/classe, pas dans un if.
// define : exécuté à l'exécution, utilisable dans un if ou une fonction,
//          nom pouvant être dynamique.

// ---------- Exercice 1.3 : calcul ----------
$prix_ht = 60;
$tva = 20;
$prix_ttc = $prix_ht * (1 + $tva / 100);
echo "<br>Le prix TTC du produit est de $prix_ttc €.<br>";

// ---------- Exercice 1.4 : types et conversions ----------
$test = 42;
$test = (string) $test;
var_dump($test);                // string(2) "42"

// Booléens : false pour 0, 0.0, "0", "", [], null ; true pour "abc"
var_dump((bool) 0);
var_dump((bool) 0.0);
var_dump((bool) "0");
var_dump((bool) "");
var_dump((bool) "abc");
var_dump((bool) []);
var_dump((bool) null);

var_dump((int) 3.9);            // 3
var_dump((int) "12abc");        // 12
var_dump((float) "1.5e3");      // 1500.0
var_dump((int) true);           // 1

echo '<br>';
echo 255 . '<br>';              // décimal
echo 0xFF . '<br>';             // hexadécimal
echo 0377 . '<br>';             // octal
echo 0b11111111 . '<br>';       // binaire

// ---------- Exercice 1.5 : chaînes ----------
$traitees = "égales à";
$ici = 2;

echo 'Ahmed a dit : "J\'ai réussi"<br>';
echo 'Voulez-vous supprimer C:\*.*?<br>';
echo 'Ceci n\'affichera pas \n de nouvelle ligne<br>';
echo 'Les variables ne seront pas $traitees $ici<br>';
echo "Les variables seront $traitees $ici<br>";

$texte = trim("*Bonjour les développeurs*", "*");
echo $texte . '<br>';

// Une lettre par ligne (mb_* car strlen coupe les lettres accentuées comme "é")
for ($i = 0; $i < mb_strlen($texte); $i++) {
    echo mb_substr($texte, $i, 1) . '<br>';
}

// Version demandée avec strlen() sur une chaîne sans accent
$mot = "Bonjour";
for ($i = 0; $i < strlen($mot); $i++) {
    echo $mot[$i] . '<br>';
}

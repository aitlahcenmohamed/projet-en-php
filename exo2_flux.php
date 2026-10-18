<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Structures de contrôle : if, switch, boucles, break, continue
 * Date     : 18/10/2026
 */
require_once 'config.php';   // contient la fonction mention($note)

// ---------- Exercice 2.1 : if / elseif / else ----------
// (mention() est définie dans config.php :
//  >=16 Très bien, >=14 Bien, >=12 Assez bien, >=SEUIL Passable, sinon Ajourné)
foreach ([18, 15, 12.5, 10, 7] as $n) {
    echo "Note $n : " . mention($n) . "<br>";
}

// ---------- Exercice 2.2 : switch ----------
$mois = date("m");

switch ($mois) {
    case "01": echo "Janvier";   break;
    case "02": echo "Février";   break;
    case "03": echo "Mars";      break;
    case "04": echo "Avril";     break;
    case "05": echo "Mai";       break;
    case "06": echo "Juin";      break;
    case "07": echo "Juillet";   break;
    case "08": echo "Août";      break;
    case "09": echo "Septembre"; break;
    case "10": echo "Octobre";   break;
    case "11": echo "Novembre";  break;
    case "12": echo "Décembre";  break;
    default:   echo "Mois inconnu";
}
echo "<br>";

// Question : si on oublie un break, PHP continue d'exécuter le case suivant
// (et ainsi de suite) jusqu'au prochain break : c'est le "fall-through".

// ---------- Exercice 2.3 : boucles ----------

// 1. Triangle d'étoiles
for ($i = 1; $i <= 6; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

// 2. while : de 0 à 20 par pas de 2, le 10 en gras
echo "<br>";
$i = 0;
while ($i <= 20) {
    if ($i == 10) {
        echo "<b>$i</b> ";
    } else {
        echo "$i ";
    }
    $i += 2;
}

// 3. for + continue : nombres pairs de 0 à 10
echo "<br><br>";
for ($i = 0; $i <= 10; $i++) {
    if ($i % 2 != 0) {
        continue;       // on saute les nombres impairs
    }
    echo "$i ";
}

// 4. while + switch + break 2
echo "<br><br>";
$i = 1;
while (true) {
    switch ($i) {
        case 5:
            echo "At 5<br>";
            break;              // sort uniquement du switch
        case 10:
            echo "At 10; quitting<br>";
            break 2;            // sort du switch ET de la boucle
        default:
            break;
    }
    $i++;
}

// 5. do-while : même affichage que la question 2
echo "<br>";
$i = 0;
do {
    if ($i == 10) {
        echo "<b>$i</b> ";
    } else {
        echo "$i ";
    }
    $i += 2;
} while ($i <= 20);

// Différence essentielle : avec do-while, la condition est testée APRÈS le corps,
// donc le bloc s'exécute au moins une fois, même si la condition est fausse dès le départ.
// Avec while, la condition est testée AVANT : le bloc peut ne jamais s'exécuter.

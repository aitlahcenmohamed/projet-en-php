<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Constantes de l'application (établissement, notes min/max, seuil) et fonction mention()
 * Date     : 18/10/2026
 */
const ETABLISSEMENT = "Mon Établissement";
define('NOTE_MIN', 0);
define('NOTE_MAX', 20);
define('SEUIL', 10);

// Fonction partagée : mention selon la note
if (!function_exists('mention')) {
    function mention($note) {
        if ($note >= 16) return "Très bien";
        elseif ($note >= 14) return "Bien";
        elseif ($note >= 12) return "Assez bien";
        elseif ($note >= SEUIL) return "Passable";
        else return "Ajourné";
    }
}

<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Traitement d'un formulaire envoyé en GET (civilité, prénom, nom)
 * Date     : 18/10/2026
 */
$nom = $_GET['nom'] ?? '';
$prenom = $_GET['prenom'] ?? '';
$sexe = $_GET['sexe'] ?? '';

$civilite = ($sexe === 'F') ? 'Madame' : 'Monsieur';

echo "Bonjour $civilite " . htmlspecialchars($prenom) . " " . htmlspecialchars($nom);

// Observation : après l'envoi, l'URL contient les données, par exemple :
// info.php?nom=Alami&prenom=Sara&sexe=F

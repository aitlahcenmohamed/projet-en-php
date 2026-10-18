<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Page protégée par session affichant le profil de l'utilisateur connecté
 * Date     : 18/10/2026
 */
session_start();

// Accès direct sans être connecté : retour au login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

echo "<h2>Bienvenue " . htmlspecialchars($_SESSION['login']) . "</h2>";

// Variante : relecture du cookie JSON
if (isset($_COOKIE['infos_login'])) {
    $infos = json_decode($_COOKIE['infos_login'], true);
    if (is_array($infos) && isset($infos['date'])) {
        echo "Connecté le " . htmlspecialchars($infos['date']) . "<br>";
    }
}

echo "<br><a href='deconnexion.php'>Se déconnecter</a>";

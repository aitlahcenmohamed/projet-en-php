<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Déconnexion : destruction de la session et redirection
 * Date     : 18/10/2026
 */
session_start();
session_unset();     // vide les variables de session
session_destroy();   // détruit la session
header("Location: login.php");
exit;

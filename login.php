<?php
/**
 * Auteur   : AIT LAHCEN MOHAMED
 * Objectif : Connexion : session, cookies et redirection
 * Date     : 18/10/2026
 */
session_start();   // toute première instruction, avant tout affichage

$login_prerempli = $_COOKIE['dernier_login'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['login'])) {
    $login = trim($_POST['login']);
    $_SESSION['login'] = $login;

    // Cookie simple, valable 24 h
    setcookie("dernier_login", $login, time() + 86400, "/");

    // Variante : un seul cookie contenant un tableau encodé en JSON
    $infos = ['login' => $login, 'date' => date('d/m/Y H:i')];
    setcookie("infos_login", json_encode($infos), time() + 86400, "/");

    header("Location: profil.php");
    exit;
}

// Q1 : Une session est stockée sur le SERVEUR (le navigateur ne garde que PHPSESSID).
//      Un cookie est stocké sur le poste du CLIENT (dans le navigateur).
// Q2 : setcookie() et header() modifient les en-têtes HTTP, envoyés AVANT le contenu.
//      Dès qu'un echo, du HTML ou un espace avant <?php est envoyé, c'est trop tard :
//      erreur "headers already sent".
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
<h2>Connexion</h2>
<form action="login.php" method="post">
    Login :
    <input type="text" name="login" value="<?= htmlspecialchars($login_prerempli) ?>">
    <input type="submit" value="Se connecter">
</form>
</body>
</html>

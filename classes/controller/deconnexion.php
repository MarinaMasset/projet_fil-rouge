<?php
session_start();

if (isset($_SESSION['id'])) {
    
  session_unset();
  session_destroy();
  header('Location: connexion-redirection.php');
}
header('Location: connexion-redirection.php');
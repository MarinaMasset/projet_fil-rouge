<?php
session_start();

if (isset($_SESSION['id'])) {
    
  session_unset();
  session_destroy();
  header('Location: connexion.php');
}
header('Location: connexion.php');
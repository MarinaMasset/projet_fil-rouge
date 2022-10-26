<?php
session_start();

if (isset($_SESSION['id']) && $_SESSION['role'] !== 'super') {
  session_unset();
  session_destroy();
  header('Location: user/connexion.php');
}
header('Location: user/connexion.php');

if (isset($_SESSION['id']) && $_SESSION['role'] === 'super') {
  session_unset();
  session_destroy();
  header('Location: admin/adminConnexion.php');
}
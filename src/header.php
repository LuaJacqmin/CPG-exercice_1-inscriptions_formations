<?php
  define('MODE','dev'); // dev ou prod !! change before building

  if(MODE === "dev"):
    require('config.php'); 
  else:
    require('config-distant.php'); 
  endif;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CEPEGRA - formulaire d'inscription</title>

  <!-- FAVICON -->
  <link rel="stylesheet" href="./styles/main.css">
  <link rel="apple-touch-ic
  on" sizes="180x180" href="assets/favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="assets/favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="assets/favicon/favicon-16x16.png">
  <link rel="manifest" href="assets/favicon/site.webmanifest">
  <link rel="mask-icon" href="assets/favicon/safari-pinned-tab.svg" color="#00aba9">
  <meta name="msapplication-TileColor" content="#00aba9">
  <meta name="theme-color" content="#ffffff">

  <!-- METATAGS -->
  <!-- Primary Meta Tags -->
  <meta name="title" content="Change your title name here">
  <meta name="description" content="Change your description here. That what would appen when we see a thumbnail of you website on socials or google">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="https://changetheurlhere.io/">
  <meta property="og:title" content="JACQMIN Lua | Webpack project template">
  <meta property="og:description" content="Change your description here. That what would appen when we see a thumbnail of you website on socials or google">
  <meta property="og:image" content="./assets/logo/meta-img.png">

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="https://changetheurlhere.io/">
  <meta property="twitter:title" content="Change your title name here">
  <meta property="twitter:description" content="Change your description here. That what would appen when we see a thumbnail of you website on socials or google">
  <meta property="twitter:image" content="./assets/logo/meta-img.png">
</head>


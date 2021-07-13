<?php
  define('MODE','dev'); // dev ou prod !! change before building

  if(MODE === "dev"):
    echo MODE;
    require('config.php'); 
  else:
    require('config-distant.php'); 
  endif;
  if(isset($_POST)):
    unset($_POST);
  endif;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME | Webpack project template</title>

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
<body data-page="form">
  <h1>Cepegra</h1>
  <main>
    <section class="wrapper wrapper--full">
      <div>
        <h2>Formulaire d'enregistrement du Cepegra</h2>
        <p>Veuillez renseigner les informations suivantes</p>
        <div>
          <form action="infos.php" method="POST" class="form">
            <div data-step="1" id="form-step-1">
              <div class="form__text">
                <input class="input input--text input--step1" type="text" name="name" id="" placeholder="Nom">
                <label class="label label--text" for="name">Votre nom</label>
              </div> 
              <div class="form__text">
                <input class="input input--text input--step1" type="text" name="firstname" id="" placeholder="Prénom">
                <label class="label label--text" for="firstname">Votre prénom</label>
              </div>
              <div class="form__text">
                <input class="input input--text input--step1" type="mail" name="email" id="input-email" placeholder="Email">
                <label class="label label--text" for="email">Votre email</label>
              </div>
              <div class="form__file">
                <label for="image">Prenez une photo de vous-même</label>
              </div>
              <button class="btn" id="nextStep">Suivant</button>
            </div>
            <div data-step="2" id="form-step-2" class="invisible">
              <div class="form__select">
                <select name="visite" id="visitOptions" class="input">
                  <option value="">Sélectionnez une option</option>
                  <option value="training">Suivre une formation</option>
                  <option value="meeting">Rencontrer une personne</option>
                </select>
                <label class="label label--select">Type de visite</label>
              </div>
              <div id="trainingOption" class="form__select invisible">
                <select name="training" id="trainingList"></select>
                <label form="training" class="label label--select">Choisir sa formation</label>
              </div>
              <div id="meetingOption" class="invisible">
                <input class="input input--text" type="text" name="crewmember" id="crewmember-search">
                <label for="">Veuillez entrer le nom de votre formateur</label>
                <ul id="crewmember-answer"></ul>
              </div>
              <button class="btn" type="submit" id="submitForm">Envoyer</button>
            </div>
            <div id="alertbox"></div>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
<script id="scriptTag" src="./scripts/bundle.js"></script>
</html>

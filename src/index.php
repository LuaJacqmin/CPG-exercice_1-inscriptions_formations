<?php
  include('header.php');
  if(isset($_POST)):
    unset($_POST);
  endif;
?>
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
                <input type="file" name="picture" id="picture" capture>
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
                <input type="hidden" name="room">
              </div>
              <div id="meetingOption" class="invisible">
                <input class="input input--text" type="text" name="crewmember" id="crewmember-search">
                <label for="">Veuillez entrer le nom de votre formateur</label>
                <ul id="crewmember-answer"></ul>
              </div>
              <input type="hidden" name="room" id="inputRoom">
              <input type="hidden" name="link" id="inputLink">
              <button class="btn" type="submit" id="submitForm">Envoyer</button>
            </div>
            <div id="alertbox"></div>
          </form>
        </div>
      </div>
    </section>
  </main>
</body>
<?php include("footer.php") ?>

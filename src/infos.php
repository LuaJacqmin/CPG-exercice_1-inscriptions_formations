<?php include('header.php');   ?>

<?php
  // var_dump($_POST);
  //check if guest is already in the db 
    $get_guest = sprintf(
      "SELECT * FROM `lj_guests` WHERE email='%s'",
      $_POST['email']
    );

    $guest = $connect->query($get_guest);
    echo $connect->error;

  //if not, insert new guest
    if($guest->num_rows === 0):
      $post_guest = sprintf(
        "INSERT INTO `lj_guests` SET name='%s', firstname='%s', email='%s', picture='%s'",
        $_POST['name'],
        $_POST['firstname'],
        $_POST['email'],
        $_POST['picture']
      );

      $connect->query($post_guest);
      echo $connect->error;

      $guest = $connect->query($get_guest);
      echo $connect->error;
    endif;

  //get id of guest
  if($guest->num_rows > 0):
    while($oneElement = $guest->fetch_array()):
      $guest_elements[] = $oneElement;
    endwhile;
  endif;


  //insert visit
    $post_visit = sprintf(
      "INSERT INTO `lj_visites` SET id_guests=%d, link='%s'",
      $guest_elements[0]['id_guests'],
      $_POST['visit'] === "training" ? $_POST['training']  : $_POST['meeting']
    );

    $connect->query($post_visit);
    $idvisits = $connect->insert_id;
    // echo $idvisits;
    echo $connect->error;
?>

<body>
  <h1>Cepegra</h1>
  <main>
    <section class="wrapper wrapper--full">
    <div>
      <h2><?php echo $_POST['firstname']?> <?php echo $_POST['name']?></h2>
      <div>
        <?php 
           QRcode::png($idvisits) ;
        ?>
      </div>
      <p><?php echo $idvisits ?></p>

      <?php if($_POST['visit'] === "training" ): ?>
        <!-- get all infos about lessons at firebase url -->
        <?php 
          $url = $_POST['training'];
          $json = file_get_contents($url);
          $data = json_decode($json);

          $coursURL = "https://firestore.googleapis.com/v1/" . $data->fields->cours->referenceValue;
          $jsonCours = file_get_contents($coursURL);
          $dataCours = json_decode($jsonCours);
        ?>
        <p>Cours : <?php echo $dataCours->fields->label->stringValue; ?></p>
       
      <?php else: ?>
        <!-- get all infos about person at firebase url -->
        <?php 
          $url = $_POST['meeting'];
          $json = file_get_contents($url);
          $data = json_decode($json);
        ?>
        <p>Vous avez RDV avec <?php echo $data->fields->prenom->stringValue; ?> <?php echo $data->fields->nom->stringValue; ?></p>
        <p>N° de téléphone : <?php echo $data->fields->tel->stringValue; ?></p>
      <?php endif; ?>
      <p>Salle : <?php echo $data->fields->salle->stringValue; ?></p>
    </div>
    <a href="sortie.php">Sortir</a>
    </section>
  </main>
</body>
<?php include('footer.php'); ?>

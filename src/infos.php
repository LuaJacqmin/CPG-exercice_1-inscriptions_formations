<?php include('header.php'); ?>

<?php
var_dump($_POST);
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
    "INSERT INTO `lj_visites` SET id_guests=%d, type='%s', training='%s', crewmember='%s', link='%s', room='%s'",
    $guest_elements[0]['id_guests'],
    $_POST['visite'],
    $_POST['visite']  === "training" ? $_POST['training'] : NULL,
    $_POST['visite']  === "training" ? NULL : $_POST['crewmember'],
    "https://firestore.googleapis.com/v1/".$_POST['link'],
    $_POST['room']
  );

  $connect->query($post_visit);
  echo $connect->error;
?>

<body>
  <h1>Cepegra</h1>
  <main>
    <section class="wrapper wrapper--full">

    <div>
      <h2><?php echo $_POST['firstname']?> <?php echo $_POST['name']?></h2>
      <div>QR CODE</div>
      <small>KEY</small>
      
      <?php if($_POST['visite'] === "meeting"): ?>
      <p>Vous avez rendez-vous avec <span style="text-transform: capitalize"><?php echo $_POST['crewmember']?></span></p>
      <script>
        axios.get("<?php echo "https://firestore.googleapis.com/v1/".$_POST['link']; ?>")
        .then(personnel =>{
          console.log(personnel)
          const phone = document.querySelector("#phone");
          phone.innerHTML = personnel.data.fields.tel.stringValue;
        })
      </script>
      <p>Téléphone : <span id="phone"></span></p>
      <?php else: ?>
        <p>Cours : <?php  echo $_POST['training']?></p>
      <?php endif; ?>
      <p>Salle : <?php echo $_POST['room']?></p>
      <p></p>
    </div>
      
    </section>
  </main>
</body>
<?php include('footer.php'); ?>

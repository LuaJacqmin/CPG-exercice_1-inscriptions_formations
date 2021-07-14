<?php include('header.php'); ?>
<body>
  <section class="wrapper wrapper--ful">
    <?php if(!isset($_POST['idvisit'])): ?>
      <!-- si idvisit est vide (!isset = est vide. isset = est plein) -->
    <h2>Encodez l'id de votre visite</h2>
    <form action="sortie.php" method="POST">
      <input type="text" name="idvisit" placeholder="numéro de visite" class="input input--text">
      <button class="btn">Laissez moi sortir wsh</button>
    </form>
    <?php else: ?>
    <?php 
    /* get info about visit*/
        $get_visit = sprintf(
          "SELECT * FROM `lj_visites` where id_visits=%d",
          $_POST['idvisit']
        );

        $visitData = $connect->query($get_visit);
        echo $connect->error;
      
        if($visitData->num_rows > 0):
          while($oneElement = $visitData->fetch_array()):
            $visit[] = $oneElement;
          endwhile;
        endif;

    /* update leaving date */
        $leavingdate = date("Y-m-j H:i:s");
        // echo $leavingdate;
        $update_visit = sprintf(
          "UPDATE  `lj_visites` SET leavingdate='%s' WHERE id_visits=%d",
          $leavingdate,
          $_POST['idvisit']
        );
    ?>
      <?php 
      /* if no leavingdate is set */
        if(!isset($visit[0]['leavingdate'])):
          $connect->query($update_visit);
          echo $connect->error;
      ?>
        <p>Merci, à bientot !</p>
      <?php else :?>
        <p>Cette visite a déjà expiré</p>
        <h2>Encodez l'id de votre visite</h2>
        <form action="sortie.php" method="POST">
          <input type="text" name="idvisit" placeholder="numéro de visite" class="input input--text">
          <button class="btn">Laissez moi sortir wsh</button>
        </form>
      <?php endif;?>
    <?php endif; ?>
  </section>
</body>

<?php include('footer.php'); ?>
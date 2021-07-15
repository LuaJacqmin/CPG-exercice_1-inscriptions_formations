<?php include('header.php'); ?>
<body data-page="scan">
  <section class="wrapper wrapper--ful">
    <?php if(!isset($_POST['idvisit'])): ?>
      <!-- si idvisit est vide (!isset = est vide. isset = est plein) -->
    <h2>Encodez l'id de votre visite</h2>
    <form action="scan.php" method="POST" class="wrapper">
      <input type="text" id="inputId" name="idvisit" placeholder="numéro de visite" class="input--text">
      <button id="scanStartBtn">Ou activer la caméra</button>
      <div>
        <video width="320" height="240" id="scanPreview" src="" class="invisible" autoplay="true"></video>
        <button id="frontcamBtn" class="btn">Caméra frontale</button>
        <button id="backcamBtn" class="btn">Caméra Arrière</button>
      </div>
      <button class="btn">Laissez moi sortir wsh</button>
    </form>
    <?php else: ?>
      <!-- si un id est encodé -->
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
    if(isset($visit)):
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
        $test = $connect->query($update_visit);
        echo $connect->error;
      ?>
      <p>Merci, à bientot !</p>
    <?php else: ?>
      <h2>Cet id a expiré</h2>
        <form action="scan.php" method="POST" class="wrapper">
          <input type="text" id="inputId" name="idvisit" placeholder="numéro de visite" class="input--text">
          <button id="scanStartBtn">Ou activer la caméra</button>
          <div>
            <video width="320" height="240" id="scanPreview" src="" class="invisible" autoplay="true"></video>
            <button id="frontcamBtn" class="btn">Caméra frontale</button>
            <button id="backcamBtn" class="btn">Caméra Arrière</button>
          </div>
          <button class="btn">Laissez moi sortir wsh</button>
        </form>
    <?php endif; ?>
    <?php else: ?>
        <h2>Cette visite n'existe pas</h2>
        <form action="scan.php" method="POST" class="wrapper">
          <input type="text" id="inputId" name="idvisit" placeholder="numéro de visite" class="input--text">
          <button id="scanStartBtn">Ou activer la caméra</button>
          <div>
            <video width="320" height="240" id="scanPreview" src="" class="invisible" autoplay="true"></video>
            <button id="frontcamBtn" class="btn">Caméra frontale</button>
            <button id="backcamBtn" class="btn">Caméra Arrière</button>
          </div>
          <button class="btn">Laissez moi sortir wsh</button>
        </form>
      <?php endif;?>
    <?php endif; ?>
  </section>
</body>

<?php include('footer.php'); ?>

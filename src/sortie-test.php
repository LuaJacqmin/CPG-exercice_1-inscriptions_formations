<?php include('header.php'); ?>
<!-- make it after if all is finished -->
<body>
  <section class="wrapper wrapper--ful">
     <!-- si idvisit est vide (!isset = est vide. isset = est plein) -->
    <?php if(!isset($_POST['idvisit'])): ?>
    <h2>Encodez l'id de votre visite</h2>
    <form action="scan.php" method="POST">
      <input type="text" name="idvisit" placeholder="numéro de visite" class="input input--text">
      <button class="btn">Lancer le scan</button>
    </form>
    <!-- si id visite existe -->
    <?php else: ?>
    <?php
      /* aller chercher dans la db toutes les visites ayant l'id_first_visit correspondant */ 
      $get_all_visits = sprintf(
        "SELECT * FROM `lj_visites` WHERE id_first_visit=%d",
        $_POST['idvisit']
      );

      $data_visits = $connect->query($get_all_visits);
      echo $connect->error;

      // var_dump($data_visits);

      while($element = $data_visits->fetch_object()):
        $all_visits[] = $element;
      endwhile;

      // echo "<pre>";
      // var_dump($all_visits);
      // echo "</pre>";

      /* récupérer l'entrée la plus récente */
      $recentEntry = [];
      $recentDate = $all_visits[0]->entrydate;

      /* date plus récente > date plus ancienne */
      echo "nombre de visites = " . $data_visits->num_rows;
      $i = 0;
      while($i < count($all_visits)):
          if($all_visits[$i]->entrydate > $recentDate):
            $recentDate = $all_visits[$i]->entrydate;

            while($element = $all_visits[$i]->fetch_object()):
              $recentEntry[] = $element;
            endwhile;
          endif;
        $i++;
      endwhile;
      var_dump($recentEntry);
      echo $recentDate;

      /* rechercher la visite la plus récente */
    ?>
    <?php endif; ?>
  </section>
</body>

<?php include('footer.php'); ?>
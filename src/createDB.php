<?php 
if ($result = $connect->query("SHOW TABLES LIKE 'LJ_guests'")) {
  if(!$result->num_rows == 1) {
    $firstReq = "CREATE TABLE `LJ_guests` (
      `id_guests` mediumint(9) NOT NULL,
      `name` varchar(60) NOT NULL,
      `firstname` varchar(60) NOT NULL,
      `email` varchar(100) NOT NULL,
      `visite` varchar(25) NOT NULL,
      `crewmember` varchar(100) NOT NULL,
      `training` varchar(150) NOT NULL,
      `entrydate` date NOT NULL,
      `leavingdate` date NOT NULL,
      `codeexpiration` date NOT NULL
    )";
    
    $req = $connect->query($firstReq);
    echo $connect->error;
  }
}


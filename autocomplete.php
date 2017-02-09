<?php

  include("connexion_bd.php"); /* ESTABLISH CONNECTION IN THIS FILE; MAKE SURE THAT IT IS mysqli_* */

  $stmt = $con->prepare("SELECT user FROM membres"); /* START PREPARED STATEMENT */
  $stmt->execute(); /* EXECUTE THE QUERY */
  $stmt->bind_result($description); /* BIND THE RESULT TO THIS VARIABLE */
  while($stmt->fetch()){ /* FETCH ALL RESULTS */
    $description_arr[] = $description; /* STORE EACH RESULT TO THIS VARIABLE IN ARRAY */
  } /* END OF WHILE LOOP */

  echo json_encode($description_arr); /* ECHO ALL THE RESULTS */

?>
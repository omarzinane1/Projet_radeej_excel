<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
  <title>Formulaire avec tableau et boutons</title>
  <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="tritement.css">
</head>

<body>
  <form action="home.php">
    <button class="btn" type="submit" name="Accueil">Accueil</button>
  </form>
  <h2> Traitement De Fichier Technique Relative Au Calcul Des Surfaces</h2>
  <?php

  include("dbconfig.php");
  // section de tritement de données 

  // modification

  if (isset($_POST['update'])) {
    $N_lot = $_POST['N_lot'];
    $usage = $_POST['usage'];
    $Nature = $_POST['Nature'];
    $surface_lot = $_POST['surface_lot'];
    $S_sol = $_POST['S_sol'];
    $RDC = $_POST['RDC'];
    $Mezzanine = $_POST['Mezzanine'];
    $per_etage = $_POST['per_etage'];
    $deue_etage = $_POST['deue_etage'];
    $troisi_etage = $_POST['troisi_etage'];
    $quatreme_etage = $_POST['quatreme_etage'];
    $cinq_etage = $_POST['cinq_etage'];
    $six_etage = $_POST['six_etage'];
    $sept_etage = $_POST['sept_etage'];
    $surface_total = $_POST['surface_total'];
    $surface_totalC = $_POST['surface_totalC'];
    $somme = $_POST['somme'];
    $S_Pv = $_POST['S_Pv'];
    $PVC = $_POST['PVC'];

    $sql = "UPDATE fichier_technique SET `usage_h`='$usage',`Nature`='$Nature',`surface_lot`='$surface_lot', `S_sol`='$S_sol', `RDC`='$RDC',`Mezzanine`='$Mezzanine', `per_etage`='$per_etage', `deue_etage`='$deue_etage', `troisi_etage`='$troisi_etage',`quatreme_etage`='$quatreme_etage',`cinq_etage`='$cinq_etage',`six_etage`='$six_etage',`sept_etage`='$sept_etage', `surface_total`='$surface_total', `surface_totalC`='$surface_totalC',`somme`= '$somme', `S_Pv`='$S_Pv',`PVC`='$PVC' WHERE `N_lot`='$N_lot'";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['message'] = "Les données ont été modifiées avec succès.";
    } else {
      $_SESSION['message'] = "Une erreur s'est produite lors de la modification des données.";
    }
  }

  // sepprission
  if (isset($_POST['delete'])) {
    $n_lot = $_POST['N_lot'];
    $req = mysqli_query($conn, "SELECT * FROM fichier_technique where N_lot = '$n_lot'");

    // Vérifier s'il y a des résultats
    if (mysqli_num_rows($req) == 0) {
      $_SESSION['message'] = "Il n'y a pas encore des données.";
      header("Location: page_calcule.php");
      exit();
    } else {

      // Récupérer les données et les insérer dans la nouvelle table
      $row = mysqli_fetch_assoc($req);
      $N_lot = $row['N_lot'];
      $usage = $row['usage_h'];
      $Nature = $row['Nature'];
      $surface_lot = $row['surface_lot'];
      $S_sol = $row['S_sol'];
      $RDC = $row['RDC'];
      $Mezzanine = $row['Mezzanine'];
      $per_etage = $row['per_etage'];
      $deue_etage = $row['deue_etage'];
      $troisi_etage = $row['troisi_etage'];
      $quatreme_etage = $row['quatreme_etage'];
      $cinq_etage = $row['cinq_etage'];
      $six_etage = $row['six_etage'];
      $sept_etage = $row['sept_etage'];
      $surface_total = $row['surface_total'];
      $surface_totalC = $row['surface_totalC'];
      $somme = $row['somme'];
      $S_Pv = $row['S_Pv'];
      $PVC = $row['PVC'];

      // Insérer les données dans la nouvelle table
      $Query = "INSERT INTO data_excel_file (`N_lot`, `usage_h`, `Nature`, `surface_lot`, `S_sol`, `RDC`, `Mezzanine`, `per_etage`, `deue_etage`, `troisi_etage`, `quatreme_etage`, `cinq_etage`, `six_etage`, `sept_etage`, `surface_total`, `surface_totalC`, `somme`, `S_Pv`, `PVC`)
       VALUES ('$N_lot', '$usage','$Nature','$surface_lot','$S_sol', '$RDC','$Mezzanine', '$per_etage', '$deue_etage', '$troisi_etage',' $quatreme_etage','$cinq_etage','$six_etage','$sept_etage', '$surface_total', '$surface_totalC','$somme', '$S_Pv','$PVC')";
      $result = mysqli_query($conn, $Query);

      if (!$result) {
        $_SESSION['message'] = "Une erreur est survenue lors de la récupération des données après la suppression.";
        header("Location: page_calcule.php");
        exit();
      }
    }


    $sql = "DELETE FROM fichier_technique WHERE `N_lot`='$n_lot'";
    if (mysqli_query($conn, $sql)) {
      $_SESSION['message'] = "Les données ont été supprimées avec succès.";
    } else {
      $_SESSION['message'] = "Une erreur s'est produite lors de la suppression des données.";
    }
  }
  ?>
  <div class="continte_form">
  <form method="POST">
    <table id="myTable">
      <div class="message-container">
        <?php
        if (isset($_SESSION['message'])) {
          echo "<h4 class='message'>" . $_SESSION['message'] . '<button class="close-button" ><i class="fa-solid fa-xmark"></i></button></h4>';
          unset($_SESSION['message']);
        }
        ?>
      </div>
      <thead>
        <tr>
          <th>N°_Lot</th>
          <th>Usage d'habitation</th>
          <th>Nature</th>
          <th>Surface_lot</th>
          <th>_S/sol_</th>
          <th>_RDC_</th>
          <th>Mezzanine</th>
          <th>1er_étage</th>
          <th>2éme_étage</th>
          <th>3éme_étage</th>
          <th>4éme_étage</th>
          <th>5éme_étage</th>
          <th>6éme_étage</th>
          <th>7éme_étage</th>
          <th>Total_H</th>
          <th>Total_C</th>
          <th>Total(H+C)</th>
          <th>Prix_DH</th>
          <th>Prix_DH</th>
          <th>Modifier</th>
          <th>Supprimer</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Inclure le fichier de configuration de la base de données
        include('dbconfig.php');

        // Sélectionner toutes les lignes de la table "fichier_technique" où le champ "usage" commence par "R+"
        $req = mysqli_query($conn, "SELECT * FROM fichier_technique");

        // Vérifier s'il y a des résultats
        if (mysqli_num_rows($req) == 0) {
          // S'il n'y a pas de données, afficher un message
          echo '<tr><td colspan="21">Il n\'y a pas encore de données</td></tr>';
        } else {
          // Sinon, afficher les données existantes
          while ($row = mysqli_fetch_assoc($req)) {
            if (isset($_GET['N_lot']) && $_GET['N_lot'] == $row['N_lot']) {
              // Si le paramètre N_lot est présent dans l'URL et correspond à la ligne en cours de traitement,
              // afficher le formulaire de modification

              echo '<form method="POST" action="">';
              echo '<tr>';
              echo '<td> <input type="text" name="N_lot" value="' . $row['N_lot'] . '"> </td>';
              echo '<td> <input type="text" name="usage" value="' . $row['usage_h'] . '"> </td>';
              echo '<td> <input type="text" name="Nature" value="' . $row['Nature'] . '"> </td>';
              echo '<td> <input type="text" name="surface_lot" value="' . $row['surface_lot'] . '"> </td>';
              echo '<td> <input type="text" name="S_sol" value="' . $row['S_sol'] . '"> </td>';
              echo '<td> <input type="text" name="RDC" value="' . $row['RDC'] . '"> </td>';
              echo '<td> <input type="text" name="Mezzanine" value="' . $row['Mezzanine'] . '"> </td>';
              echo '<td> <input type="text" name="per_etage" value="' . $row['per_etage'] . '"> </td>';
              echo '<td> <input type="text" name="deue_etage" value="' . $row['deue_etage'] . '"> </td>';
              echo '<td> <input type="text" name="troisi_etage" value="' . $row['troisi_etage'] . '"> </td>';
              echo '<td> <input type="text" name="quatreme_etage" value="' . $row['quatreme_etage'] . '"> </td>';
              echo '<td> <input type="text" name="cinq_etage" value="' . $row['cinq_etage'] . '"> </td>';
              echo '<td> <input type="text" name="six_etage" value="' . $row['six_etage'] . '"> </td>';
              echo '<td> <input type="text" name="sept_etage" value="' . $row['sept_etage'] . '"> </td>';
              echo '<td> <input type="text" name="surface_total" value="' . $row['surface_total'] . '"> </td>';
              echo '<td> <input type="text" name="surface_totalC" value="' . $row['surface_totalC'] . '"> </td>';
              echo '<td> <input type="text" name="somme" value="' . $row['somme'] . '"> </td>';
              echo '<td> <input type="text" name="S_Pv" value="' . $row['S_Pv'] . '"> </td>';
              echo '<td> <input type="text" name="PVC" value="' . $row['PVC'] . '"> </td>';
              echo '<td> <button type="submit" name="update">Modifier</button> </td>';
              echo '<td> <button type="submit" name="delete">Supprimer</button> </td>';
              echo '</tr>';
              echo '</form>';
            } else {
              // Afficher les données existantes avec un lien pour la modification
              echo '<tr>';
              echo '<td>' . $row['N_lot'] . '</td>';
              echo '<td>' . $row['usage_h'] . '</td>';
              echo '<td>' . $row['Nature'] . '</td>';
              echo '<td>' . $row['surface_lot'] . '</td>';
              echo '<td>' . $row['S_sol'] . '</td>';
              echo '<td>' . $row['RDC'] . '</td>';
              echo '<td>' . $row['Mezzanine'] . '</td>';
              echo '<td>' . $row['per_etage'] . '</td>';
              echo '<td>' . $row['deue_etage'] . '</td>';
              echo '<td>' . $row['troisi_etage'] . '</td>';
              echo '<td>' . $row['quatreme_etage'] . '</td>';
              echo '<td>' . $row['cinq_etage'] . '</td>';
              echo '<td>' . $row['six_etage'] . '</td>';
              echo '<td>' . $row['sept_etage'] . '</td>';
              echo '<td>' . $row['surface_total'] . '</td>';
              echo '<td>' . $row['surface_totalC'] . '</td>';
              echo '<td>' . $row['somme'] . '</td>';
              echo '<td>' . $row['S_Pv'] . '</td>';
              echo '<td>' . $row['PVC'] . '</td>';
              echo '<td><a type="submit" name="update" href="?N_lot=' . $row['N_lot'] . '">Modifier</a></td>';
              echo '<td><a type="submit" name="delete" href="?N_lot=' . $row['N_lot'] . '">Supprimer</a></td>';
              echo '</tr>';
            }
          }
        }

        echo '</table>';

        mysqli_free_result($req);
        mysqli_close($conn);
        ?>
      </tbody>
    </table>
  </form>
  </div>


</body>
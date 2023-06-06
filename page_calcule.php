<?php session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="page_afichier.css">
    <title>Document</title>
</head>

<body style="background-color: #f8f8f8;">
    <div class="meun_btn">

        <form action="home.php">
            <button class="btn" type="submit" name="Accueil">Accueil</button>
        </form>


        <form method="post" action="controle.php">
            <button class="btn" type="submit" name="calcule_ligne">Surface plancher Total en m²</button>
        </form>


        <form method="post" action="">
            <span><button class="btn" type="submit" name="modifier_value">Modifier PV </button></span>
        </form>

        <form method="post" action="">
            <span><button class="btn" type="submit" name="supprimer">supprimer </button></span>
        </form>

        <form action="#">
            <button class="dontprint" id="Imprimer" onclick="window.print()">Imprimer</button>
        </form>

    </div>

    <div class="message-container">
        <?php if (isset($_SESSION['message'])) {
            echo "<h4 class='message'>" . $_SESSION['message'] . '<button class="close-button" ><i class="fa-solid fa-xmark"></i></button></h4>';
            unset($_SESSION['message']);
        } ?>
    </div>

    <?php

    /**********modifier les valuers te tpt tnt tbt */


    // Vérifier si le formulaire a été soumis
    if (isset($_POST['modifier_value'])) {

        //form de modification 

        echo '<form id="form_valeur" action="" method="post">
    <div class="continer_valeur">
        <div class="valeur_tous">
            <label for="Te">Economique  (Te):</label>
            <input class="input_valeur" type="text" name="te_Economique" value=""><br>

            <label for="Tnt">Individuel (Te):</label>
            <input class="input_valeur" type="text" name="Individuel" value=""><br>

            <label for="Immeuble">Immeuble (Te):</label>
            <input class="input_valeur" type="text" name="Immeuble" value=""><br>

            <label for="TBT">Villa S < = 400m² (Te):</label>
            <input class="input_valeur" type="text" name="Villainf" value=""><br>
        </div>
        <div class="valeur_tous">
            <label for="Te">Villa S>400m² (Te):</label>
            <input class="input_valeur" type="text" name="Villasup" value=""><br>

            <label for="Tnt">P_Touristique (Te):</label>
            <input class="input_valeur" type="text" name="Touristique" value=""><br>

            <label for="Tpt">U_Commercial (Te):</label>
            <input class="input_valeur" type="text" name="Commercial" value=""><br>

            <label for="TBT">U_Administratif (Te):</label>
            <input class="input_valeur" type="text" name="Administratif" value=""><br>
        </div>
        <div class="valeur_tous">
        
            <label for="Tnt">Tmt:</label>
            <input class="input_valeur" type="text" name="tnt" value=""><br>

            <label for="Tpt">Tpt:</label>
            <input class="input_valeur" type="text" name="tpt" value=""><br>

            <label for="TBT">TBT:</label>
            <input class="input_valeur" type="text" name="tBT" value=""><br>
        </div>
       
        <button class="btn_valeur" type="submit" name="modifier_value">Modifier</button>
        <button class="btn_valeur" onclick="actualiserPage()">Actualiser</button>

        <script>
            function actualiserPage() {
                location.reload(); // Cette fonction recharge la page actuelle
            }
        </script>
    </div>
</form>';
        if (isset($_POST['te_Economique']) || isset($_POST['Individuel']) || isset($_POST['Immeuble']) || isset($_POST['Villainf']) || isset($_POST['Villasup']) || isset($_POST['Touristique']) || isset($_POST['Commercial']) || isset($_POST['Administratif']) || isset($_POST['tnt']) || isset($_POST['tpt']) || isset($_POST['tBT'])) {
            // Récupérer les valeurs saisies dans les champs de texte

            $te_Economique = $_POST['te_Economique'];
            $Individuel = $_POST['Individuel'];
            $Immeuble = $_POST['Immeuble'];
            $Villainf = $_POST['Villainf'];
            $Villasup = $_POST['Villasup'];
            $Touristique = $_POST['Touristique'];
            $Commercial = $_POST['Commercial'];
            $Administratif = $_POST['Administratif'];
            $tnt = $_POST['tnt'];
            $tpt = $_POST['tpt'];
            $tBT = $_POST['tBT'];


            // Insérer les valeurs dans la base de données
            include_once "dbconfig.php";

            $query_update = "UPDATE `pv` SET TeEconomique = ?, TeIndividule = ?, TeImmeuble = ?, TeVillaInf = ?, TeVillaSup = ?, TeTouristique = ?, TeCommercial = ?, TeAdministratif = ?, Tmt = ?, Tpt = ?, Tbt = ? WHERE id = '1'";
            $stmt_update = $conn->prepare($query_update);
            $stmt_update->bind_param("iiiiiiiiiii", $te_Economique, $Individuel, $Immeuble, $Villainf, $Villasup, $Touristique, $Commercial, $Administratif, $tnt, $tpt, $tBT);

            if ($stmt_update->execute()) {

                $_SESSION['message'] = "Les valeurs ont été mises à jour avec succès.";
                header("Location: page_calcule.php");
                exit();
            } else {

                $_SESSION['message'] = "Une erreur s'est produite lors de la mise à jour des valeurs.";
                header("Location: page_calcule.php");
                exit();
            }
        }
    }



    /********************************************** */

    ?>

    <?php

    // Vérifier si le bouton "Supprimer" a été cliqué
    if (isset($_POST['supprimer'])) {
        // Afficher le formulaire de confirmation de suppression
        echo '
            <form id="recuperer" method="POST" action="">
            <h3>Êtes-vous sûr de vouloir récupérer ces données après la suppression ?</h3>
            <button type="submit" name="confirm" value="yes">Oui</button>
            <button type="submit" name="confirm" value="no">Non</button>
            </form>
        ';
    }
    // Vérifier si le bouton "Oui" de confirmation a été cliqué
    if (isset($_POST['confirm']) && $_POST['confirm'] == 'yes') {
        include_once "dbconfig.php";
        // Vérifier la connexion à la base de données
        if (!$conn) {
            $_SESSION['message'] = "Erreur de connexion à la base de données.";
            header("Location: page_calcule.php");
            exit();
        }

        // Récupérer les données et effectuer l'action de récupération
        $req = mysqli_query($conn, "SELECT * FROM fichier_technique");

        // Vérifier s'il y a des résultats
        if (mysqli_num_rows($req) == 0) {
            $_SESSION['message'] = "Il n'y a pas encore de données.";
            header("Location: page_calcule.php");
            exit();
        } else {
            // Récupérer les données et les insérer dans la nouvelle table
            while ($row = mysqli_fetch_assoc($req)) {
                $N_lot = $row['N_lot'];
                $usage = $row['usage'];
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

            // Supprimer les données de la table actuelle
            $query = "TRUNCATE TABLE fichier_technique";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['message'] = "Les données ont été supprimées avec succès.";
                header("Location: page_calcule.php");
                exit();
            } else {
                $_SESSION['message'] = "Une erreur s'est produite lors de la suppression des données.";
                header("Location: page_calcule.php");
                exit();
            }
        }
        // Rediriger ou afficher un message de succès
        header("Location: page_calcule.php");
        exit();
    } elseif (isset($_POST['confirm']) && $_POST['confirm'] == 'no') {
        //include la base de donnée
        include_once "dbconfig.php";
        // Actions si le bouton "Non" de confirmation a été cliqué
        $query = "TRUNCATE TABLE fichier_technique";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $_SESSION['message'] = "Les données ont été supprimées avec succès.";
            header("Location: page_calcule.php");
            exit();
        } else {
            $_SESSION['message'] = "Une erreur s'est produite lors de la suppression des données.";
            header("Location: page_calcule.php");
            exit();
        }
        // ...
    }
    ?>
    <header>
        <h3 id="titre_grand">Fichier technique relative au calcul des surfaces</h3>
    </header>

    <div id="printable">


        <table style="overflow: scroll;">
            <thead>

                <tr>
                    <th>N°</th>
                    <th>Usage d'habitation</th>
                    <th>Nature</th>
                    <th>Surface de lot</th>
                    <th>S/sol</th>
                    <th>RDC</th>
                    <th>Mezzanine</th>
                    <th>1 er étage</th>
                    <th>2éme étage</th>
                    <th>3éme étage</th>
                    <th>4éme étage</th>
                    <th>5éme étage</th>
                    <th>6éme étage</th>
                    <th>7éme étage</th>
                    <th>Total H</th>
                    <th>Total C</th>
                    <th>Total(H+C)</th>
                    <th>DH</th>
                    <th>DH</th>
                    <th>Prix</th>

                </tr>
            </thead>
            <tbody>

                <form action="controle.php" method="post">
                    <?php
                    include_once "dbconfig.php";

                    $req = mysqli_query(
                        $conn,
                        "SELECT * FROM fichier_technique"
                    );

                    if (mysqli_num_rows($req) == 0) {
                        //s'il n'existe pas
                        echo '<tr><td colspan="20" style="text-align: center;">Il n\'y a pas encore des données</td></tr>';
                    } else {
                        //si non, affichons la liste 
                        $i = 0;
                        while ($row = mysqli_fetch_assoc($req)) {
                    ?>
                            <tr>
                                <td><?= $row['N_lot'] ?></td>
                                <td><?= $row['usage_h'] ?></td>
                                <td><?= $row['Nature'] ?></td>
                                <td><?= $row['surface_lot'] ?></td>
                                <td><?= $row['S_sol'] ?></td>
                                <td><?= $row['RDC'] ?></td>
                                <td><?= $row['Mezzanine'] ?></td>
                                <td><?= $row['per_etage'] ?></td>
                                <td><?= $row['deue_etage'] ?></td>
                                <td><?= $row['troisi_etage'] ?></td>
                                <td><?= $row['quatreme_etage'] ?></td>
                                <td><?= $row['cinq_etage'] ?></td>
                                <td><?= $row['six_etage'] ?></td>
                                <td><?= $row['sept_etage'] ?></td>
                                <td><?= $row['surface_total'] ?></td>
                                <td><?= $row['surface_totalC'] ?></td>
                                <td><?= $row['somme'] ?></td>
                                <td><?= $row['S_Pv'] ?></td>
                                <td><?= $row['PVC'] ?></td>
                                <td>
                                    <div class="continer_form">
                                        <div class="checkbox">
                                            <label for="Te">Te</label>
                                            <input type="checkbox" name="Te<?php echo $i; ?>" value="<?= $row['N_lot'] ?>"><br>

                                            <label for="Tmt">Tnt</label>
                                            <input type="checkbox" name="Tmt<?php echo $i; ?>" value="<?= $row['N_lot'] ?>"><br>

                                            <label for="Tpt">Tpt</label>
                                            <input type="checkbox" name="Tpt<?php echo $i; ?>" value="<?= $row['N_lot'] ?>"><br>

                                            <label for="TBT">TBT</label>
                                            <input type="checkbox" name="TBT<?php echo $i; ?>" value="<?= $row['N_lot'] ?>"><br>

                                            <select name="Type<?php echo $i; ?>">
                                                <option value="Double">D</option>
                                                <option value="habitation">H</option>
                                                <option value="commercial">C</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>

                            </tr>
                    <?php
                            $i++;
                        }
                    }
                    ?>

                    <button style="margin-top: 10px;" class="btnPV" type="submit" name="Valider" id="choisi_PV2">PV</button>
                </form>


            </tbody>
        </table>
    </div>

    <script src="test.js"></script>

</body>

</html>
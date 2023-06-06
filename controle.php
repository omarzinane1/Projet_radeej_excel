<?php
session_start();
include('dbconfig.php');

/*********** inscreption ******** */

if (isset($_POST['inscrire'])) {
    $nomcomplet = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);
    if ($password == $confirmPassword) {
        $query = "SELECT * FROM comptes";
        $query_run = mysqli_query($conn, $query);
        $num_ligne = mysqli_num_rows($query_run);
        $bool = 1;
        while ($ligne = mysqli_fetch_assoc($query_run)) {
            if ($ligne['email'] == $email) {
                $bool = 0;
            }
        }
        if ($bool == 1) {

            $query = "INSERT INTO comptes (id ,fullname,email,password,confirmPassword,date) VALUES 
            (null,'$nomcomplet', '$email','$password', '$confirmPassword',now())";
            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                $_SESSION['message'] = "Le compte a été créé avec succès";
                header("Location: inscription.php");
                exit(0);
            } else {
                $_SESSION['message'] = "Le compte n'a pas été créé";
                header("Location: inscription.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = "Email existe déja";
            header("Location: inscription.php");
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Les mots de passe ne correspondent pas. Veuillez réessayer.";
        header("Location: inscription.php");
        exit(0);
    }
}


/******************************** */

/***********login************* */

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $query = "SELECT * FROM comptes WHERE email='$email' AND password ='$password'";
    $query_run = mysqli_query($conn, $query);
    $num_ligne = mysqli_num_rows($query_run);
    if ($num_ligne > 0) {
        header("Location: home.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Nom utilisateur ou mot de  passe Incorrect !";
        header("Location: Login.php");
        exit(0);
    }
}
/***************************** */

/*$query = "SELECT * FROM data_excel_file WHERE local LIKE ?";

    $stmt = $conn->prepare($query);
    $local_search = $local . "%";
    $stmt->bind_param("s", $local_search);
    $stmt->execute();

    $result = $stmt->get_result();

    $num_ligne = mysqli_num_rows($result);
    $local = $_POST['options'];
    $_SESSION["option"] = $_POST['options'];*/

//la section de calcule de total de la surface
if (isset($_POST['calcule_ligne'])) {
    $query = "SELECT * FROM fichier_technique";
    $sql = $conn->prepare($query);
    $sql->execute();
    $result = $sql->get_result();
    $num_ligne = mysqli_num_rows($result);

    if ($num_ligne > 0) {

        while ($ligne = mysqli_fetch_assoc($result)) {
            $S_sol = $ligne['S_sol'];
            $RDC = $ligne['RDC'];
            $per_etage = $ligne['per_etage'];
            $deue_etage = $ligne['deue_etage'];
            $troisi_etage = $ligne['troisi_etage'];
            $quatreme_etage = $ligne['quatreme_etage'];
            $cinquieme_etage = $ligne['cinq_etage'];
            $sixieme_etage = $ligne['six_etage'];
            $septieme_etage = $ligne['sept_etage'];
            $usage_h = $ligne['usage_h'];
            $nature = $ligne['Nature'];


            $total_values = 0;

            $Total = 0;
            $Total1 = 0;
            $Total2 = 0;

            if ($usage_h == "R+2") {
                if ($nature == "Habitation") {
                    $Total = $RDC + $per_etage + $deue_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($usage_h == "R+3") {
                if ($nature == "Habitation" || $nature == "Immeuble") {
                    $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $troisi_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($usage_h == "R+4") {
                if ($nature == "Habitation" || $nature == "Immeuble") {
                    $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($usage_h == "R+5") {
                if ($nature == "Habitation" || $nature == "Immeuble") {
                    $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($usage_h == "R+6") {
                if ($nature == "Habitation" || $nature == "Immeuble") {
                    $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $sixieme_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $sixieme_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($usage_h == "R+7") {
                if ($nature == "Habitation" || $nature == "Immeuble") {
                    $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $sixieme_etage + $septieme_etage + $S_sol;
                } elseif ($nature == "Commerce") {
                    $Total1 = $per_etage + $deue_etage + $troisi_etage + $quatreme_etage  + $cinquieme_etage + $sixieme_etage + $septieme_etage + $S_sol;
                    $Total2 = $RDC;
                }
            } elseif ($nature == "Villa") {
                $Total = $RDC + $per_etage + $S_sol;
            } elseif ($nature == "commercial") {
                $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $sixieme_etage + $S_sol;
            } elseif ($nature == "Administratif") {
                $Total = $RDC + $per_etage + $deue_etage + $troisi_etage + $quatreme_etage + $cinquieme_etage + $sixieme_etage + $S_sol;
            }

            $total_values = $Total + $Total1 + $Total2;


            if ($nature == "Habitation" || $nature == "Immeuble") {
                $id = $ligne['N_lot'];
                $stmt = $conn->prepare("UPDATE fichier_technique SET surface_total = ? ,somme = ? WHERE N_lot = ?");
                $stmt->bind_param("ddi", $Total, $total_values, $id);
            } elseif ($nature == "Commerce") {
                $id = $ligne['N_lot'];
                $stmt = $conn->prepare("UPDATE fichier_technique SET surface_total = ?, surface_totalC = ? ,somme = ? WHERE N_lot = ?");
                $stmt->bind_param("dddi", $Total1, $Total2, $total_values, $id);
            } elseif ($nature == "Villa" || $nature == "commercial" || $nature == "Administratif") {
                $id = $ligne['N_lot'];
                $stmt = $conn->prepare("UPDATE fichier_technique SET surface_total = ?, somme = ? WHERE N_lot = ?");
                $stmt->bind_param("ddi", $Total, $total_values, $id);
            }
            $stmt->execute();
        }

        $_SESSION['message'] = "Le traitement de calcul est bien terminé.";
        header("Location: page_calcule.php");
        exit(0);
    } else {
        $_SESSION['message'] = "Il n'y a pas de données.";
        header("Location: page_calcule.php");
        exit(0);
    }
}


/* ******************* calcule de prix PV (te ,tnt ,tpt ,TBT) ****************************** */


if (isset($_POST['Valider'])) {
    include_once "dbconfig.php";

    $i = 0;
    $type = $_POST['Type' . $i];
    // Vérifier s'il y a des données dans la table "fichier_technique"
    $query_fichier = "SELECT * FROM fichier_technique ";
    $stmt_fichier = $conn->prepare($query_fichier);
    $stmt_fichier->execute();
    $result_fichier = $stmt_fichier->get_result();
    $num_ligne = mysqli_num_rows($result_fichier);

    if ($num_ligne == 0) {
        $_SESSION['message'] = "Il n'y a pas de données.";
        header("Location: page_calcule.php");
        exit(0);
    } else {
        $selected_values = []; // Initialisation du tableau des valeurs sélectionnées

        while ($ligne = mysqli_fetch_assoc($result_fichier)) {
            $s_pv = 0;
            $type = $_POST['Type' . $i];

            if ($type == "habitation" || $type == "commercial") {

                if ($type == "habitation") {
                    $surface_total = $ligne['surface_total'];
                } elseif ($type == "commercial") {
                    $surface_total = $ligne['surface_totalC'];
                    // si utilisateur selectionnée les deux options 
                }
                $query_valeurs = "SELECT * FROM pv ";
                $stmt_valeurs = $conn->prepare($query_valeurs);
                $stmt_valeurs->execute();
                $result_valeurs = $stmt_valeurs->get_result();
                $valeurs = mysqli_fetch_assoc($result_valeurs);

                // Calcul du S_Pv en fonction des valeurs sélectionnées par l'utilisateur
                $selected_values = [];
                $selected_valuesC = [];

                if (isset($_POST['Te' . $i])) {

                    if ($ligne['usage_h'] == "R+2"  && $surface_lot < 100) {
                        $selected_values[] = $valeurs['TeEconomique'];
                    } elseif ($ligne['usage_h'] == "R+2"  && $surface_lot > 100) {
                        $selected_values[] = $valeurs['TeIndividule'];
                    } elseif ($ligne['usage_h'] == "R+3" || $ligne['usage_h'] == "R+4" || $ligne['usage_h'] == "R+5" || $ligne['usage_h'] == "R+6" || $ligne['usage_h'] == "R+7"  || $ligne['Nature'] == "Immeuble") {
                        $selected_values[] = $valeurs['TeImmeuble'];
                    } elseif ($ligne['Nature'] == "Villa" && $surface_lot < 400) {
                        $selected_values[] = $valeurs['TeVillaInf'];
                    } elseif ($ligne['Nature'] == "Villa" && $surface_lot > 400) {
                        $selected_values[] = $valeurs['TeVillaSup'];
                    } elseif ($ligne['Nature'] == "Administratif") {
                        $selected_values[] = $valeurs['TeAdministratif'];
                    } elseif ($ligne['Nature'] == "commercial") {
                        $selected_values[] = $valeurs['TeCommercial'];
                    }
                }
                if (isset($_POST['Tmt' . $i])) {
                    $selected_values[] = $valeurs['Tmt'];
                }
                if (isset($_POST['Tpt' . $i])) {
                    $selected_values[] = $valeurs['Tpt'];
                }
                if (isset($_POST['TBT' . $i])) {
                    $selected_values[] = $valeurs['Tbt'];
                }

                $s_pv = $surface_total * array_sum($selected_values);

                // Mettre à jour la valeur de S_Pv dans la table "fichier_technique"
                $query_update = "UPDATE fichier_technique SET " . ($type == "habitation" ? "S_Pv" : "PVC") . " = ? WHERE N_lot = ?";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bind_param("di", $s_pv, $ligne['N_lot']);
                $stmt_update->execute();
            } elseif ($type == "Double") {
                $surface_total = $ligne['surface_total'];
                $surface_totalC = $ligne['surface_totalC'];
                $surface_lot = $ligne['surface_lot'];
                $query_valeurs = "SELECT * FROM pv ";
                $stmt_valeurs = $conn->prepare($query_valeurs);
                $stmt_valeurs->execute();
                $result_valeurs = $stmt_valeurs->get_result();
                $valeurs = mysqli_fetch_assoc($result_valeurs);
// test 
                if(){
                    
                }
                // Calcul du S_Pv en fonction des valeurs sélectionnées par l'utilisateur
                $selected_values = [];
                $selected_valuesC = [];

                if (isset($_POST['Te' . $i])) {

                    if ($ligne['usage_h'] == "R+2"  && $surface_lot < 100 && $ligne['Nature'] == "Habitation") {
                        $selected_values[] = $valeurs['TeEconomique'];
                    } elseif ($ligne['usage_h'] == "R+2" && $ligne['Nature'] == "Habitation" && $surface_lot > 100) {
                        $selected_values[] = $valeurs['TeIndividule'];
                    } elseif ($ligne['usage_h'] == "R+3" || $ligne['usage_h'] == "R+4" || $ligne['usage_h'] == "R+5" || $ligne['usage_h'] == "R+6" || $ligne['usage_h'] == "R+7"  || $ligne['Nature'] == "Immeuble") {
                        $selected_values[] = $valeurs['TeImmeuble'];
                    } elseif ($ligne['Nature'] == "Villa" && $surface_lot < 400) {
                        $selected_values[] = $valeurs['TeVillaInf'];
                    } elseif ($ligne['Nature'] == "Villa" && $surface_lot > 400) {
                        $selected_values[] = $valeurs['TeVillaSup'];
                    } elseif ($ligne['Nature'] == "Administratif") {
                        $selected_values[] = $valeurs['TeAdministratif'];
                    } elseif ($ligne['Nature'] == "commercial" || $ligne['Nature'] == "Commerce") {
                        $selected_valuesC[] = $valeurs['TeCommercial'];
                        
                    }
                }
                if (isset($_POST['Tmt' . $i])) {
                    $selected_values[] = $valeurs['Tmt'];
                    $selected_valuesC[] = $valeurs['Tmt'];
                }
                if (isset($_POST['Tpt' . $i])) {
                    $selected_values[] = $valeurs['Tpt'];
                    $selected_valuesC[] = $valeurs['Tpt'];
                }
                if (isset($_POST['TBT' . $i])) {
                    $selected_values[] = $valeurs['Tbt'];
                    $selected_valuesC[] = $valeurs['Tbt'];
                }

                $s_pv = $surface_total * array_sum($selected_values);
                $PVC = $surface_totalC * array_sum($selected_valuesC);

                // Mettre à jour la valeur de S_Pv dans la table "fichier_technique"
                $query_update = "UPDATE fichier_technique SET S_Pv= ? , PVC = ? WHERE N_lot = ?";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bind_param("ddi", $s_pv, $PVC, $ligne['N_lot']);
                $stmt_update->execute();
            }

            $i++;
        }
        $_SESSION['message'] = "Le traitement a été effectué avec succès.";
        header("Location: page_calcule.php");
        exit(0);
    }
}











/* **************************************************************************************** */



//section de PV version prencipale


/* if (isset($_POST['Valider'])) {
    include_once "dbconfig.php";

    $i = 0;
    $type = $_POST['Type' . $i];
    // Vérifier s'il y a des données dans la table "fichier_technique"
    $query_fichier = "SELECT * FROM fichier_technique ";
    $stmt_fichier = $conn->prepare($query_fichier);
    $stmt_fichier->execute();
    $result_fichier = $stmt_fichier->get_result();
    $num_ligne = mysqli_num_rows($result_fichier);

    if ($num_ligne == 0) {
        $_SESSION['message'] = "Il n'y a pas de données.";
        header("Location: page_calcule.php");
        exit(0);
    } else {
        $selected_values = []; // Initialisation du tableau des valeurs sélectionnées

        while ($ligne = mysqli_fetch_assoc($result_fichier)) {
            $s_pv = 0;
            $type = $_POST['Type' . $i];

            if ($type == "habitation" || $type == "commercial") {

                if ($type == "habitation") {
                    $surface_total = $ligne['surface_total'];
                } elseif ($type == "commercial") {
                    $surface_total = $ligne['surface_totalC'];
                    // si utilisateur selectionnée les deux options 
                }
                $query_valeurs = "SELECT * FROM valeurs WHERE ligne = ?";
                $stmt_valeurs = $conn->prepare($query_valeurs);

                if ($surface_total < 100) {
                    $ligne_valeurs = 'ligne1';
                } else {
                    $ligne_valeurs = 'ligne2';
                }

                $stmt_valeurs->bind_param("s", $ligne_valeurs);
                $stmt_valeurs->execute();
                $result_valeurs = $stmt_valeurs->get_result();
                $valeurs = mysqli_fetch_assoc($result_valeurs);

                // Calcul du S_Pv en fonction des valeurs sélectionnées par l'utilisateur
                $selected_values = [];

                if (isset($_POST['Te' . $i])) {
                    
                    $selected_values[] = $valeurs['Te'];
                }
                if (isset($_POST['Tnt' . $i])) {
                    $selected_values[] = $valeurs['Tnt'];
                }
                if (isset($_POST['Tpt' . $i])) {
                    $selected_values[] = $valeurs['Tpt'];
                }
                if (isset($_POST['TBT' . $i])) {
                    $selected_values[] = $valeurs['TBT'];
                }

                $s_pv = $surface_total * array_sum($selected_values);

                // Mettre à jour la valeur de S_Pv dans la table "fichier_technique"
                $query_update = "UPDATE fichier_technique SET " . ($type == "habitation" ? "S_Pv" : "PVC") . " = ? WHERE N_lot = ?";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bind_param("di", $s_pv, $ligne['N_lot']);
                $stmt_update->execute();

            } elseif ($type == "Double") {
                $surface_total = $ligne['surface_total'];
                $surface_totalC = $ligne['surface_totalC'];
                $query_valeurs = "SELECT * FROM valeurs WHERE ligne = ?";
                $stmt_valeurs = $conn->prepare($query_valeurs);

                if ($surface_total < 100 && $surface_totalC < 100) {
                    $ligne_valeurs = 'ligne1';
                } else {
                    $ligne_valeurs = 'ligne2';
                }

                $stmt_valeurs->bind_param("s", $ligne_valeurs);
                $stmt_valeurs->execute();
                $result_valeurs = $stmt_valeurs->get_result();
                $valeurs = mysqli_fetch_assoc($result_valeurs);

                // Calcul du S_Pv en fonction des valeurs sélectionnées par l'utilisateur
                $selected_values = [];

                if (isset($_POST['Te' . $i])) {
                    $selected_values[] = $valeurs['Te'];
                }
                if (isset($_POST['Tnt' . $i])) {
                    $selected_values[] = $valeurs['Tnt'];
                }
                if (isset($_POST['Tpt' . $i])) {
                    $selected_values[] = $valeurs['Tpt'];
                }
                if (isset($_POST['TBT' . $i])) {
                    $selected_values[] = $valeurs['TBT'];
                }

                $s_pv = $surface_total * array_sum($selected_values);
                $PVC = $surface_totalC * array_sum($selected_values);

                // Mettre à jour la valeur de S_Pv dans la table "fichier_technique"
                $query_update = "UPDATE fichier_technique SET S_Pv= ? , PVC = ? WHERE N_lot = ?";
                $stmt_update = $conn->prepare($query_update);
                $stmt_update->bind_param("ddi", $s_pv, $PVC, $ligne['N_lot']);
                $stmt_update->execute();
            }



            $i++;
        }
        $_SESSION['message'] = "Le traitement a été effectué avec succès.";
        header("Location: page_calcule.php");
        exit(0);
    }
}*/

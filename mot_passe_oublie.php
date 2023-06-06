<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Login.css">
    <title>Mot de passe oublié</title>
</head>

<body>
    <div class="message-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<h4 class='message'>" . $_SESSION['message'] . '<button class="close-button" ><i class="fa-solid fa-xmark"></i></button></h4>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <form method="post">
        <div class="oublie_pass">
            <h2>Mot de passe oublié</h2>
            <p>Entrez votre adresse e-mail pour réinitialiser votre mot de passe :</p>
            <input type="email" name="email" placeholder="Adresse e-mail">
            <input name="Reinitialiser" type="submit" value="Réinitialiser le mot de passe">
        </div>
        <a class="inscrire" href="Login.php">Identifier >></a>
    </form>

    <?php
    include("dbconfig.php");
    if (isset($_POST['Reinitialiser'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $sql = "SELECT * FROM compte WHERE email= '$email'";
        $query_run = mysqli_query($conn, $sql);
        $num_ligne = mysqli_num_rows($query_run);
        if ($num_ligne > 0) {
            $ligne = mysqli_fetch_assoc($query_run);

            $password = $ligne['password'];

            $message = "Bonjour, voici votre mot de passe : $password";
            $headers = 'Content-Type: text/plain; charset="utf-8"' . " ";

            if (mail($_POST['email'], 'Mot de passe oublié', $message, $headers)) {
                $_SESSION['message'] = "Message Envoyé A Votre Adress Mail";
                header("Location: mot_passe_oublie.php");
                exit(0);
            } else {
                $_SESSION['message'] = " Email inconnu ";
                header("Location: mot_passe_oublie.php");
                exit(0);
            }
        } else {
            $_SESSION['message'] = " Email inconnu ";
            header("Location: mot_passe_oublie.php");
            exit(0);
        }
    }

    ?>
    <script src="file.js"></script>
</body>

</html>
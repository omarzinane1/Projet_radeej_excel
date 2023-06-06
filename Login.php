<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Page de connexion</title>
    <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="Login.css">
</head>

<body>
    <!-- Contenu de la page -->
    <div class="message-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<h4 class='message'>" . $_SESSION['message'] . '<button class="close-button" ><i class="fa-solid fa-xmark"></i></button></h4>';
            unset($_SESSION['message']);
        }
        ?>
    </div>
    <form id="formlogin" action="controle.php" method="post">
        <div class="contenu_form">
            <img src="70604266_2767483299950342_158569754481655808_n.jpg" alt="">
            <input type="email" name="email" placeholder="Adresse e-mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" name="login" value="Se connecter">
        </div>
        <a type="submit" name="oublie" href="mot_passe_oublie.php">Mot de passe oublié?</a>
        <a class="inscrire" href="inscription.php">S'inscrire</a>
    </form>



    <script src="file.js"></script>
</body>

</html>
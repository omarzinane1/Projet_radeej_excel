<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <link rel="stylesheet" type="text/css" href="Login.css">
    <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
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
    <form action="controle.php" method="post">
        <div class="contenu_form">
            <h2>Inscription</h2>
            <input type="text" name="fullname" placeholder="Nom complet" required>
            <input type="email" name="email" placeholder="Adresse e-mail" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="password" name="confirmPassword" placeholder="Confirmer le mot de passe" required>
            <input name="inscrire" type="submit" value="S'inscrire">
            <p>Vous avez déjà un compte ? <a href="Login.php">S'identifier</a></p>
        </div>
    </form>

    <script src="file.js"></script>
</body>

</html>
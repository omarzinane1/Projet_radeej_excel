<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "radeejdata";

    // Create DB Connection
    $conn = mysqli_connect($host, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "<p style='color: green; font-size: 20px; display: none;'>Connexion établie avec succès</p>";

?>
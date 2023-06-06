<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>RADEEJ</title>
    <script src="https://kit.fontawesome.com/b08b6005dd.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="home.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.css" />
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js"></script>


</head>

<body>

    <?php
    session_start();

    ?>
    <header>
        <nav>
            <i style="font-size: 30px;  color: gainsboro; border-radius: 50px;" class="fa-solid fa-file-excel"> Excel</i>
            <ul>

                <li><a class="list_nav" href="home.php">Accueil</a></li>

                <div class="dropdown">
                    <button style="color: white;" class="dropbtn">Gestions des données excel
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="import_file.php" style="text-decoration: none;">Importer des données Excel</a>
                        <a href="Export_file_excel.php" style="text-decoration: none;">Exporter des données Excel</a>
                    </div>
                </div>
                <li><a class="list_nav" id="stati" href="#" onclick="showStatistics()">statistiques</a></li>
                <li><a class="list_nav" type="button" href="page_calcule.php">affichier les informations</a></li>
                <li><a class="list_nav" id="Tritement_data" href="tritement.php">Tritement des données</a></li>
                <li><a class="list_nav" href="#" onclick="showAbout()">A propos</a></li>
                <li><a class="list_nav" href="Login.php">Déconnexion <i class="fa-solid fa-right-from-bracket"></i></a></li>

            </ul>
        </nav>
    </header>
    <div class="statistics-modal" id="statisticsModal">
        <div class="statistics-content">
            <h2>Nombre Usage D'habitation</h2>

            <?php
            // Inclure le fichier de configuration de la base de données
            include("dbconfig.php");

            // Récupérer les données et effectuer l'action de récupération
            $req = mysqli_query($conn, "SELECT * FROM fichier_technique");

            // Vérifier s'il y a des résultats
            if (mysqli_num_rows($req) == 0) {

                echo "<h4>Il n'y a pas encore des données.</h4>";
            } else {
                $totalR = 0;
                $totalVillas = 0;
                $totalImmeubles = 0;
                $totalProjets = 0;

                // Récupérer les données et les insérer dans la nouvelle table
                while ($row = mysqli_fetch_assoc($req)) {
                    if ($row['usage_h'] == "R+2") {
                        $totalR++;
                    } elseif ($row['usage_h'] == "Immeuble" || $row['usage_h'] == "R+3" || $row['usage_h'] == "R+4" || $row['usage_h'] == "R+5" || $row['usage_h'] == "R+6" || $row['usage_h'] == "R+7") {
                        $totalImmeubles++;
                    } elseif (substr($row['usage_h'], 0, 5) == "Villa") {
                        $totalVillas++;
                    }
                }

                // Afficher les blocs statistiques
                echo "<div class='statistics-block'>";
                echo "<h3>R+2</h3>";
                echo "<p>Nombre de R+2 : " . $totalR . "</p>";
                echo "</div>";

                echo "<div class='statistics-block'>";
                echo "<h3>Villa</h3>";
                echo "<p>Nombre de villas : " . $totalVillas . "</p>";
                echo "</div>";

                echo "<div class='statistics-block'>";
                echo "<h3>Immeubles</h3>";
                echo "<p>Nombre d'immeubles : " . $totalImmeubles . "</p>";
                echo "</div>";

                echo "<div class='statistics-block'>";
                echo "<h3>Projets Touristiques</h3>";
                echo "<p>Nombre de projets touristiques : " . $totalProjets . "</p>";
                echo "</div>";
            }
            ?>


            <button onclick="hideStatistics()">Fermer</button>
        </div>
    </div>


    <!-- block a  propos -->
    <div class="about-modal" id="aboutModal">
        <div class="about-content">
            <h2>À propos de l'application</h2>
            <p>Mon application est une plateforme de gestion des données Excel qui facilite l'importation, l'exportation, le traitement et l'analyse des données. Grâce à cette application, vous pouvez importer facilement des fichiers Excel, effectuer des calculs complexes, exporter les résultats vers des fichiers Excel, et visualiser des statistiques détaillées. Notre application offre une interface simple et des fonctionnalités avancées pour vous aider à gérer et à manipuler vos données Excel de manière efficace. notre application est conçue pour répondre à vos besoins en matière de gestion de données Excel. Faites confiance à notre application pour simplifier vos tâches de manipulation des données et optimiser votre productivité. Essayez dès maintenant notre application et découvrez comment elle peut vous aider!
            </p>
            <button onclick="hideAbout()">Fermer</button>
        </div>
    </div>
    <div class="message-container">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<h4 class='message'>" . $_SESSION['message'] . '<button class="close-button" ><i class="fa-solid fa-xmark"></i></button></h4>';
            unset($_SESSION['message']);
        }
        ?>
    </div>

    <!-- section image slider -->
    <div class="contant-solide">
        <div class="slider">
            <main id="contant_home">
                <h1>Bienvenue sur Mon application web</h1>
                <p>Cette application vous permet d'importer et d'exporter des données en format Excel.</p>
                <img style="height: 50vh; margin-left: 20px; border-radius: 1000px; display: inline; " src="excel3.jpg" alt="">
            </main>
            <main id="contant_home">
                <h1>Bienvenue sur Mon application web</h1>
                <p>Cette application vous permet d'importer des fichiers Excel pour effectuer des calculs de densités.</p>
                <p>Le processus est simple : il vous suffit de sélectionner le fichier Excel contenant les données dont vous souhaitez calculer les densités. Notre application se chargera de lire les informations pertinentes et de les traiter pour vous fournir les résultats.</p>
                <p>Avant de procéder à l'importation, veuillez vous assurer que votre fichier Excel est bien structuré et contient les informations nécessaires. Vous pouvez consulter notre fichier technique qui explique en détail les données requises et les formats acceptés.</p>
                <p>Une fois le fichier importé, notre application effectuera les calculs nécessaires et vous présentera les densités correspondantes. Vous pourrez ensuite exporter les résultats obtenus pour une utilisation ultérieure ou un traitement supplémentaire.</p>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('.slider').slick({
                dots: true,
                arrows: true,
                autoplay: true,
                autoplaySpeed: 3000,
                infinite: true,
                speed: 300,
                fade: true,
                cssEase: 'linear'
            });
        });
    </script>


    <!--End  section image slider-->


    <script src="file.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- End section import file excel-->

    <script>
        function showAbout() {
            document.getElementById("aboutModal").style.display = "block";
        }

        function hideAbout() {
            document.getElementById("aboutModal").style.display = "none";
        }

        /* statistique */

        function showStatistics() {
            document.getElementById("statisticsModal").style.display = "flex";
        }

        function hideStatistics() {
            document.getElementById("statisticsModal").style.display = "none";
        }
    </script>

</body>

</html>
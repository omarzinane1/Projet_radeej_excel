
<?php
session_start();

if (isset($_SESSION['option'])) {
    $local = $_SESSION['option'];
} else {
    echo " Code à exécuter si local n'est pas défini ";
}

?>
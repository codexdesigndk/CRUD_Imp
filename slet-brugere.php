<?php

if(!isset($_SESSION['user_id'])){

    header("Location: ../index.php");
}

include '../includes/db_connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM brugere WHERE Id = '$id' AND '$id' != '4'";
$result = mysqli_query($connection, $sql);

// Sletter valgte fil fra mappen
if ($row['Billedeurl'] != 'default.jpg') {
    unlink("../images/medarbejdere/" . $row['Billedeurl']);
}

header("Location: brugere.php");
exit;

?>
<?php
// Slet nyhed
if(!isset($_SESSION['user_id'])){

    header("Location: ../index.php");
}

include '../includes/db_connection.php';

$id = $_GET['id'];
$sql = "DELETE FROM nyheder WHERE Id=$id";
$result = mysqli_query($connection, $sql);

header("Location: nyheder.php");
exit;

?>
<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

$conn = new PDO($dsn, $user, $pw);
if(isset($_GET['NumRatV'])) {
    $NumRattrapage = $_GET['NumRatV'];

    $sql = "DELETE FROM ratvol WHERE NumRatV = :numRatV";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':numRatV', $NumRattrapage, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "Record with NumRatV = $NumRattrapage deleted successfully";
        header("location: afficher.php");
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "NumRatV not provided!";
}
?>
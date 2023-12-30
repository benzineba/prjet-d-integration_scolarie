<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

$conn = new PDO($dsn, $user, $pw);

if (isset($_GET['Salle'])) {
    $Salle = $_GET['Salle'];

    $sql = "DELETE FROM salle WHERE Salle = :Salle";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':Salle', $Salle, PDO::PARAM_STR_CHAR);

    try {
        $stmt->execute();
        echo "Record with Salle = $Salle deleted successfully";
        header("location: afficher.php");
        exit; // Add this line to stop further execution
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Salle not provided!";
}
?>

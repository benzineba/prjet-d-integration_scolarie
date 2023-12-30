<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

$conn = new PDO($dsn, $user, $pw);
if(isset($_GET['SEANCE'])) {
    $SEANCE = $_GET['SEANCE'];

    $sql = "DELETE FROM seances WHERE SEANCE = :SEANCE";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':SEANCE', $SEANCE, PDO::PARAM_STR_CHAR);

    try {
        $stmt->execute();
        echo "Record with SEANCE = $SEANCE deleted successfully";
        header("location: afficher.php");
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "SEANCE not provided!";
}
?>
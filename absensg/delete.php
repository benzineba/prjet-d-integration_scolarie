<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

$conn = new PDO($dsn, $user, $pw);
if(isset($_GET['NumAbs'])) {
    $NumRattrapage = $_GET['NumAbs'];

    $sql = "DELETE FROM absensg WHERE NumAbs = :NumAbs";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':NumAbs', $NumRattrapage, PDO::PARAM_INT);

    try {
        $stmt->execute();
        echo "Record with NumAbs = $NumRattrapage deleted successfully";
        header("location: afficher.php");
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "NumAbs not provided!";
}
?>
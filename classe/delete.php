<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

$conn = new PDO($dsn, $user, $pw);
if(isset($_GET['CodClasse'])) {
    $CodClasse = $_GET['CodClasse'];

    $sql = "DELETE FROM classe WHERE CodClasse = :CodClasse";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':CodClasse', $CodClasse, PDO::PARAM_STR_CHAR);

    try {
        $stmt->execute();
        echo "Record with CodClasse = $CodClasse deleted successfully";
        header("location: afficher.php");
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "code classe not provided!";
}
?>
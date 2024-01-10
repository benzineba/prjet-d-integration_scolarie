<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO($dsn, $user, $pw);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO jssd (SEANCE, Horaire, HDeb, HFin) VALUES (:SEANCE, :Horaire, :HDeb, :HFin)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':SEANCE', $_POST['SEANCE']);
        $stmt->bindParam(':Horaire', $_POST['Horaire']);
        $stmt->bindParam(':HDeb', $_POST['HDeb']);
        $stmt->bindParam(':HFin', $_POST['HFin']);

        $stmt->execute();

        echo "Record inserted successfully!";
        header("location: afficher.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<?php
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO($dsn, $user, $pw);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE seances SET Horaire = :Horaire, HDeb = :HDeb, HFin = :HFin WHERE SEANCE = :SEANCE";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':Horaire', $_POST['Horaire']);
        $stmt->bindParam(':HDeb', $_POST['HDeb']);
        $stmt->bindParam(':HFin', $_POST['HFin']);
        $stmt->bindParam(':SEANCE', $_POST['SEANCE']);

        $stmt->execute();

        echo "Record updated successfully!";
        header("location: afficher.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

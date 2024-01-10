<?php
include("../header.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config.php");

    try {
        $conn = new PDO($dsn, $user, $pw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $salle = $_POST["Salle"];
        $categorie = $_POST["categorie"];
        $responsable = $_POST["Responsable"];
        $charge = $_POST["Charge"];
        $nbplacesExamen = $_POST["nbplacesExamen"];
        $nblignes = $_POST["nblignes"];
        $nbcollones = $_POST["nbcollones"];
        $nbsurveillance = $_POST["nbsurvillance"];
        $type = $_POST["Type"];
        $disponible = $_POST["Disponible"];
        $codeDepartement = $_POST["Code_Departement"];

        $sql = "INSERT INTO salle (Salle, Categorie, Responsable, Charge, NbPlaceExamen, NbLignes, NBCol, NBSurv, Type, Disponible, CodeDepartement) 
                VALUES (:salle, :categorie, :responsable, :charge, :nbplacesExamen, :nblignes, :nbcollones, :nbsurveillance, :type, :disponible, :codeDepartement)";

        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':salle', $salle);
        $stmt->bindParam(':categorie', $categorie);
        $stmt->bindParam(':responsable', $responsable);
        $stmt->bindParam(':charge', $charge);
        $stmt->bindParam(':nbplacesExamen', $nbplacesExamen);
        $stmt->bindParam(':nblignes', $nblignes);
        $stmt->bindParam(':nbcollones', $nbcollones);
        $stmt->bindParam(':nbsurveillance', $nbsurveillance);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':disponible', $disponible);
        $stmt->bindParam(':codeDepartement', $codeDepartement);

        $stmt->execute();

        echo "Salle added successfully.";

        header("location: afficher.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>

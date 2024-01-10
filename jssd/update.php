<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

if (!isset($_POST['Salle'])) {
    die("Salle n'est pas indiqué.");
}

$Salle = $_POST['Salle'];
$Categorie = $_POST["categorie"];
$Responsable = $_POST["Responsable"];
$Charge = $_POST["Charge"];
$NbPlaceExamen = $_POST["nbplacesExamen"];
$NbLignes = $_POST["nblignes"];
$NBCol = $_POST["nbcollones"];
$NBSurv = $_POST["nbsurvillance"];
$Type = $_POST["Type"];
$Disponible = $_POST["Disponible"];
$CodeDepartement = $_POST["Departement"];

try {
    $conn = new PDO($dsn, $user, $pw);

    $requete = "UPDATE `salle` 
                SET 
                `Categorie` = :categorie, 
                `Responsable` = :Responsable, 
                `Charge` = :Charge, 
                `NbPlaceExamen` = :nbplacesExamen, 
                `NbLignes` = :nblignes, 
                `NBCol` = :nbcollones, 
                `NBSurv` = :nbsurvillance, 
                `Type` = :Type,
                `Disponible` = :disponible, 
                `CodeDepartement` = :CodeDepartement 
                WHERE `Salle` = :Salle";

    $stmt = $conn->prepare($requete);

    $data = [
        'Salle' => $Salle,
        'categorie' => $Categorie,
        'Responsable' => $Responsable,
        'Charge' => $Charge,
        'nbplacesExamen' => $NbPlaceExamen,
        'nblignes' => $NbLignes,
        'nbcollones' => $NBCol,
        'nbsurvillance' => $NBSurv,
        'Type' => $Type,
        'disponible' => $Disponible,
        'CodeDepartement' => $CodeDepartement
    ];

    $n = $stmt->execute($data);

    if (!$n) {
        print_r($stmt->errorInfo());
    } else {
        echo "Mise à jour réussie";
        header("location:afficher.php");
    }
} catch (PDOException $e) {
    die("Une erreur s'est produite lors de la mise à jour: " . $e->getMessage());
}
?>

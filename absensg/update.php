<?php 
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

if (!isset($_POST['NumAbsence'])) {
    die("NumAbsence n'est pas indiqué.");
}

$NumAbsence = $_POST['NumAbsence'];
$MatriculeProf = $_POST["MatriculeProf"];
$DateAbsence = $_POST["DateAbsence"];
$Seance = $_POST["Seance"];
$Motif = $_POST["Motif"];
$TypeSeance = $_POST["TypeSeance"];
$CodeClasse = $_POST["CodeClasse"];
$CodeMatiere = $_POST["CodeMatiere"];
$Justifier = $_POST["Justifier"];

// Validate DateAbsence format
if (!DateTime::createFromFormat('Y-m-d', $DateAbsence)) {
    die("Invalid date format for DateAbsence!");
}

try {
    $conn = new PDO($dsn, $user, $pw);

    $requete = "UPDATE `absensg` 
                SET 
                `MatriculeProf` = :MatriculeProf, 
                `DateAbs` = :DateAbsence, 
                `Seance` = :Seance, 
                `Motif` = :Motif, 
                `TypeSeance` = :TypeSeance, 
                `CodeClasse` = :CodeClasse, 
                `CodeMatiere` = :CodeMatiere, 
                `Justifier` = :Justifier 
                WHERE `NumAbs` = :NumAbsence";

    $stmt = $conn->prepare($requete);

    $data = [
        'NumAbsence' => $NumAbsence,
        'MatriculeProf' => $MatriculeProf,
        'DateAbsence' => $DateAbsence,
        'Seance' => $Seance,
        'Motif' => $Motif,
        'TypeSeance' => $TypeSeance,
        'CodeClasse' => $CodeClasse,
        'CodeMatiere' => $CodeMatiere,
        'Justifier' => $Justifier
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

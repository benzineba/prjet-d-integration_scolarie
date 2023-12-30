<?php
include("../header.php");

require_once("../config.php");
$conn = new PDO($dsn, $user, $pw);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $NumAbs = $_POST['NumAbs'];
    $MatProf = $_POST['MatProf'];
    $Session = $_POST['Session'];
    $DateAbs = $_POST['DateAbs'];
    $Seance = $_POST['Seance'];
    $Motif = $_POST['Motif'];
    $TypeSeance = $_POST['TypeSeance'];
    $CodeClasse = $_POST['CodeClasse'];
    $CodeMatiere = $_POST['CodeMatiere'];
    $justifier = $_POST['justifier'];

    // Validate and sanitize the data
    $NumAbs = filter_var($NumAbs, FILTER_VALIDATE_INT);
    $MatProf = filter_var($MatProf, FILTER_SANITIZE_STRING);
    $Session = filter_var($Session, FILTER_VALIDATE_INT);
    $DateAbs = filter_var($DateAbs, FILTER_SANITIZE_STRING);
    $Seance = filter_var($Seance, FILTER_SANITIZE_STRING);
    $Motif = filter_var($Motif, FILTER_SANITIZE_STRING);
    $TypeSeance = filter_var($TypeSeance, FILTER_SANITIZE_STRING);
    $CodeClasse = filter_var($CodeClasse, FILTER_SANITIZE_STRING);
    $CodeMatiere = filter_var($CodeMatiere, FILTER_SANITIZE_STRING);
    $justifier = filter_var($justifier, FILTER_VALIDATE_INT);

    if ($NumAbs === false || $Session === false || $justifier === false) {
        echo "Invalid data submitted.";
        exit;
    }

    try {
        $sql = "INSERT INTO absensg (NumAbs, MatriculeProf, Session, DateAbs, Seance, Motif, TypeSeance, CodeClasse, CodeMatiere, justifier) 
                VALUES (:NumAbs, :MatProf, :Session, :DateAbs, :Seance, :Motif, :TypeSeance, :CodeClasse, :CodeMatiere, :justifier)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':NumAbs' => $NumAbs,
            ':MatProf' => $MatProf,
            ':Session' => $Session,
            ':DateAbs' => $DateAbs,
            ':Seance' => $Seance,
            ':Motif' => $Motif,
            ':TypeSeance' => $TypeSeance,
            ':CodeClasse' => $CodeClasse,
            ':CodeMatiere' => $CodeMatiere,
            ':justifier' => $justifier 
        ]);

         header("Location: afficher.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
}
?>

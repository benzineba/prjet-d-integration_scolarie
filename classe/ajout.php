<?php
include("../header.php");

// Error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once("../config.php");

    try {
        // Database connection
        $conn = new PDO($dsn, $user, $pw);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL query
        $sql = "INSERT INTO classe (CodClasse, IntClasse, CodeDep, Option, Niveau, IntCalsseArabB, OptionAaraB, DepartementAaraB, NiveauAaraB, CodeEtape, CodeSalima) 
                VALUES (:CodeClasse, :IntClasse, :CodeDep, :Option, :Niveau, :IntCalsseArabB, :OptionAaraB, :DepartementAaraB, :NiveauAaraB, :CodeEtape, :CodeSalima)";

        // Prepare and execute the statement
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':CodeClasse', $_POST['CodeClasse']);
        $stmt->bindParam(':IntClasse', $_POST['IntClasse']);
        $stmt->bindParam(':CodeDep', $_POST['CodeDep']);
        $stmt->bindParam(':Option', $_POST['Option']);
        $stmt->bindParam(':Niveau', $_POST['Niveau']);
        $stmt->bindParam(':IntCalsseArabB', $_POST['IntCalsseArabB']);
        $stmt->bindParam(':OptionAaraB', $_POST['OptionAaraB']);
        $stmt->bindParam(':DepartementAaraB', $_POST['DepartementAaraB']);
        $stmt->bindParam(':NiveauAaraB', $_POST['NiveauAaraB']);
        $stmt->bindParam(':CodeEtape', $_POST['CodeEtape']);
        $stmt->bindParam(':CodeSalima', $_POST['CodeSalima']);

        $stmt->execute();

        echo "Classe inserted successfully.";
        
        // Redirect after successful insert
        header("location: afficher.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $conn = null;
}
?>

<?php
ini_set("display_errors", "1");
error_reporting(E_ALL);
require_once("../config.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO($dsn, $user, $pw);

        $requete = "UPDATE `classe` 
                    SET 
                    `IntClasse` = :IntClasse, 
                    `CodeDep` = :CodeDep, 
                    `Option` = :Option, 
                    `Niveau` = :Niveau, 
                    `IntCalsseArabB` = :IntCalsseArabB, 
                    `OptionAaraB` = :OptionAaraB, 
                    `DepartementAaraB` = :DepartementAaraB, 
                    `NiveauAaraB` = :NiveauAaraB, 
                    `CodeEtape` = :CodeEtape, 
                    `CodeSalima` = :CodeSalima
                    WHERE `CodClasse` = :CodClasse";

        $stmt = $conn->prepare($requete);

        $data = [
            'CodClasse' => $_POST['CodClasse'],
            'IntClasse' => $_POST['IntClasse'],
            'CodeDep' => $_POST['CodeDep'],
            'Option' => $_POST['Option'],
            'Niveau' => $_POST['Niveau'],
            'IntCalsseArabB' => $_POST['IntCalsseArabB'],
            'OptionAaraB' => $_POST['OptionAaraB'],
            'DepartementAaraB' => $_POST['DepartementAaraB'],
            'NiveauAaraB' => $_POST['NiveauAaraB'],
            'CodeEtape' => $_POST['CodeEtape'],
            'CodeSalima' => $_POST['CodeSalima'],
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
} else {
    echo "Invalid request.";
}
?>

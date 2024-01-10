<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Salle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php 
include("../header.php");

require_once("../config.php");
$conn = new PDO($dsn, $user, $pw);

if (isset($_GET['Salle'])) {
    $salle = $_GET['Salle'];
    $sql = "SELECT * FROM salle WHERE Salle = :Salle";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':Salle' => $salle]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    die("Salle not provided.");
}

?>
<div class="container mt-4">
    <h1>Modifier Salle</h1>

    <form action="update.php" method="post">
        <div class="form-group">
            <label for="Salle">Salle:</label>
            <input type="text" class="form-control" name="Salle" value="<?php echo htmlspecialchars($data['Salle']); ?>" readonly>
        </div>
        <div class="form-group">
            <label for="categorie">Categorie:</label>
            <input type="text" class="form-control" name="categorie" value="<?php echo htmlspecialchars($data['Categorie']); ?>">
        </div>
        <div class="form-group">
            <label for="Responsable">Responsable:</label>
            <input type="text" class="form-control" name="Responsable" value="<?php echo htmlspecialchars($data['Responsable']); ?>">
        </div>
        <div class="form-group">
            <label for="Charge">Charge:</label>
            <input type="number" class="form-control" name="Charge" value="<?php echo htmlspecialchars($data['Charge']); ?>">
        </div>
        <div class="form-group">
            <label for="nbplacesExamen">Nb Places Examen:</label>
            <input type="number" class="form-control" name="nbplacesExamen" value="<?php echo htmlspecialchars($data['NbPlaceExamen']); ?>">
        </div>
        <div class="form-group">
            <label for="nblignes">Nb Lignes:</label>
            <input type="number" class="form-control" name="nblignes" value="<?php echo htmlspecialchars($data['NbLignes']); ?>">
        </div>
        <div class="form-group">
            <label for="nbcollones">Nb colonnes:</label>
            <input type="number" class="form-control" name="nbcollones" value="<?php echo htmlspecialchars($data['NBCol']); ?>">
        </div>
        <div class="form-group">
            <label for="nbsurvillance">Nb survillance:</label>
            <input type="number" class="form-control" name="nbsurvillance" value="<?php echo htmlspecialchars($data['NBSurv']); ?>">
        </div>
        <div class="form-group">
            <label for="Type">Type:</label>
            <input type="text" class="form-control" name="Type" value="<?php echo htmlspecialchars($data['Type']); ?>">
        </div>
        <div class="form-group">
            <label for="Disponible">Disponible:</label>
            <input type="text" class="form-control" name="Disponible" value="<?php echo htmlspecialchars($data['Disponible']); ?>">
        </div>
        <div class="form-group">
            <label for="CodeDepartement">Code Departement:</label>
            <?php
            try {
                $sql = "SELECT CodeDep FROM departements";
                $result = $conn->query($sql);

                if ($result !== false) {
                    if ($result->rowCount() > 0) {
                        echo "<select class='form-control' name='CodeDepartement'>";
                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['CodeDep'] . "'";
                            if ($row['CodeDep'] == $data['CodeDepartement']) echo " selected";
                            echo ">" . $row['CodeDep'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "No results found!";
                    }
                } else {
                    throw new PDOException("Query failed: " . $conn->errorInfo()[2]);
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </div>
        <button type="submit" class="btn btn-primary">Modifier</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

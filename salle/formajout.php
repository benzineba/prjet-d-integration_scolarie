<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Salle</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php 
include("../header.php");

require_once("../config.php");
$conn = new PDO($dsn, $user, $pw);

?>
<div class="container mt-4">
    <h1>Ajout Salle</h1>

    <form action="ajout.php" method="post">
        <div class="form-group">
            <label for="Salle">Salle:</label>
            <input type="text" class="form-control" name="Salle">
        </div>
        <div class="form-group">
            <label for="categorie">Categorie:</label>
            <input type="text" class="form-control" name="categorie">
        </div>
        <div class="form-group">
            <label for="Responsable">Responsable:</label>
            <input type="text" class="form-control" name="Responsable">
        </div>
        <div class="form-group">
            <label for="Charge">Charge:</label>
            <input type="number" class="form-control" name="Charge">
        </div>
        <div class="form-group">
            <label for="nbplacesExamen">Nb Places Examen:</label>
            <input type="number" class="form-control" name="nbplacesExamen">
        </div>
        <div class="form-group">
            <label for="nblignes">Nb Lignes:</label>
            <input type="number" class="form-control" name="nblignes">
        </div>
        <div class="form-group">
            <label for="nbcollones">Nb colonnes:</label>
            <input type="number" class="form-control" name="nbcollones">
        </div>
        <div class="form-group">
            <label for="nbsurvillance">Nb survillance:</label>
            <input type="number" class="form-control" name="nbsurvillance">
        </div>
        <div class="form-group">
            <label for="Type">Type:</label>
            <input type="text" class="form-control" name="Type">
        </div>
        <div class="form-group">
            <label for="Disponible">Disponible:</label>
            <input type="text" class="form-control" name="Disponible">
        </div>
        <div class="form-group">
            <label for="CodeDepartement">Code Departement:</label>
            <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT CodeDep FROM departements";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Code Departement'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['CodeDep'] . "'>" . $row['CodeDep'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

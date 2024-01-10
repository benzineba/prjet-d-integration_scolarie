<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Rattrapage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include("../header.php");
    ?>

    <div class="container mt-4">
        <h1>Ajout JSSD</h1>
        <form action="ajout.php" method="post">
            <div class="form-group">
                <label for="Jour">Jour:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT Num FROM jours";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeClasse'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['Num'] . "'>" . $row['Num'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Seance">Seance:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT SEANCE FROM seances";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='SEANCE'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['SEANCE'] . "'>" . $row['SEANCE'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Salle">Salle:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT Salle FROM salle";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Salle'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['Salle'] . "'>" . $row['Salle'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>            
            </div>
            <div class="form-group">
                <label for="NDist">NDist:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT Numdist FROM repartition";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Numdist'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['Numdist'] . "'>" . $row['Numdist'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>            
            </div>
            <div class="form-group">
                <label for="Groupe">Groupe:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT Numdist FROM repartition";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Numdist'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['Numdist'] . "'>" . $row['Numdist'] . "</option>";
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

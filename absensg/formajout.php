<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Absence Prof</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include("../header.php");
    ?>

    <div class="container mt-4">
        <h1>Ajout d'une Nouvelle Absence</h1>
        <form action="ajout.php" method="post">
            <div class="form-group">
                <label for="NumRattrapage">Num_Absence:</label>
                <input type="number" class="form-control" name="NumAbs">
            </div>
            <div class="form-group">
                <label for="MatProf">MatProf:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT Matricule_Prof FROM prof";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='MatProf'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['Matricule_Prof'] . "'>" . $row['Matricule_Prof'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Session">Session:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT numero FROM session";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Session'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['numero'] . "'>" . $row['numero'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="DateRattrapage">Date Absence:</label>
                <input type="date" class="form-control" name="DateAbs">
            </div>
            <div class="form-group">
                <label for="Seance">Séance:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT SEANCE FROM seances";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='Seance'>";
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
                <label for="TypeSeance">Motif:</label>
                <input type="text" class="form-control" maxlength="60" name="Motif">
            </div>
            
            <div class="form-group">
                <label for="TypeSeance">Type_Seance:</label>
                <input type="text" class="form-control" maxlength="10" name="TypeSeance">
            </div>
            <div class="form-group">
                <label for="CodeClasse">CodeClasse:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT CodClasse FROM classe";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeClasse'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['CodClasse'] . "'>" . $row['CodClasse'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="CodeMatiere">CodeMatiere:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT CodeMatiere FROM matieres";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeMatiere'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['CodeMatiere'] . "'>" . $row['CodeMatiere'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="justifier">Justifier:</label>
                <input type="number" class="form-control" name="justifier">
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

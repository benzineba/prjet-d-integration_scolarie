<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Absence</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php 
    include("../header.php");

    require_once("../config.php");
    $conn = new PDO($dsn, $user, $pw);

    if (isset($_GET['NumAbs'])) {
        $NumAbs = $_GET['NumAbs'];
        $sql = "SELECT * FROM absensg WHERE NumAbs = :NumAbs";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':NumAbs' => $NumAbs]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("NumAbs not provided.");
    }

    ?>
    <div class="container mt-4">
        <h1>Modifier Absence</h1>

        <form action="update.php" method="post">
            <div class="form-group">
                <label for="NumAbsence">Num_Absence:</label>
                <input type="text" class="form-control" name="NumAbsence" value="<?php echo htmlspecialchars($data['NumAbs']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="MatriculeProf">Matricule_Prof:</label>
                <?php
                $sqlMatricule = "SELECT Matricule_Prof FROM prof";
                $resultMatricule = $conn->query($sqlMatricule);
                if ($resultMatricule->rowCount() > 0) {
                    echo "<select class='form-control' name='MatriculeProf'>";
                    while ($rowMatricule = $resultMatricule->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rowMatricule['Matricule_Prof'] . "'";
                        if ($rowMatricule['Matricule_Prof'] == $data['MatriculeProf']) echo " selected";
                        echo ">" . $rowMatricule['Matricule_Prof'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="DateAbsence">Date_Absence:</label>
                <input type="date" class="form-control" name="DateAbsence" value="<?php echo htmlspecialchars((new DateTime($data['DateAbs']))->format('Y-m-d')); ?>">
            </div>
            <div class="form-group">
                <label for="Seance">Séance:</label>
                <?php
                $sqlSeance = "SELECT SEANCE FROM seances";
                $resultSeance = $conn->query($sqlSeance);
                if ($resultSeance->rowCount() > 0) {
                    echo "<select class='form-control' name='Seance'>";
                    while ($rowSeance = $resultSeance->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rowSeance['SEANCE'] . "'";
                        if ($rowSeance['SEANCE'] == $data['Seance']) echo " selected";
                        echo ">" . $rowSeance['SEANCE'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Motif">Motif:</label>
                <input type="text" class="form-control" maxlength="255" name="Motif" value="<?php echo htmlspecialchars($data['Motif']); ?>">
            </div>
            <div class="form-group">
                <label for="TypeSeance">Type_Séance:</label>
                <input type="text" class="form-control" maxlength="10" name="TypeSeance" value="<?php echo htmlspecialchars($data['TypeSeance']); ?>">
            </div>
            <div class="form-group">
                <label for="CodeClasse">Code_Classe:</label>
                <?php
                $sqlCodeClasse = "SELECT CodClasse FROM classe";
                $resultCodeClasse = $conn->query($sqlCodeClasse);
                if ($resultCodeClasse->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeClasse'>";
                    while ($rowCodeClasse = $resultCodeClasse->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rowCodeClasse['CodClasse'] . "'";
                        if ($rowCodeClasse['CodClasse'] == $data['CodeClasse']) echo " selected";
                        echo ">" . $rowCodeClasse['CodClasse'] . "</option>";
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
                $sqlCodeMatiere = "SELECT CodeMatiere FROM matieres";
                $resultCodeMatiere = $conn->query($sqlCodeMatiere);
                if ($resultCodeMatiere->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeMatiere'>";
                    while ($rowCodeMatiere = $resultCodeMatiere->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $rowCodeMatiere['CodeMatiere'] . "'";
                        if ($rowCodeMatiere['CodeMatiere'] == $data['CodeMatiere']) echo " selected";
                        echo ">" . $rowCodeMatiere['CodeMatiere'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Justifier">Justifier:</label>
                <input type="text" class="form-control" maxlength="10" name="Justifier" value="<?php echo htmlspecialchars($data['Justifier']); ?>">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

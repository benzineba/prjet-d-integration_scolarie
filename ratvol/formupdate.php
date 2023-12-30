<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Rattrapage</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php 
    include("../header.php");

    require_once("../config.php");
    $conn = new PDO($dsn, $user, $pw);

    if (isset($_GET['NumRatV'])) {
        $NumRatV = $_GET['NumRatV'];
        $sql = "SELECT * FROM ratvol WHERE NumRatV = :NumRatV";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':NumRatV' => $NumRatV]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("NumRatV not provided.");
    }

    ?>
    <div class="container mt-4">
        <h1>Modifier Rattrapage</h1>

        <form action="update.php" method="post">
            <div class="form-group">
                <label for="NumRattrapage">Num_Rattrapage:</label>
                <input type="text" class="form-control" name="NumRattrapage" value="<?php echo htmlspecialchars($data['NumRatV']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="MatProf">MatProf:</label>
                <input type="text" class="form-control" name="MatProf" value="<?php echo htmlspecialchars($data['MatProf']); ?>">
            </div>
            <div class="form-group">
                <label for="DateRattrapage">Date_Rattrapage:</label>
                <input type="date" class="form-control" name="DateRattrapage" value="<?php echo htmlspecialchars((new DateTime($data['DateRat']))->format('Y-m-d')); ?>">
            </div>
            <div class="form-group">
                <label for="Seance">Séance:</label>
                <input type="text" class="form-control" maxlength="10" name="Seance" value="<?php echo htmlspecialchars($data['Seance']); ?>">
            </div>
            <div class="form-group">
                <label for="Session">Session:</label>
                <?php
                    $sql = "SELECT numero FROM session";
                    $result = $conn->query($sql);
                    if ($result->rowCount() > 0) {   
                        echo "<select class='form-control' name='Session'>";
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['numero'] . "'";
                            if($row['numero'] == $data['Session']) echo " selected";
                            echo ">" . $row['numero'] . "</option>";
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
                    $sql = "SELECT Salle FROM salle";
                    $result = $conn->query($sql);
                    if ($result->rowCount() > 0) {   
                        echo "<select class='form-control' name='Salle'>";
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['Salle'] . "'";
                            if($row['Salle'] == $data['Session']) echo " selected";
                            echo ">" . $row['Salle'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "No results found!";
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="Jour">jour:</label>
                <input type="text" class="form-control" maxlength="10" name="Jour" value="<?php echo htmlspecialchars($data['Jour']); ?>">
            </div>
            <div class="form-group">
                <label for="CodeClasse">Code_Classe:</label>
                <?php
                    $sql = "SELECT CodClasse FROM classe";
                    $result = $conn->query($sql);
                    if ($result->rowCount() > 0) {   
                        echo "<select class='form-control' name='CodeClasse'>";
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['CodClasse'] . "'";
                            if($row['CodClasse'] == $data['CodeClasse']) echo " selected";
                            echo ">" . $row['CodClasse'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "No results found!";
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="CodeMatiere">Code_Matiere:</label>
                <?php
                    $sql = "SELECT CodeMatiere FROM matieres";
                    $result = $conn->query($sql);
                    if ($result->rowCount() > 0) {   
                        echo "<select class='form-control' name='CodeMatiere'>";
                        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row['CodeMatiere'] . "'";
                            if($row['CodeMatiere'] == $data['CodeMatiere']) echo " selected";
                            echo ">" . $row['CodeMatiere'] . "</option>";
                        }
                        echo "</select>";
                    } else {
                        echo "No results found!";
                    }
                ?>
            </div>
            <div class="form-group">
                <label for="Etat">Etat:</label>
                <input type="number" class="form-control" name="Etat" value="<?php echo htmlspecialchars($data['Etat']); ?>">
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

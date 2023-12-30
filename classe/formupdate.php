<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Classe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include("../header.php");

    require_once("../config.php");
    $conn = new PDO($dsn, $user, $pw);

    if (isset($_GET['CodClasse'])) {
        $CodClasse = $_GET['CodClasse'];
        $sql = "SELECT * FROM classe WHERE CodClasse = :CodClasse";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':CodClasse' => $CodClasse]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("CodClasse not provided.");
    }

    ?>
    <div class="container mt-4">
        <h1>Modifier Classe</h1>

        <form action="update.php" method="post">
            <div class="form-group">
                <label for="CodClasse">Code Classe:</label>
                <input type="text" class="form-control" name="CodClasse" value="<?php echo htmlspecialchars($data['CodClasse']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="IntClasse">Int Classe:</label>
                <input type="text" class="form-control" name="IntClasse" value="<?php echo htmlspecialchars($data['IntClasse']); ?>">
            </div>
            <div class="form-group">
                <label for="CodeDep">Code Departement:</label>
                <?php
                $sql = "SELECT CodeDep FROM departements";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeDep'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['CodeDep'] . "'";
                        if ($row['CodeDep'] == $data['CodeDep']) echo " selected";
                        echo ">" . $row['CodeDep'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Option">Option:</label>
                <input type="text" class="form-control" maxlength="10" name="Option" value="<?php echo htmlspecialchars($data['Option']); ?>">
            </div>
            <div class="form-group">
                <label for="Niveau">Niveau:</label>
                <input type="text" class="form-control" name="Niveau" value="<?php echo htmlspecialchars($data['Niveau']); ?>">
            </div>
            <div class="form-group">
                <label for="IntCalsseArabB">IntCalsseArabB:</label>
                <input type="text" class="form-control" name="IntCalsseArabB" value="<?php echo htmlspecialchars($data['IntCalsseArabB']); ?>">
            </div>
            <div class="form-group">
                <label for="OptionAaraB">OptionAaraB:</label>
                <input type="text" class="form-control" name="OptionAaraB" value="<?php echo htmlspecialchars($data['OptionAaraB']); ?>">
            </div>
            <div class="form-group">
                <label for="DepartementAaraB">DepartementAaraB:</label>
                <input type="text" class="form-control" name="DepartementAaraB" value="<?php echo htmlspecialchars($data['DepartementAaraB']); ?>">
            </div>
            <div class="form-group">
                <label for="NiveauAaraB">NiveauAaraB:</label>
                <input type="text" class="form-control" name="NiveauAaraB" value="<?php echo htmlspecialchars($data['NiveauAaraB']); ?>">
            </div>
            <div class="form-group">
                <label for="CodeEtape">CodeEtape:</label>
                <input type="text" class="form-control" name="CodeEtape" value="<?php echo htmlspecialchars($data['CodeEtape']); ?>">
            </div>
            <div class="form-group">
                <label for="CodeSalima">CodeSalima:</label>
                <input type="text" class="form-control" name="CodeSalima" value="<?php echo htmlspecialchars($data['CodeSalima']); ?>">
            </div>

            <!-- Add other form fields as needed -->

            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

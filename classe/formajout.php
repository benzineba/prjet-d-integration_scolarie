<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Classe</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include("../header.php");
    ?>

    <div class="container mt-4">
        <h1>Ajout d'un nouveau Classe</h1>
        <form action="ajout.php" method="post">
            <div class="form-group">
                <label for="CodeClasse">Code Classe:</label>
                <input type="text" class="form-control" name="CodeClasse">
            </div>
            <div class="form-group">
                <label for="IntClasse">Int Classe:</label>
                <input type="text" class="form-control" name="IntClasse">
            </div>
            <div class="form-group">
                <label for="CodeDep">Code Departement:</label>
                <?php
                require_once("../config.php");
                $conn = new PDO($dsn, $user, $pw);
                $sql = "SELECT CodeDep FROM departements";
                $result = $conn->query($sql);
                if ($result->rowCount() > 0) {
                    echo "<select class='form-control' name='CodeDep'>";
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='" . $row['CodeDep'] . "'>" . $row['CodeDep'] . "</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No results found!";
                }
                ?>
            </div>
            <div class="form-group">
                <label for="Option">Option:</label>
                <input type="text" class="form-control" maxlength="10" name="Option">
            </div>
            
            <div class="form-group">
                <label for="Niveau">Niveau:</label>
                <input type="text" class="form-control" name="Niveau">
            </div>
            <div class="form-group">
                <label for="IntCalsseArabB">IntCalsseArabB:</label>
                <input type="text" class="form-control" name="IntCalsseArabB">
            </div>
            <div class="form-group">
                <label for="OptionAaraB">OptionAaraB:</label>
                <input type="text" class="form-control" name="OptionAaraB">
            </div>
            <div class="form-group">
                <label for="DepartementAaraB">DepartementAaraB:</label>
                <input type="text" class="form-control" name="DepartementAaraB">
            </div>
            <div class="form-group">
                <label for="NiveauAaraB">NiveauAaraB:</label>
                <input type="text" class="form-control" name="NiveauAaraB">
            </div>
            <div class="form-group">
                <label for="CodeEtape">CodeEtape:</label>
                <input type="text" class="form-control" name="CodeEtape">
            </div>
            <div class="form-group">
                <label for="CodeSalima">CodeSalima:</label>
                <input type="text" class="form-control" name="CodeSalima">
            </div>
            

                
                
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

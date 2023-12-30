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
        <h1>Ajout d'une nouvelle Séance</h1>
        <form action="ajout.php" method="post">
            <div class="form-group">
                <label for="SEANCE">SEANCE:</label>
                <input type="text" class="form-control" name="SEANCE" required>
            </div>
            <div class="form-group">
                <label for="Horaire">Horaire:</label>
                <input type="text" class="form-control" name="Horaire" required>
            </div>
            <div class="form-group">
                <label for="HDeb">HDeb:</label>
                <input type="text" class="form-control" name="HDeb" required>
            </div>
            <div class="form-group">
                <label for="HFin">HFin:</label>
                <input type="text" class="form-control" name="HFin" required>
            </div>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

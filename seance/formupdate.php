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

    if (isset($_GET['SEANCE'])) {
        $SEANCE = $_GET['SEANCE'];
        $sql = "SELECT * FROM seances WHERE SEANCE = :SEANCE";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':SEANCE' => $SEANCE]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        die("SEANCE not provided.");
    }

    ?>
    <div class="container mt-4">
        <h1>Modifier Rattrapage</h1>

        <form action="update.php" method="post">
            <div class="form-group">
                <label for="SEANCE">SEANCE:</label>
                <input type="text" class="form-control" name="SEANCE" value="<?php echo htmlspecialchars($data['SEANCE']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Horaire">Horaire:</label>
                <input type="text" class="form-control" name="Horaire" value="<?php echo htmlspecialchars($data['Horaire']); ?>">
            </div>
            <div class="form-group">
                <label for="HDeb">HDeb:</label>
                <input type="text" class="form-control" name="HDeb" value="<?php echo htmlspecialchars($data['HDeb']); ?>">
            </div>
            <div class="form-group">
                <label for="HFin">HFin:</label>
                <input type="text" class="form-control" name="HFin" value="<?php echo htmlspecialchars($data['HFin']); ?>">
            </div>


            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Seances</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <?php
    include("../header.php");
    ini_set("display_errors", "1");
    error_reporting(E_ALL);
    require_once("../config.php");

    try {
        $conn = new PDO($dsn, $user, $pw);

        $filterField = isset($_GET['filterField']) ? $_GET['filterField'] : 'SEANCE'; 
        $filterValue = isset($_GET['filterValue']) ? $_GET['filterValue'] : ''; 

        $requete = "SELECT * FROM seances WHERE $filterField LIKE '%$filterValue%'";

        $resultat = $conn->query($requete);

        if ($resultat->rowCount() == 0) {
            echo "La table ne contient aucun Seance...!<br>";
        } else {
            echo "<form method='get' action=''>";
            echo "<div class='form-row align-items-center'>";
            echo "<div class='col-auto'>";
            echo "<label class='sr-only' for='filterField'>Filter Field</label>";
            echo "<select class='form-control mb-2' name='filterField'>";
            echo "<option value='SEANCE' " . ($filterField === 'SEANCE' ? 'selected' : '') . ">SEANCE</option>";
            echo "<option value='Horaire' " . ($filterField === 'Horaire' ? 'selected' : '') . ">Horaire</option>";
            echo "<option value='HDeb' " . ($filterField === 'HDeb' ? 'selected' : '') . ">HDeb</option>";
            echo "<option value='HFin' " . ($filterField === 'HFin' ? 'selected' : '') . ">HFin</option>";
            echo "</select>";
            echo "</div>";
            echo "<div class='col-auto'>";
            echo "<label class='sr-only' for='filterValue'>Filter Value</label>";
            echo "<input type='text' class='form-control mb-2' name='filterValue' value='$filterValue' placeholder='Search...'>";
            echo "</div>";
            echo "<div class='col-auto'>";
            echo "<button type='submit' class='btn btn-primary mb-2'>Filter</button>";
            echo "</div>";
            echo "</div>";
            echo "</form>";

            echo "<h1>Liste Seances</h1>";
            echo "<a href='formajout.php' class='btn btn-info mb-3' id='ajoutButton'>Ajout Seance</a>";
            echo "<table class='table table-sm'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>SEANCE</th>";
            echo "<th>Horaire</th>";
            echo "<th>HDeb</th>";
            echo "<th>HFin</th>";
            echo "<th class='action-elements'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $ligne['SEANCE'] . "</td>";
                echo "<td>" . $ligne['Horaire'] . "</td>";
                echo "<td>" . $ligne['HDeb'] . "</td>";
                echo "<td>" . $ligne['HFin'] . "</td>";
                echo "<td class='action-elements'>";
                echo "<a href='formupdate.php?SEANCE=" . $ligne['SEANCE'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                echo "<a href='delete.php?SEANCE=" . $ligne['SEANCE'] . "' class='btn btn-danger btn-sm'>Delete</a> ";
                echo "<button onclick='printDetails(" . json_encode($ligne) . ");' class='btn btn-info btn-sm'>Print Details</button>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<div class='d-flex justify-content-center mt-3' id='printButtonContainer'>";
            echo "<button id='printButton' onclick='printDocument();' class='btn btn-success'>Print</button>";
            echo "</div>";
        }
    } catch (PDOException $e) {
        die($e->getMessage());
    }
    ?>

    <script>
        function printDocument() {
            document.getElementById('printButton').style.display = 'none';
            document.getElementById('ajoutButton').style.display = 'none';
            document.getElementById('printButtonContainer').style.display = 'none';

            let searchForm = document.querySelector('form');
            searchForm.style.display = 'none';

            let actionElements = document.querySelectorAll('.action-elements');
            actionElements.forEach(function (el) {
                el.style.display = 'none';
            });

            document.body.offsetHeight;
            window.print();

            setTimeout(() => {
                searchForm.style.display = 'block';
                actionElements.forEach(function (el) {
                    el.style.display = '';
                });
                document.getElementById('ajoutButton').style.display = 'inline-block';
                document.getElementById('printButton').style.display = 'block';
                document.getElementById('printButtonContainer').style.display = 'block';
            }, 500);
        }

        function printDetails(details) {
            let newWin = window.open('', '_blank');

            newWin.document.write(`
            <html>
            <head>
                <title>Details Seance ID ${details.SEANCE}</title>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <style>
                    body {
                        font-family: Arial, sans-serif;
                    }
                    .details-container {
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        width: 100%;
                        max-width: 600px;
                        margin: 20px auto;
                        border: 1px solid #ccc;
                        padding: 20px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        text-align: center; /* This centers the text within each paragraph */
                    }
                </style>
            </head>
            <body>
                <div class="details-container">
                    <h1>Seance</h1>
                    <p><strong>ID:</strong> ${details.SEANCE}</p>
                    <p><strong>Horaire:</strong> ${details.Horaire}</p>
                    <p><strong>HDeb:</strong> ${details.HDeb}</p>
                    <p><strong>Seance:</strong> ${details.Seance}</p>
                    <p><strong>HFin:</strong> ${details.HFin}</p>
                </div>
            </body>
            </html>`);

            newWin.document.close();
            newWin.print();
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

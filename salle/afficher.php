<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Salles</title>
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

        $filterField = isset($_GET['filterField']) ? $_GET['filterField'] : 'Salle'; 
        $filterValue = isset($_GET['filterValue']) ? $_GET['filterValue'] : ''; 

        $requete = "SELECT * FROM salle WHERE $filterField LIKE '%$filterValue%'";

        $resultat = $conn->query($requete);

        
        
            echo "<form method='get' action=''>";
            echo "<div class='form-row align-items-center'>";
            echo "<div class='col-auto'>";
            echo "<label class='sr-only' for='filterField'>Filter Field</label>";
            echo "<select class='form-control mb-2' name='filterField'>";
            echo "<option value='salle' " . ($filterField === 'salle' ? 'selected' : '') . ">salle</option>";
            echo "<option value='Categorie' " . ($filterField === 'Categorie' ? 'selected' : '') . ">Categorie</option>";
            echo "<option value='Responsable' " . ($filterField === 'Responsable' ? 'selected' : '') . ">Responsable</option>";
            echo "<option value='Charge' " . ($filterField === 'Charge' ? 'selected' : '') . ">Charge</option>";
            echo "<option value='NbPlaceExamen' " . ($filterField === 'NbPlaceExamen' ? 'selected' : '') . ">NbPlaceExamen</option>";
            echo "<option value='NbLignes' " . ($filterField === 'NbLignes' ? 'selected' : '') . ">NbLignes</option>";
            echo "<option value='NBCol' " . ($filterField === 'NBCol' ? 'selected' : '') . ">NBCol</option>";
            echo "<option value='NBSurv' " . ($filterField === 'NBSurv' ? 'selected' : '') . ">NBSurv</option>";
            echo "<option value='Type' " . ($filterField === 'Type' ? 'selected' : '') . ">Type</option>";
            echo "<option value='Disponible' " . ($filterField === 'Disponible' ? 'selected' : '') . ">Disponible</option>";
            echo "<option value='Code Departement' " . ($filterField === 'CodeDepartement' ? 'selected' : '') . ">CodeDepartement</option>";

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

            echo "<h1>Liste Salles</h1>";
            echo "<a href='formajout.php' class='btn btn-info mb-3' id='ajoutButton'>Ajout Salle</a>";
            echo "<table class='table table-sm'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>Salle</th>";
            echo "<th>Categorie</th>";
            echo "<th>Responable</th>";
            echo "<th>Charge</th>";
            echo "<th>NbPlaceExamen</th>";
            echo "<th>NbLignes</th>";
            echo "<th>NBCol</th>";
            echo "<th>NBSurv</th>";
            echo "<th>Type</th>";
            echo "<th>Disponible</th>";
            echo "<th>CodeDepartement</th>";
            echo "<th class='action-elements'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $ligne['Salle'] . "</td>";
                echo "<td>" . $ligne['Categorie'] . "</td>";
        
                echo "<td>" . $ligne['Responsable'] . "</td>";
                echo "<td>" . $ligne['Charge'] . "</td>";
                echo "<td>" . $ligne['NbPlaceExamen'] . "</td>";
                echo "<td>" . $ligne['NbLignes'] . "</td>";
                echo "<td>" . $ligne['NBCol'] . "</td>";
                echo "<td>" . $ligne['NBSurv'] . "</td>";
                echo "<td>" . $ligne['Type'] . "</td>";
                echo "<td>" . $ligne['Disponible'] . "</td>";
                echo "<td>" . $ligne['CodeDepartement'] . "</td>";
                echo "<td class='action-elements'>";
                echo "<a href='formupdate.php?Salle=" . $ligne['Salle'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                echo "<a href='delete.php?Salle=" . $ligne['Salle'] . "' class='btn btn-danger btn-sm'>Delete</a> ";
                echo "<button onclick='printDetails(" . json_encode($ligne) . ");' class='btn btn-info btn-sm'>Print Details</button>";
                echo "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

            echo "<div class='d-flex justify-content-center mt-3' id='printButtonContainer'>";
            echo "<button id='printButton' onclick='printDocument();' class='btn btn-success'>Print</button>";
            echo "</div>";
        
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
                <title>Details Salle ${details.Salle}</title>
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
                    <h1>Salle</h1>
                    <p><strong>Salle:</strong> ${details.Salle}</p>
                    <p><strong>Categorie:</strong> ${details.Categorie}</p>
                    <p><strong>Responsable:</strong> ${new Date(details.Responsable).toLocaleDateString()}</p>
                    <p><strong>Charge:</strong> ${details.Charge}</p>
                    <p><strong>NbPlaceExamen:</strong> ${details.NbPlaceExamen}</p>
                    <p><strong>NbLignes:</strong> ${details.NbLignes}</p>
                    <p><strong>NBCol:</strong> ${details.NBCol}</p>
                    <p><strong>NBSurv:</strong> ${details.NBSurv}</p>
                    <p><strong>Type:</strong> ${details.Type}</p>
                    <p><strong>Disponible:</strong> ${details.Disponible}</p>
                    <p><strong>CodeDepartement:</strong> ${details.CodeDepartement}</p>
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

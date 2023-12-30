<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste Rattrapage</title>
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

        $filterField = isset($_GET['filterField']) ? $_GET['filterField'] : 'NumRatV'; 
        $filterValue = isset($_GET['filterValue']) ? $_GET['filterValue'] : ''; 

        $requete = "SELECT * FROM ratvol WHERE $filterField LIKE '%$filterValue%'";

        $resultat = $conn->query($requete);

        if ($resultat->rowCount() == 0) {
            echo "La table ne contient aucun rattrapage...!<br>";
        } else {
            echo "<form method='get' action=''>";
            echo "<div class='form-row align-items-center'>";
            echo "<div class='col-auto'>";
            echo "<label class='sr-only' for='filterField'>Filter Field</label>";
            echo "<select class='form-control mb-2' name='filterField'>";
            echo "<option value='NumRatV' " . ($filterField === 'NumRatV' ? 'selected' : '') . ">NumRatV</option>";
            echo "<option value='MatProf' " . ($filterField === 'MatProf' ? 'selected' : '') . ">MatProf</option>";
            echo "<option value='DateRat' " . ($filterField === 'DateRat' ? 'selected' : '') . ">DateRat</option>";
            echo "<option value='Seance' " . ($filterField === 'Seance' ? 'selected' : '') . ">Seance</option>";
            echo "<option value='Session' " . ($filterField === 'Session' ? 'selected' : '') . ">Session</option>";
            echo "<option value='Salle' " . ($filterField === 'Salle' ? 'selected' : '') . ">Salle</option>";
            echo "<option value='Jour' " . ($filterField === 'Jour' ? 'selected' : '') . ">Jour</option>";
            echo "<option value='CodeClasse' " . ($filterField === 'CodeClasse' ? 'selected' : '') . ">CodeClasse</option>";
            echo "<option value='CodeMatiere' " . ($filterField === 'CodeMatiere' ? 'selected' : '') . ">CodeMatiere</option>";
            echo "<option value='Etat' " . ($filterField === 'Etat' ? 'selected' : '') . ">Etat</option>";
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

            echo "<h1>Liste Rattrapage</h1>";
            echo "<a href='formajout.php' class='btn btn-info mb-3' id='ajoutButton'>Ajout Rattrapage</a>";
            echo "<table class='table table-sm'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            echo "<th>NumRatV</th>";
            echo "<th>MatProf</th>";
            echo "<th>DateRat</th>";
            echo "<th>Seance</th>";
            echo "<th>Session</th>";
            echo "<th>Salle</th>";
            echo "<th>Jour</th>";
            echo "<th>CodeClasse</th>";
            echo "<th>CodeMatiere</th>";
            echo "<th>Etat</th>";
            echo "<th class='action-elements'>Action</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $ligne['NumRatV'] . "</td>";
                echo "<td>" . $ligne['MatProf'] . "</td>";
                $date = new DateTime($ligne['DateRat']);
                echo "<td>" . $date->format('d-m-y') . "</td>";
                echo "<td>" . $ligne['Seance'] . "</td>";
                echo "<td>" . $ligne['Session'] . "</td>";
                echo "<td>" . $ligne['Salle'] . "</td>";
                echo "<td>" . $ligne['Jour'] . "</td>";
                echo "<td>" . $ligne['CodeClasse'] . "</td>";
                echo "<td>" . $ligne['CodeMatiere'] . "</td>";
                echo "<td>" . $ligne['Etat'] . "</td>";
                echo "<td class='action-elements'>";
                echo "<a href='formupdate.php?NumRatV=" . $ligne['NumRatV'] . "' class='btn btn-primary btn-sm'>Update</a> ";
                echo "<a href='delete.php?NumRatV=" . $ligne['NumRatV'] . "' class='btn btn-danger btn-sm'>Delete</a> ";
                echo "<button onclick='printDetails(" . json_encode($ligne) . ");' class='btn btn-info btn-sm'>Print Details</button>";
                echo "</td>";
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
                <title>Details of Rattrapage ID ${details.NumRatV}</title>
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
                    <h1>Rattrapage</h1>
                    <p><strong>ID:</strong> ${details.NumRatV}</p>
                    <p><strong>MatProf:</strong> ${details.MatProf}</p>
                    <p><strong>DateRat:</strong> ${new Date(details.DateRat).toLocaleDateString()}</p>
                    <p><strong>Seance:</strong> ${details.Seance}</p>
                    <p><strong>Session:</strong> ${details.Session}</p>
                    <p><strong>Salle:</strong> ${details.Salle}</p>
                    <p><strong>Jour:</strong> ${details.Jour}</p>
                    <p><strong>CodeClasse:</strong> ${details.CodeClasse}</p>
                    <p><strong>CodeMatiere:</strong> ${details.CodeMatiere}</p>
                    <p><strong>Etat:</strong> ${details.Etat}</p>
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

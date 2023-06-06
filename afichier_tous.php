<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        header {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: 0px 5px 10px rgba(0, 0.1, 0.2, 0.5);
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
            font-size: 16px;
        }

        th {
            background-color: #f8f8f8;
            font-weight: bold;
            color: #333;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        caption {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        #Imprimer {
            margin-top: 10px;
            background-color: #168ddc;
            padding: 10px;
            border-radius: 5px;
            border: none;


        }
    </style>

<body style="background-color: #f8f8f8;">
    <div id="printable">
        <header>
            <h2>Fiche de calcul</h2>
        </header>
        <table>
            <thead>
                <tr>
                    <th>local</th>
                    <th>valeur1</th>
                    <th>valeur2</th>
                    <th>valeur3</th>
                    <th>Total</th>
                    <th> Total inferire 400</th>
                    <th>Total superire 400</th>

                </tr>
            </thead>
            <tbody>
                <?php
                include_once "dbconfig.php";
    
                $req = mysqli_query(
                    $conn,
                    "SELECT * FROM data_excel_file"
                );
                if (mysqli_num_rows($req) == 0) {
                    //s'il n'existe pas
                    echo '.<li id="client_id">Il n y a pas encore des données excel !</li>.';
                } else {
                    //si non , affichons la liste 
                    while ($row = mysqli_fetch_assoc($req)) {
                ?>
                        <tr>
                            <td> <?= $row['local'] ?> </td>
                            <td> <?= $row['v1'] ?> </td>
                            <td> <?= $row['v2'] ?> </td>
                            <td> <?= $row['v3'] ?> </td>
                            <td> <?= $row['Total'] ?> </td>
                            <td> <?= $row['inferieure'] ?> </td>
                            <td> <?= $row['superieur'] ?> </td>
                        </tr>
                <?php
                    }
                }
           
                ?>
            </tbody>
        </table>
    </div>
    <button id="Imprimer" onclick="window.print()">Imprimer</button>
</body>

</html>
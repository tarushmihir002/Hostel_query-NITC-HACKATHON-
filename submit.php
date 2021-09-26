<?php

require_once "config.php";
//error_reporting(0);

?>
<html>
    <head>
        <style>
            table,th {
                border: 2px solid black;
                padding: 2px;
            }
            td {
                border-right: 1px solid black;
                padding: 5px;
            }
        </style>
    </head>
    <body>
        <header>

        </header>
        <main>
            <?php

            $query = $con->prepare("INSERT INTO data (name, email, department, gender, query, hostel) VALUES(:n, :em, :dp, :gd, :qu, :ho)");
            $query->bindValue(":n", $_POST["name"]);
            $query->bindValue(":dp", $_POST["department"]);
            $query->bindValue(":em", $_POST["email"]);
            $query->bindValue(":gd", $_POST["gender"]);            
            $query->bindValue(":qu", $_POST["myText"]);            
            $query->bindValue(":ho", $_POST["hostel"]);            
            $query->execute();
            ?>
            <h3>Your all submitted queries</h3>
            <?php
                $query = $con->prepare("SELECT * FROM data WHERE email=:em");
                $query->bindValue(":em", $_POST["email"]);
                $query->execute();
                echo $query->rowCount();
                $html = "<table>
                            <thead>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Hostel</th>
                                <th>Query</th>
                                <th>Date</th>
                            </thead>
                            <tbody>";
                $i=1;
                while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                    $name = $row["name"];
                    $queries = $row["query"];
                    $hostel = $row["hostel"];
                    $date = $row["date"];
                    $html .= "<tr>
                        <td>$i</td>
                        <td>$name</td>
                        <td>$hostel</td>
                        <td>$queries</td>
                        <td>$date</td>
                        </tr>";
                    $i++;
                }

                $html .= "</tbody></table>";
                echo $html;
            ?>

        </main>
    </body>
</html>
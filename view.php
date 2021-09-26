<?php

require_once "config.php";

?>

<html>
    <body>
        <header>

        </header>
        <main>
        <?php
            $query = $con->prepare("SELECT * FROM data WHERE email=:em");
            $query->bindValue(":em", $_GET["email"]);
            $query->execute();
            $result = array();

            while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                echo $row;
            }
        ?>
        </main>
    </body>
</html>
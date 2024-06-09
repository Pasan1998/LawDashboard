
<?php 
function dbConn() {
    $server = "localhost";
    $user = "pererase_lawAdmin";
    $password = "Hansani@2024";
    $dbname = "pererase_law";

    $conn = new mysqli($server, $user, $password, $dbname);

    if ($conn->connect_error) {
        die("Database Error :" . $conn->connect_error);
    } else {
        return $conn;
    }
}

function cleanInput($input = null) {

    return htmlspecialchars(stripcslashes(trim($input)));
}

?>
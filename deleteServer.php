<?php

require '/includes/database.php';

$sqlDeleteServer = "DELETE FROM server
                    WHERE server_id = ?";

$db = connectToDatabase();

if (isset($_POST['submit'])){
    $server = $_POST['submit'];
    updateServerSatus($server, $db, $sqlDeleteServer);
}
?>
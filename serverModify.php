<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

// get the serverID, depending on which button has been presses
if(isset($_POST['submit'])){
    $serverID = $_POST['submit'];
} else {
    $serverID = $_POST['update'];
}

// sql to view all servers
$sqlViewAllServers = "SELECT s.server_name,
                             s.location_building,
                             s.location_room,
                             s.mac_address,
                             s.port_number,
                             s.ip_address,
                             s.operating_system,
                             CONCAT (a.first_name, ' ', a.last_name) AS admin_name,
                             s.comments,
                             s.server_id
                      FROM   server AS s
                      LEFT JOIN admin AS a
                      ON s.admin_1 = a.admin_id
                      OR s.admin_2 = a.admin_id
                      WHERE s.server_id = ?";

// sql to update server status to archived
$sqlUpdateServer = "  UPDATE server
                      SET    server_name = ?,
                             location_building = ?,
                             location_room = ?,
                             mac_address = ?,
                             port_number = ?,
                             ip_address = ?,
                             operating_system = ?,
                             comments = ?
                      WHERE  server_id = ?";

// get the server that has been selected on the previous page
if (isset($_POST['submit'])){
    $result = executeServerSelectFull($sqlViewAllServers, $db, $_POST['submit']);
}

// sanitise the user input
if(isset($_POST['update'])){

    $serverName = prepareString($_POST['serverName']);
    $serverBuilding = prepareString($_POST['serverBuilding']);
    $serverRoom = prepareString($_POST['serverRoom']);
    $serverMacAddress = prepareString($_POST['macAddress']);
    $serverPortNumber = prepareInt($_POST['portNumber']);
    $serverIP = prepareString($_POST['ipAddress']);
    $operatingSystem = prepareString($_POST['operatingSystem']);
    $comments = prepareString($_POST['comments']);
}

// if update has been pressed, execute the update to the database
if(isset($_POST['update'])){

    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sqlUpdateServer)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('ssssisssi', $serverName, $serverBuilding, $serverRoom, $serverMacAddress, $serverPortNumber, $serverIP, $operatingSystem, $comments, $serverID);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        // echo success messgae and redirect to servers main page
        echo "<script>alert('The server has been updated');</script>";
        echo '<script>window.location.href = "servers.php";</script>';
    }
}

?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Edit server</h1>
                </div>
            </div>
            <div class="row">                

                <form role="form" action="" method="POST" id="newServer">

                    <div class="col-xs-12 col-sm-12">

                        <p>Please enter the information below to sign up. * Denotes mandatory field</p>

                    </div>

                    <div class="col-xs-12 col-sm-6">
                        
                        <div class="form-group">
                            <label>Server Name *</label>
                            <input name="serverName" class="form-control" required type="text" value="<?php echo $result[0][0]; ?>">
                        </div>

                        <div class="form-group">
                            <label>Location - Building *</label>
                            <input name="serverBuilding" class="form-control" required type="text" value="<?php echo $result[0][1]; ?>">
                        </div>

                        <div class="form-group">
                            <label>Location Room *</label>
                            <input name="serverRoom" class="form-control" required type="text" value="<?php echo $result[0][2]; ?>">
                        </div>

                        <!-- TODO - convert to drop down list to select admin -->
                        <div class="form-group">
                            <label>Admin 1 *</label>
                            <input name="admin1" class="form-control" required type="text" value="<?php echo $result[0][7]; ?>" disabled>
                        </div>

                        <div class="form-group">
                            <label>Admin 2 *</label>
                            <input name="admin2" class="form-control" required type="text" value="<?php echo $result[1][7]; ?>" disabled>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">

                        <div class="form-group">
                            <label>MAC Address *</label>
                            <input name="macAddress" class="form-control" required type="text" value="<?php echo $result[0][3]; ?>">
                        </div>

                        <div class="form-group">
                            <label>IP Address *</label>
                            <input  name="ipAddress" class="form-control" required type="text" value="<?php echo $result[0][5]; ?>">
                        </div>

                        <div class="form-group">
                            <label>Port Number *</label>
                            <input  name="portNumber" class="form-control" required type="text" value="<?php echo $result[0][4]; ?>">
                        </div>

                        <div class="form-group">
                            <label>Operating System *</label>
                            <input name="operatingSystem" class="form-control" required type="text"  value="<?php echo $result[0][6]; ?>">
                        </div>

                        <div class="form-group">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" type="text"><?php echo $result[0][8]; ?></textarea>
                        </div>               

                    </div>            
                        
                    <button name="update" type="submit" class="btn btn-default" value="<?php echo $_POST['submit']; ?>">Update</button>
                    <button type="reset" class="btn btn-default">Reset</button>

                </form>


            </div>
        </div>
    </div>


<?php

include '/includes/footer.php';

?>
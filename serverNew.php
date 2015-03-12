<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

$sqlGetAdmin ="SELECT   admin_id,
                        CONCAT(first_name, ' ', last_name)
               FROM     admin";

// get the list of admins
$admins = executeAdminSelect($sqlGetAdmin, $db);

// insert new server into the database
$sqlInsertNewServer  = "INSERT INTO server(
                                    server_name,
                                    location_building,
                                    location_room,
                                    mac_address,
                                    port_number,
                                    ip_address,
                                    operating_system,
                                    admin_1,
                                    admin_2,
                                    comments)
                        VALUES      (?,?,?,?,?,?,?,?,?,?)";

if (isset($_POST['submit'])){
    addNewServer($_POST, $sqlInsertNewServer, $db );
}

?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Add new server</h1>
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
                            <input name="serverName" class="form-control" required type="text" autofocus>
                        </div>

                        <div class="form-group">
                            <label>Location - Building *</label>
                            <input name="serverBuilding" class="form-control" placeholder="e.g. Babbage" required type="text">
                        </div>

                        <div class="form-group">
                            <label>Location Room *</label>
                            <input name="serverRoom" class="form-control" placeholder="104" required type="text">
                        </div>

                        <div class="form-group">
                            <label>Admin 1 *</label>
                            <!-- Select Box -->
                            <select class="form-control" name="adminSelect1" id="selectBox">
                                <!-- Set a unselectable option for initial page load  -->
                                <option disabled selected> -- select an admin -- </option>
                                <?php
                                foreach ($admins as $key) { ?>
                                <option value="<?php echo $key['0']; ?>">
                                    <?php echo $key['1']; ?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Admin 2 *</label>
                            <!-- Select Box -->
                            <select class="form-control" name="adminSelect2" id="selectBox">
                                <!-- Set a unselectable option for initial page load  -->
                                <option disabled selected> -- select an admin -- </option>
                                <?php
                                foreach ($admins as $key) { ?>
                                <option value="<?php echo $key['0']; ?>">
                                    <?php echo $key['1']; ?>
                                </option>

                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-xs-12 col-sm-6">

                        <div class="form-group">
                            <label>MAC Address *</label>
                            <input name="macAddress" class="form-control" placeholder="e.g 12.d5.6b.55.c1.ad" required type="text">
                        </div>

                        <div class="form-group">
                            <label>IP Address *</label>
                            <input  name="ipAddress" class="form-control" placeholder="e.g 192.168.0.1" required type="text">
                        </div>

                        <div class="form-group">
                            <label>Port Number *</label>
                            <input  name="portNumber" class="form-control" placeholder="e.g 21453" required type="text">
                        </div>

                        <div class="form-group">
                            <label>Operating System *</label>
                            <input name="operatingSystem" class="form-control" placeholder="e.g Linux" required type="text">
                        </div>

                        <div class="form-group">
                            <label>Comments</label>
                            <textarea name="comments" class="form-control" type="text"></textarea>
                        </div>               

                    </div>            
                        
                    <button name="submit" type="submit" class="btn btn-default">Submit</button>
                    <button type="reset" class="btn btn-default">Reset</button>

                </form>


            </div>
        </div>
    </div>


<?php

include '/includes/footer.php';

?>
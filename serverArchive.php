<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

// sql to retrieve the full list of servers
$sqlViewAllServers = "SELECT s.server_name,
                             CONCAT (s.location_building, ' ', s.location_room) AS location,
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
                      WHERE s.archive = '0'";

 $sqlDeleteSever = "DELETE FROM server
                    WHERE s.server_id = ?";

// call the function to select server, passing appropriate SQL and database connection
$result = executeServerSelect($sqlViewAllServers, $db);


$sqlArchiveServer = "UPDATE server
                     SET archive = '1'
                     WHERE server_id = ?";

$sqlDeleteSever = "DELETE FROM server
                    WHERE s.server_id = ?";

// set the selected server to archive, getting the id from the submit button value
if (isset($_POST['submit'])){
    $server = $_POST['submit'];
    updateServerSatus($server, $db, $sqlArchiveServer);
}

?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View all users</h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="table-responsive">
                                <div id="dataTables-example_wrapper" class="dataTables_wrapper form-inline" role="grid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="dataTables_length" id="dataTables-example_length">
                                                <label>
                                                    <select name="dataTables-example_length" class="form-control input-sm">
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                    <option value="100">100</option>
                                                </select> records per page</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div id="dataTables-example_filter" class="dataTables_filter">
                                                <label>Search:<input type="search" class="form-control input-sm"></label>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="dataTables-example">
                                        <thead>
                                            <tr role="row">
                                                <th tabindex="0" rowspan="1" colspan="1">Server Name</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Location</th>
                                                <th tabindex="0" rowspan="1" colspan="1">MAC Address</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Port Number</th>
                                                <th tabindex="0" rowspan="1" colspan="1">IP</th>
                                                <th tabindex="0" rowspan="1" colspan="1">OS</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Admin</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Comments</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Archive</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            

                                            foreach ($result as $row) { 
                                                $rowColor = getTableRowColor($i);
                                                if (($i % 2) == 0) { ?>
                                                <tr class="gradeA <?php echo $rowColor; ?>">
                                                    <td class="sorting_1" rowspan="2"><?php echo $row['0'];?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['1']; ?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['2'];  ?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['3'];  ?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['4'];  ?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['5'];  ?></td>
                                                    <td class=" "><?php echo $row['6']; ?></td>
                                                    <td class=" " rowspan="2"><?php echo $row['7']; ?></td>
                                                    <td class=" " rowspan="2"><form action="" method="post">
                                                            <button name="submit" type="submit" class="btn btn-default" 
                                                            value="<?php echo $row['8']; ?>">Archive</button>
                                                        </form></td>
                                                </tr>
                                                <?php } else { ?>
                                                <tr class="gradeA <?php echo $rowColor; ?>">
                                                    <td class=" "><?php echo $row['6']; ?></td>
                                                </tr>
                                            <?php 
                                            
                                        } $i ++; } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php

include '/includes/footer.php';

?>
<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

// sql to get all authorised users
$sqlGetUnauthorisedUsers = "SELECT u.first_name,
                                   u.last_name,
                                   u.email,
                                   u.house_number,
                                   u.street,
                                   u.city,
                                   u.postcode,
                                   u.authorised,
                                   f.Name,
                                   u.user_id
                            FROM users AS u
                            LEFT JOIN faculty AS f
                            ON u.school = f.ID
                            WHERE u.authorised = '1'
                            AND u.archived = '0'";

// get all users details from the database
$result = executeUserSelect($sqlGetUnauthorisedUsers, $db);
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
                                                <th tabindex="0" rowspan="1" colspan="1">Name</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Email</th>
                                                <th tabindex="0" rowspan="1" colspan="1">Address</th>
                                                <th tabindex="0" rowspan="1" colspan="1">School</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 0;
                                            $rowColor = getTableRowColor($i);

                                            foreach ($result as $row) { ?>
                                                <tr class="gradeA <?php echo $rowColor; ?>">
                                                    <td class="sorting_1"><?php echo $row['0'] . " " . $row['1'] ;?></td>
                                                    <td class=" "><?php echo $row['2'] ?></td>
                                                    <td class=" "><?php echo $row['3'] . " " . $row['4'] . ", " . $row['5'] . ", " . $row['6']; ?></td>
                                                    <td class="center "><?php echo $row['8']; ?></td>
                                                </tr>
                                            <?php } ?>
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
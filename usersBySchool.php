<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

$sqlFaculty = "SELECT * FROM faculty";

// sql to get all users from the database
$sqlUserBySchool = "SELECT u.first_name,
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
                    AND u.archived = '0'
                    AND f.name = ?";

$faculty = executeFacultySelect($sqlFaculty, $db);

// when a specific school has been selected, get the new list
if (isset($_POST['schoolSelect'])){
    $selectedSchool = $_POST['schoolSelect'];

    $result = executeUserBySchoolSelect($sqlUserBySchool, $db, $_POST['schoolSelect']);
}

?>

    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">View users by schoool</h1>
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
                                                <div class="form-group">
                                                    <form action="" method="post">
                                                        <label>Select School</label>
                                                        <select class="form-control" name="schoolSelect" 
                                                                onchange="this.form.submit()" id="selectBox">
                                                            <!-- Set a unselectable option for initial page load  -->
                                                            <option disabled selected> -- select an option -- </option>
                                                            <?php
                                                            foreach ($faculty as $key) { ?>

                                                            <option value="<?php echo $key['1']; ?>" 
                                                                <?php 
                                                                if (isset($_POST['schoolSelect'])){
                                                                    if ($_POST['schoolSelect'] == $key['1']){ 
                                                                        echo 'selected="selected"';
                                                                    }
                                                                } ?>>
                                                                <?php echo $key['1']; ?>
                                                            </option>

                                                            <?php } ?>
                                                        </select>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-striped table-bordered table-hoverno-footer">
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
                                            if (isset($_POST['schoolSelect'])){
                                            $i = 0;
                                            $rowColor = getTableRowColor($i);

                                            foreach ($result as $row) { ?>
                                                <tr class="gradeA <?php echo $rowColor; ?>">
                                                    <td><?php echo $row['0'] . " " . $row['1'] ;?></td>
                                                    <td><?php echo $row['2'] ?></td>
                                                    <td><?php echo $row['3'] . " " . $row['4'] . ", " . $row['5'] . ", " . $row['6']; ?></td>
                                                    <td><?php echo $row['8']; ?></td>
                                                </tr>
                                            <?php } } ?>
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
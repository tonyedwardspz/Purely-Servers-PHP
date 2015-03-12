<?php

include '/includes/header.php';
include '/includes/navigation.php';

$db = connectToDatabase();

$sql = 'INSERT INTO users(
            first_name,
            last_name,
            email,
            house_number,
            street,
            city,
            postcode,
            school)
        VALUES (?,?,?,?,?,?,?,?)';

// get the user inputs, sanitising them to prevent code injection
if (isset($_POST['submit'])){
    $firstName = prepareString($_POST['firstName']);
    $lastName = prepareString($_POST['lastName']);
    $email = $_POST['email'];
    $houseNumber = prepareInt($_POST['houseNumber']);
    $street = prepareString($_POST['street']);
    $city = prepareString($_POST['city']);
    $postcode = prepareString($_POST['postcode']);
    $school = prepareString($_POST['school']);
}


if(isset($_POST['submit'])){

    $stmt = $db->stmt_init();

    if (!$stmt->prepare($sql)) {
        $error = $stmt->error;
        print_r($error);
    } else {

        $stmt->bind_param('sssissss', $firstName, $lastName, $email, $houseNumber, $street, $city, $postcode, $school);

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
    }
}


?>
    <div id="wrapper">
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">3</div>
                                    <div>New Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-tasks fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">6</div>
                                    <div>Servers</div>
                                </div>
                            </div>
                        </div>
                        <a href="servers.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-shopping-cart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">124</div>
                                    <div>New Orders!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-support fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">13</div>
                                    <div>Support Tickets!</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Server Uptime
                            <div class="pull-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                                        Actions
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Action</a>
                                        </li>
                                        <li><a href="#">Another action</a>
                                        </li>
                                        <li><a href="#">Something else here</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Server</th>
                                                    <th>Last Reboot</th>
                                                    <th>Time</th>
                                                    <th>Downtime cost</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:29 PM</td>
                                                    <td>£321.33</td>
                                                </tr>
                                                <tr>
                                                    <td>3325</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:20 PM</td>
                                                    <td>£234.34</td>
                                                </tr>
                                                <tr>
                                                    <td>3324</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:03 PM</td>
                                                    <td>£724.17</td>
                                                </tr>
                                                <tr>
                                                    <td>3323</td>
                                                    <td>10/21/2013</td>
                                                    <td>3:00 PM</td>
                                                    <td>£23.71</td>
                                                </tr>
                                                <tr>
                                                    <td>3322</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:49 PM</td>
                                                    <td>£8345.23</td>
                                                </tr>
                                                <tr>
                                                    <td>3321</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:23 PM</td>
                                                    <td>£245.12</td>
                                                </tr>
                                                <tr>
                                                    <td>3320</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:15 PM</td>
                                                    <td>£5663.54</td>
                                                </tr>
                                                <tr>
                                                    <td>3319</td>
                                                    <td>10/21/2013</td>
                                                    <td>2:13 PM</td>
                                                    <td>£943.45</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>
                                <!-- /.col-lg-4 (nested) -->
                                <div class="col-lg-8">
                                    <div id="morris-bar-chart" style="position: relative; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                                        <svg height="347" version="1.1" width="584" xmlns="http://www.w3.org/2000/svg" style="overflow: hidden; position: relative;">
                                            <desc style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">Created with RaphaÃ«l 2.1.2</desc>
                                            <defs style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></defs>
                                            <text x="33.5" y="313" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" 
                                            style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal;
                                             font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" 
                                             font-size="12px" font-family="sans-serif" font-weight="normal"><tspan dy="4" 
                                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">0</tspan>
                                         </text><path fill="none" stroke="#aaaaaa" d="M46,313H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                         <text x="33.5" y="241" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); 
                                         text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; 
                                         line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                         <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">25</tspan></text>
                                         <path fill="none" stroke="#aaaaaa" d="M46,241H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                         <text x="33.5" y="169" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" 
                                         style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; 
                                         font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" 
                                         font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">50</tspan>
                                     </text><path fill="none" stroke="#aaaaaa" d="M46,169H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path>
                                     <text x="33.5" y="97" text-anchor="end" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" 
                                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; font-weight: normal; 
                                     font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal">
                                     <tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">75</tspan></text><path fill="none" stroke="#aaaaaa" d="M46,97H559" 
                                     stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);"></path><text x="33.5" y="25" text-anchor="end" font="10px &quot;Arial&quot;" 
                                     stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: end; font-style: normal; font-variant: normal; 
                                     font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" 
                                     font-family="sans-serif" font-weight="normal"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">100</tspan>
                                 </text><path fill="none" stroke="#aaaaaa" d="M46,25H559" stroke-width="0.5" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                             </path><text x="522.3571428571429" y="325.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" 
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; 
                             font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" 
                             font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2014</tspan></text>
                             <text x="375.7857142857143" y="325.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" 
                             style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; 
                             font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" 
                             font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2013</tspan>
                         </text><text x="229.21428571428572" y="325.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" 
                         fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; 
                         font-stretch: normal; font-size: 12px; line-height: normal; font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" 
                         transform="matrix(1,0,0,1,0,7)"><tspan dy="4" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2011</tspan></text><text x="82.64285714285714" 
                         y="325.5" text-anchor="middle" font="10px &quot;Arial&quot;" stroke="none" fill="#888888" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); 
                         text-anchor: middle; font-style: normal; font-variant: normal; font-weight: normal; font-stretch: normal; font-size: 12px; line-height: normal; 
                         font-family: sans-serif;" font-size="12px" font-family="sans-serif" font-weight="normal" transform="matrix(1,0,0,1,0,7)"><tspan dy="4" 
                         style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0);">2010</tspan></text><rect x="55.160714285714285" y="25" width="25.98214285714286" 
                         height="288" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                     </rect><rect x="84.14285714285714" y="53.80000000000001" width="25.98214285714286" height="259.2" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" 
                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="128.44642857142858" y="97" width="25.98214285714286" height="216" r="0" 
                     rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                     <rect x="157.42857142857144" y="125.80000000000001" width="25.98214285714286" height="187.2" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" 
                     fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                     <rect x="201.73214285714286" y="169" width="25.98214285714286" height="144" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" 
                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="230.71428571428572" y="197.8" width="25.98214285714286" 
                     height="115.19999999999999" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); 
                     fill-opacity: 1;"></rect><rect x="275.01785714285717" y="97" width="25.98214285714286" height="216" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" 
                     fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="304" y="125.80000000000001" width="25.98214285714286" 
                     height="187.2" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect>
                     <rect x="348.30357142857144" y="169" width="25.98214285714286" height="144" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" 
                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="377.28571428571433" y="197.8" width="25.98214285714286" 
                     height="115.19999999999999" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); 
                     fill-opacity: 1;"></rect><rect x="421.5892857142857" y="97" width="25.98214285714286" height="216" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" 
                     fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="450.57142857142856" y="125.80000000000001" 
                     width="25.98214285714286" height="187.2" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" 
                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="494.87500000000006" y="25" 
                     width="25.98214285714286" height="288" r="0" rx="0" ry="0" fill="#0b62a4" stroke="none" fill-opacity="1" 
                     style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;"></rect><rect x="523.8571428571429" y="53.80000000000001" width="25.98214285714286" 
                     height="259.2" r="0" rx="0" ry="0" fill="#7a92a3" stroke="none" fill-opacity="1" style="-webkit-tap-highlight-color: rgba(0, 0, 0, 0); fill-opacity: 1;">
                 </rect></svg><div class="morris-hover morris-default-style" style="display: block; left: 188.214285714286px; top: 136px;"><div class="morris-hover-row-label">2014</div>
                 <div class="morris-hover-point" style="color: #0b62a4">
  Series A:
  50
</div><div class="morris-hover-point" style="color: #7a92a3">
  Series B:
  40
</div></div></div>
                                </div>
                                <!-- /.col-lg-8 (nested) -->
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.panel-body -->
                    </div>



        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->

<?php

include '/includes/footer.php';

?>
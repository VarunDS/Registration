<?php session_start ();
require_once "dbConfig.php"; ?>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/src/loader.css">

    <script src="scripts/min/jquery/jquery-2.2.4.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href=" //maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css">
    <script src='scripts/min/bootstrap/bootstrap-tags.min.js'></script>
    <script src='scripts/min/bootstrap/bootstrap-tagsinput.min.js'></script>
    <link rel="stylesheet" type="text/css" href="styles/src/bootstrap-tags.css"/>
    <link rel="stylesheet" type="text/css" href="styles/src/bootstrap-tagsinput.css"/>

    <script src="scripts/src/admin.js"></script>

    <link rel="stylesheet" href="styles/src/home.css">
    <
</head>
<body style="background: url('images/BodyBG.jpg')">
<div class="loader">
</div>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="background-color: silver">
    <div class="container  text-center">
        <div class="navbar-header">
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span>
                        <strong><?php $fname = explode (" ", $_SESSION['name']);
                            echo $fname[0] ?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user icon-size"></span>
                                        </p>
                                    </div>
                                    <div class="col-lg-8">
                                        <p class="text-left"><strong><?php echo $_SESSION['name'] ?></strong></p>
                                        <p class="text-left small"><?php echo $_SESSION['email']; ?></p>
                                        <p class="text-left">
                                            <a href="#" class="btn btn-primary btn-block btn-sm">Profile</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider navbar-login-session-bg"></li>
                        <li><a href="#">Account Settings <span class="glyphicon glyphicon-cog pull-right"></span></a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">Messages <span class="badge pull-right"> 42 </span></a></li>
                        <li class="divider"></li>

                        <li><a href="Logout.php">Sign Out <span
                                        class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                    </ul>
                </li>
            </ul>
        </div>

    </div>
</div>

<div style="padding: 70px;">
    <ul id="myTab" class="nav nav-tabs">
        <li class="active"><a href="#UserProfile" data-toggle="tab">User Profile</a></li>
        <li class=""><a href="#users" data-toggle="tab">Users</a></li>
        <li class=""><a href="#rights" data-toggle="tab">My Rights</a></li>
        <li class=""><a href="#messages" data-toggle="tab" class="label label-info" style="border-radius: 25px;  ">My
                Messages <span class="badge">3</span></a></li>
        <li class=""><a href="#notifications" data-toggle="tab">My Notifications</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="padding-top: 10px; ">
        <div class="tab-pane fade active in" id="UserProfile" style="background-color: silver">
            <form class="well form-horizontal" action="ajax_UserProfile.edit.php" method="post" id="user_profile">
                <div class="form-group">
                    <label class="col-md-4 control-label">First Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="Fname" placeholder="First Name" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Last Name</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                            <input name="Lname" placeholder="Last Name" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Date of Birth</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            <input name="DOB" placeholder="YYYY/MM/DD" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">E-Mail</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                            <input name="Email" placeholder="E-Mail Address" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Phone #</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                            <input name="Phone" placeholder="(845)555-1212" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Address</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="Address" placeholder="Address" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-4 control-label">Zip Code</label>
                    <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-home"></i></span>
                            <input name="Zip" placeholder="Zip Code" class="form-control" type="text">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-4 control-label"></label>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-success">Save <span
                                    class="glyphicon glyphicon-floppy-disk"></span></button>
                        <button type="submit" class="btn btn-warning">Reset <span
                                    class="glyphicon glyphicon-refresh"></span></button>
                    </div>
                </div>
                <div id="user_profile_messages"></div>
            </form>
        </div>
        <div class="tab-pane fade" id="users">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>Users</strong></div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-btn">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">Filters<span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" id="Filters" role="menu">
                                    </ul>
                                </div><!-- /btn-group -->
                                <div class="input-group"><input type="text" class="form-control" id="tagsInputSearch"
                                                                data-role="tagsinput" placeholder="Search Filters">

                                    <button type="button" class="btn btn-primary" id="filter_search">
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="keyword_search"
                                       placeholder="Search Keywords">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" id="click_keyword_search" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>


                    <table id="userTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>
                                <div class="btn-group">
                                    <label class="btn btn-default ">
                                        <input type="checkbox" id="example-select-all">  <!-- type checkbox -->
                                    </label>
                                    <button type="button" class="btn btn-default dropdown-toggle"
                                            style="height: 30px" data-toggle="dropdown">
                                        <span class="caret"></span>  <!-- caret -->
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu"> <!-- class dropdown-menu -->
                                        <li><i class="glyphicon glyphicon-duplicate" style="padding: 10px"></i><span
                                                    style="padding-left: 10px">Merge</span></li>
                                        <li class="divider"></li>
                                        <li><i class="glyphicon glyphicon-trash" style="padding: 10px"></i><span
                                                    style="padding-left: 10px">Delete</span></li>
                                        <li class="divider"></li>
                                        <li><i class="glyphicon glyphicon-export" style="padding: 10px"></i><span
                                                    style="padding-left: 10px">Export</span></li>
                                    </ul>
                                </div>
                            </th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th style="width: 51px">
                            <span class="glyphicon glyphicon-option-horizontal"
                                  style="font-size: 20px"></span>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="rights">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>My Rights</strong></div>
                <div class="panel-body"></div>
                <div class="container  text-center" style="padding-top: 10px">
                    <div class="row" style="width: 1098px">
                        <div class="col-xs-3">
                            <div><?php
                                $permissionsGrantedQuery
                                    = "SELECT perm_desc 
                                        FROM permissions p          
                                        INNER JOIN role_perm rp       
                                        ON p.perm_id=rp.perm_id   
                                        INNER JOIN user_role ur   
                                        ON  rp.role_id=ur.role_id   
                                        WHERE ur.user_id='" . $_SESSION['id'] . "'";
                                $permissionsGranted = mysqli_query ($con, $permissionsGrantedQuery);
                                ?>
                                <ul class="list-group"
                                    style="padding: 10px; font-variant-caps: all-petite-caps; font-weight: bold;">
                                    <?php
                                    while ($grantedRows = mysqli_fetch_array ($permissionsGranted)) {
                                        ?>

                                        <li class="list-group-item list-group-item-success"
                                            style="width: 200px;"><?php echo $grantedRows['perm_desc']; ?><span
                                                    class="glyphicon glyphicon-ok pull-right ok-cstm"></span></li>
                                        <?php
                                    }
                                    $allPermissionsQuery
                                        = "SELECT pi.perm_desc    
                                            FROM permissions pi  
                                            WHERE pi.perm_id   
                                            NOT IN (SELECT p.perm_id 
                                            FROM permissions p 
                                            INNER JOIN role_perm rp ON p.perm_id=rp.perm_id 
                                            INNER JOIN user_role ur 
                                            ON  rp.role_id=ur.role_id 
                                            WHERE ur.user_id='" . $_SESSION['id'] . "')";
                                    $allPermissions = mysqli_query ($con, $allPermissionsQuery);
                                    while ($allPermissionsRows = mysqli_fetch_array ($allPermissions)) { ?>
                                        <li class="list-group-item list-group-item-danger"
                                            style="width: 200px;"><?php echo $allPermissionsRows['perm_desc']; ?><span
                                                    class="glyphicon glyphicon-remove pull-right remove-cstm"></span>
                                        </li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xs-9" style="padding-top: 10px;">
                            <div class="row">
                                <div class="col-xs-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="font-size: 15px;"><strong>Read
                                                Permission</strong></div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>View my details</li>

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="font-size: 15px;"><strong>Write
                                                Permission</strong></div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Write new Messages</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="font-size: 15px;"><strong>Edit
                                                Permission</strong></div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Edit my details</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-6">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading" style="font-size: 15px;"><strong>Delete
                                                Permission</strong></div>
                                        <div class="panel-body">
                                            <ul>
                                                <li>Delete my account</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="messages">
            <div class="panel panel-default">
                <div class="panel-heading"><strong>My Messages</strong></div>
                <div class="panel-body">
                    <div class="container text-center" style="width: 992px">
                        <table id="messageTable" class="table table-striped table-bordered" cellspacing="0"
                               width="100%">
                            <thead>

                            <tr>

                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>

                                <th>
                                <span class="glyphicon glyphicon-option-horizontal"
                                      style="font-size: 20px"></span>
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Name</td>
                                <td>Position</td>
                                <td>Office</td>
                                <td>Age</td>
                                <td style="width: 115px;">
                                    <div class="btn-group">
                                        <button type="button"
                                                class="btn btn-default glyphicon glyphicon-eye-open"></button>
                                        <div class="btn-group">
                                            <button type="button"
                                                    class="btn btn-default glyphicon glyphicon-cog dropdown-toggle"
                                                    data-toggle="dropdown">
                                                <span class="caret"></span></button>
                                            <ul class="dropdown-menu" role="menu" style="white-space: nowrap">
                                                <li><i class="glyphicon glyphicon-pencil"
                                                       style="padding: 10px;"></i><span
                                                            style="padding-left: 10px">Edit</span></li>
                                                <li class="divider"></li>
                                                <li><i class="glyphicon glyphicon-trash" style="padding: 10px"></i><span
                                                            style="padding-left: 10px">Delete</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="notifications">My notifications</div>
    </div>
</div>

</body>
</html>


<?php
require_once 'dbConfig.php';
if (session_status () == 1) {

    if (isset($_SESSION['id'])) {
        echo $_SESSION['id'];
    } else {
        echo "Some issue is there";
    }

}
?>


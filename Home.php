<?php session_start (); ?>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles/src/loader.css">

    <script src="scripts/min/jquery/jquery-2.2.4.min.js"></script>
    <script src="scripts/min/jquery/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>

    <script src="scripts/src/home.js"></script>
    <link rel="stylesheet" href="styles/src/home.css">
</head>
<body style="background: url('images/BodyBG.jpg')">
<div class="loader">
</div>

<div class="navbar navbar-default navbar-fixed-top" role="navigation" style="background-color: silver">
    <div class="container">
        <div class="navbar-header">

            <h2 style="padding-bottom: 5px"><span class="label label-primary">Welcome</span></h2>
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
        <li class=""><a href="#profile" data-toggle="tab">Profile</a></li>
    </ul>
    <div id="myTabContent" class="tab-content" style="padding-top: 10px">
        <div class="tab-pane fade active in" id="UserProfile" style="opacity: .9">
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
        <div class="tab-pane fade" id="profile">
            <p>tab2.</p>
        </div>
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


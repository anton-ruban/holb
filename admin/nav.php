<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">Holb Dashboard</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account settings <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="../reset-password.php?type=1">Reset Password</a></li>
                <li class="divider"></li>
                <li><a href="../logout.php?type=1">Logout</a></li>
            </ul>
        </li>
    </ul>

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li><a href="dashboard.php" class="events">Events</a></li>
                <li><a href="jobs.php" class="jobs">Jobs</a></li>
                
                <li>
                    <a href="#">Settings</a>
                    <ul class="nav nav-second-level">
                        <li><a href="../reset-password.php?type=1">Reset Password</a></li>
                        <li><a href="../logout.php?type=1">Log Out</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
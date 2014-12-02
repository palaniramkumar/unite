<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="../index.php"><img src="../img/logo_sm.png"/>SSN Unite <span class="badge">&beta;eta</span></a>
        </div>
        <div class="collapse navbar-collapse " >
          <ul class="nav navbar-nav">
            
              <li><a href="feedback.php">Feedback</a></li>
              <li><a href="../activity/index.php">Activities</a></li>
            <li><a href="poll.php">Poll</a></li>
            <li><a href="report.php">Report</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="../activity/user.php?id=<?=$_SESSION[uid]?>">Profile</a></li>
                <li><a href="#">IP Trace</a></li>
                
                <li class="divider"></li>
                <li><a href="CreateEvent.php">Create Event</a></li>
                <li><a href="CreatePost.php">Create Page</a></li>
                <li class="divider"></li>
                <li><a href="../logout.php">Logout</a></li>
              </ul>
            </li>
           </ul>
            <p class="navbar-text  navbar-right ">An Official website from SSNITE</p>
        </div>
          
          
          <!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
    <div id="loading">Loading</div>
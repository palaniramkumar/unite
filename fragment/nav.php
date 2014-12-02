<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="<?=getHost()?>index.php"><img src="<?=getHost()?>/img/logo_sm.png"/>SSN Unite <span class="badge">&beta;eta</span></a>
        </div>
        <div class="collapse navbar-collapse" >
          <ul class="nav navbar-nav">
              <li><a href="<?=  getHost()?>about.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="About our Unite Organization" data-original-title="" title="">About Us</a></li>
              
              <li><a href="<?=getHost()?>contact.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Contact Alumni Members" data-original-title="" title="">Contact Us</a></li>
              <li><a href="<?=getHost()?>scholarships.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Give your hands to the students" data-original-title="" title="">Scholarship</a></li>
		<li><a href="<?=getHost()?>entrepreneur.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Start-ups from our alumni" data-original-title="" title="">Start-Up's</a></li>
		<li><a href="<?=getHost()?>opensource.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Opensource Products from our alumni" data-original-title="" title="">Opensource</a></li>
		<li><a href="<?=getHost()?>gallery.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Latest SSN Event / Campus Shoots" data-original-title="" title="">Gallery</a></li>

            <?if($_SESSION['uname']!=NULL){?>
            <li ><a href="<?=getHost()?>activity/index.php"  data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="You can colloborate with all Alumni from one place." data-original-title="" title="">Activities</a></li><?}?>
             <?if($_SESSION['urole']=="Admin"){?>
            <li ><a href="<?=getHost()?>admin/index.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Administating the website" data-original-title="" title=""> Admin Panel</a></li><?}?>
                      </ul>
             
            
               <?php 
            if($_SESSION['uname']==NULL){?>
           
            
            <ul class="nav navbar-nav pull-right">
      
          <li class="divider-vertical"></li>
          <li class="dropdown">
            <a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>
            <div class="dropdown-menu" style="padding: 10px; padding-bottom: 0px; width: 250px" >
                <form method="post" action="#?login" accept-charset="UTF-8" style="padding: 10px" class="navbar-form ">
                    <div class="form-group">     
                    <input style="margin-bottom: 15px;width:200px" type="text" placeholder="email" class="form-control  input-sm"  id="username" name="uname">
                </div>
                <div class="form-group">     
                    <input style="margin-bottom: 15px;width:200px" type="password" placeholder="Password" class="form-control  input-sm" id="password" name="upass">
                </div>
                
                <input class="btn btn-default btn-block" type="submit" id="sign-in" onclick="submit()" value="Sign In">
                <p style="margin-top:5px"><hr/> </p>
                <input class="btn btn-google-plus btn-block" type="button" onclick="javascript:window.location.replace('./class/googleAPI/googleOAUTH.php?action=signin');" id="sign-in-google" value="Sign In with Google">
                
                <input class="btn btn-facebook btn-block" type="button" onclick="javascript:window.location.replace('./class/fbAPI/fbOAUTH.php?action=signin');" id="sign-in-facebook" value="Sign In with Facebook">
               </form>
            </div>
          </li>
          <li><a href="register.php">Sign Up</a></li>
          <li data-toggle="modal" href="#forgot"><a href="#" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="bottom" data-content="Lost Password / Activation link ?" data-original-title="" title="">Forgot Password</a></li>
        </ul>
            
            <? } else if($_SESSION['uname']!=NULL){?>
            
             <ul class="nav navbar-nav navbar-right ">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='glyphicon glyphicon-user'></span> <?=$_SESSION['uname']?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="<?=getHost()?>/activity/user.php?id=<?=$_SESSION[uid]?>" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="View your profile, this is viewable by all other alumni" data-original-title="" title="">View My Prifile</a></li>
                  <li><a href="<?=getHost()?>/activity/changepassword.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Edit your profile details" data-original-title="" title="">Edit Profile</a></li>
                  <li><a href="https://docs.google.com/forms/d/1Ae4HriEZAQ9lvYyXZuPIdmudV0pXdx7sO533TXBJX1M/viewform" target="_blank" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="Please give your feedback" data-original-title="" title="">Give Feedback</a></li>
                <li class="divider"></li>
                
                <li><a href="<?=getHost()?>/activity/createpage.php" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="left" data-content="You can create your own blog and share it to others" data-original-title="" title="">Create Page</a></li>
                <li class="divider"></li>
                <li><a href="<?=getHost()?>logout.php">Logout</a></li>
              </ul>
            </li>
             </ul>
            <?}?>
                 
             
            <p class="navbar-text  navbar-left " ><?= $status!="notverified"?"":"<span class='badge'>Pending with Admin Approval</span>"; ?><?= $status!="false"?"":"Credential is invalid. Are u <a href='register.php'><span class='badge'> New User?</span></a>"; ?><?= $_REQUEST["msg"]!="unauthorized"?"":"<span class='badge'>Please login  to continue </span>"; ?></p>
            
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->
<div id="loading"> Loading </div>
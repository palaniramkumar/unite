<?php 
require_once('../class/poll.php');
require_once('../class/CommonMethod.php');
require_once('../class/usergroups.php');
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          
               <div class=" sidebar-nav" >
                   
          <img class="featurette-image img-responsive"  height="128" src="<?=getProfilePic($_SESSION[uid])?>">
       
              
            <div class="row">
      
       
                <div class="list-group">
                    
  <a href="#" class="list-group-item active">
    Activities
  </a>
                  
                    
                    
  <a href="pages.php" class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="View blogs created by you and other alumni" data-original-title="" title="">Pages</a>
  <a href="friends.php" class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Do you want to see your friends ? Click here" data-original-title="" title="">Friends</a>
  <a href="msg.php" class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Offline Messenger, to comunicate with Alumni" data-original-title="" title="">Message </a>
  <a href="../job/" class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check My job " data-original-title="" title="">Jobs <span class="badge">Update</span></a>
  <a href="SSNClicks.php" class="list-group-item" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Share your memories with images" data-original-title="" title="">SSN Click <span class="badge">New</span></a>
  
</div>
   
<div class="list-group">
  <a href="#" class="list-group-item active">
    Groups
  </a>
 <?=  getGrouplinks()?>
</div>             
                
 <div class="list-group">
  <a href="#" class="list-group-item active">
    Upcoming Birthday
  </a>
 <?=upcomingBirthday()?>
</div>


      
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Poll</h3>
            </div>
            <?= $_SESSION["poll"]=="true"?  resultPoll(): latestPoll()?>
              
          </div>
          <div class="panel panel-danger">
            <div class="panel-heading">
              <h3 class="panel-title">Invite My friend</h3>
            </div>
            <div class="panel-body">
              <div class="input-group">
                  <input type="text" id="friendemail"  placeholder="abc@ssn.com"class="form-control">
      <span class="input-group-btn" >
        <button class="btn btn-default" type="button" onclick="invitefriend($('#friendemail').val())">Invite</button>
      </span>
    </div>
            </div>
          </div>
       
      </div>
          </div><!--/.well -->
        </div><!--/span-->
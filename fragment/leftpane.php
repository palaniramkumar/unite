
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class=" sidebar-nav">
            <div class="row">
       
          <div class="panel panel-default">
            
            <div class="panel-body"> 
             <?=getTributeCounter();?>
            </div>
              
          <!--/div-->
         
          </div>

       <!--div class="list-group">
           
            <a href="Bus_routes -Alumni meet 2014.pdf" target="_blank" class=" btn btn-facebook btn-block">
                <span class="glyphicon glyphicon-road"></span>
                Tribute '14 Transporation Details

            </a>
           
        </div-->
   
       <div class="panel panel-info">
            <div class="panel-body">
              <?=getsocial( "http://ssnunite.com".$_SERVER['REQUEST_URI'])?>
            </div>
          </div>
       <div class="list-group">
           
            <a href="video.php" class="list-group-item">
                <span class="glyphicon glyphicon-film"></span>
                Watch Our Official Videos

            </a>
           
        </div>
                <div class="list-group">
            <a href="https://docs.google.com/forms/d/1Ae4HriEZAQ9lvYyXZuPIdmudV0pXdx7sO533TXBJX1M/viewform" target='_blank' class="list-group-item">
                <span class='glyphicon glyphicon-gift'></span>
                Report Website Issue

            </a>
           
        </div>

        
          <div class="list-group">
                                <a href="#" class="list-group-item active"><span class='glyphicon glyphicon-thumbs-up'></span> Our Hands</a>
                                <a href="https://sites.google.com/a/ssnalumni.com/website/usa-chapter" class="list-group-item">US Chapter</a>
                                <a href="http://alumni.ssn.edu.in/" class="list-group-item">SSN Alumni(SSN Portal)</a>
                                
                            </div>
          
        
          <!--div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Twitter Updates</h3>
            </div>
            <div class="panel-body">
              Coming Soon...
            </div>
          </div-->
          <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><span class="glyphicon glyphicon-info-sign"> </span>Vote Poll</h3>
            </div>
            <div class="panel-body" id="polldiv">
              <?= $_SESSION["poll"]=="true"?  resultPoll(): latestPoll()?>
                
                
                
            </div>
          </div>
       
      </div>

          </div><!--/.well -->
        </div><!--/span-->
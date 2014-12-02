<?php
require_once('./class/HealthCheck.php');
require_once('./class/dbConnection.php');
require_once('./class/CommonMethod.php');
require_once('./class/widget.php');
require_once('./class/poll.php');
$status="true";
if($_POST["uname"]!=NULL){
    $con= new dbConnection();
    $status=  $con->validateUser($_POST["uname"], $_POST["upass"]) ;
    
}
 $sql="select * from Scholarship;";
    require_once('./class/dbConnection.php');
        $db = new dbConnection();
        $con = $db->getConnection();
        //echo $sql;
        //Execute insert query
        $result = mysqli_query($con, $sql);

        if (!$result) {
            die('Invalid query: ' . mysql_error());
        }
        if($row = mysqli_fetch_array($result)){
            $fundNote=$row["fundNote"];
            $studentlist=$row["studentlist"];
            $Testimonial=$row["Testimonial"];
        }
        mysqli_close($con);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="SSN Unite">
    <link rel="shortcut icon" href="./ico/favicon.png">

    <title>SSN Unite - Scholarships</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/offcanvas.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="./js/html5shiv.js"></script>
      <script src="./js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
     <?php 
        @include("./fragment/nav.php");
    ?>

    <div class="container">

     <ol class="breadcrumb">
  <li><a href="#">Home</a></li>
  <li class="active">Scholarships</li>
</ol>

        
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row">
		  
            

      
	  <div class="panel-body" >
	  <div id="myCarousel" class="carousel slide">
                            <!-- Indicators -->
                            <ol class="carousel-indicators">
                                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                <li data-target="#myCarousel" data-slide-to="1"></li>
                                <li data-target="#myCarousel" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="item active">
                                    <img src="img/s1.jpg" alt="First slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <!---<h1>About SSN Unite</h1>
                                            <p>The SSN Alumni Association has been in existence since 2003 in a rather informal way. The institution has held Annual Alumni meetings on the 15th of August every year. These meetings have always been attended by a core group of Alumni members.</p>
                                            <p><a class="btn btn-large btn-primary" href="register.php">Sign up today</a></p>---->
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="img/s2.jpg" alt="Second slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <!---<h1>Tribute SSN</h1>
                                            <p>Tribute is the official alumni meet for SSN institutions. It started in 2010 with an enormous participation of more than 500 alumni all across the globe. This event is organized by the SSN Alumni Association with support from the college.</p>
                                            <p><a class="btn btn-large btn-primary" href="page.php?id=37">Learn more</a></p>--->
                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <img src="img/s3.jpg" alt="Third slide">
                                    <div class="container">
                                        <div class="carousel-caption">
                                            <!---<h1>Scholarship Day</h1>
                                            <p>The onset of the month of November had the SSNites buzzing as the D-day, the Scholarship Day, was due. The students hard work during the previous year was being rewarded at the Annual Scholarship Function</p>
                                            <p><a class="btn btn-large btn-primary" href="scholarships.php">About Scholarship</a></p>--->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
                            <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
                        </div><!-- /.carousel -->
        <!---<div class="col-md-4" >
		
          <!---<img class="featurette-image img-responsive"  src="data:image/png;base64," data-src="holder.js/250x250/auto" alt="Generic placeholder image">
		  <img class="featurette-image img-responsive"  src="img/Scholarship.png" alt="Generic placeholder image">
        </div>
        <div class="col-md-7 well">
          <h2 class="featurette-heading" ><span class="text-muted">Student </span> Scholarships</h2>
          <p class="lead">
The unique feature of SSN Institutions is the scholarships awarded to students to encourage merit and to make education accessible to students of all economic strata. The Institution has initiated a thriving tradition of over 400 scholarships offered every year to meritorious and deserving students.</p>
        </div>---->
      </div>
        
      </div>
<div class="panel panel-default">
     
    <div style="margin: 10px">
              <ul class="nav nav-tabs" style="margin-bottom: 15px;">
                <li class="active"><a href="#home" data-toggle="tab">Students</a></li>
                <li><a href="#profile" data-toggle="tab">How To Give</a></li>
                <li><a  href="#contribution" data-toggle="tab">Contribution</a>
		
		</li>
                
              </ul>
              <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <div style="margin-bottom:5px; ">A brief description of the various scholarships is given below and the amount in brackets is the approximate value of the scholarship:</div>
                <div class="list-group">
  <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading">Merit Scholarship [Gift Code : MS]</h4>
    <p class="list-group-item-text">   Based on the academic performance at the qualifying examinations for freshers, and in the case of senior students, the performance during the previous year. The scholarship     offers a waiver of tuition fees, free hostel stay and boarding/grant towards living expenses and an allowance for books. All the Engineering, MBA and MCA programs at the     Institution are covered under the Scholarship program.</p>
  </a>
                    <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading"> Merit-cum-Means Scholarship [Gift Code : MMS]</h4>
    <p class="list-group-item-text">    The scholarship offers a waiver of tuition fees, free hostel stay and boarding/grant towards living expenses and an allowance for books. Academic performance and     demonstrated economic need are the key criteria for this scholarship.</p>
  </a>
                    <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading"> Waiver of Tuition Fees [Gift Code : WTF]</h4>
    <p class="list-group-item-text">    First year students of the college who secure the highest marks in the Plus Two examinations have their entire tuition fees waived for the first academic year. Similarly, senior     students are offered scholarships on the basis of their previous year&lsquo;s performance.</p>
  </a>
                    <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading">Walk-in-Walk-out Scholarships [Gift Code : WIWO]</h4>
    <p class="list-group-item-text">    A top ten rank holder of any State or Central Board Examination at the Plus Two or equivalent level are entitled to pursue the B.E. / B.Tech. degree at SSN College of Engineering     absolutely free of cost.</p>
  </a>
</div>
                
                </div>
<div class="tab-pane fade" id="contribution">
<table class="table table-striped">
<thead>
<th>Alumni Name</th>
<th>Department</th>
<th>Contributions (Rs.)</th>
</thead>
<tr><td>Varun Gupta</td><td>MSIT 2004</td><td>50000</td></tr>
<tr><td>Surplus from last year</td><td></td><td>33550</td></tr>
<tr><td>Madhan Kumar</td><td>MCA 2007</td><td>30000</td></tr>
<tr><td>Shyamal Rao Palli</td><td>IT 2006</td><td>25010</td></tr>
<tr><td>Prerit Mittal</td><td>2003</td><td>25000</td></tr>
<tr><td>Avanidhar</td><td>IT 2007</td><td>24400</td></tr>
<tr><td>Thangaprakash</td><td>ECE 2007</td><td>24400</td></tr>
<tr><td>Kalicharan Karthikeyan</td><td>MSIT 2004</td><td>20000</td></tr>
<tr><td>Anand Govindarajan</td><td>Chem 2008</td><td>19215</td></tr>
<tr><td>Upasana Manimegalai Sridhar</td><td>Chem 2009</td><td>19215</td></tr>
<tr><td>Venkatesh Govindarajan</td><td>Chem 2009</td><td>19215</td></tr>
<tr><td>Niyaz Ahmed</td><td>CSE 2010</td><td>15439</td></tr>
<tr><td>Ananda Vigneswaran S</td><td>ECE 2005</td><td>15000</td></tr>
<tr><td>Suresh Kumar Jayaraman</td><td>Chem 2009</td><td>12200</td></tr>
<tr><td>Kameshwari Ravi</td><td>Chem 2012</td><td>12200</td></tr>
<tr><td>Jason Bosco</td><td></td><td>12200</td></tr>
<tr><td>Kaarthy & Archana</td><td>EEE 2005</td><td>12200</td></tr>
<tr><td>Thanigeswara</td><td>MCA 2003</td><td>10000</td></tr>
<tr><td>Prabaharan B</td><td>MBA 2009</td><td>10000</td></tr>
<tr><td>Manav Chauhan</td><td>ECE 2002</td><td>10000</td></tr>
<tr><td>Ramprasad Ramachandran</td><td>CSE 2009</td><td>10000</td></tr>
<tr><td>Tirumala Nambi Charities - Srivatsan</td><td>2001</td><td>10000</td></tr>
<tr><td>Sriram B</td><td>MCA 2009</td><td>10000</td></tr>
<tr><td>Kumar S</td><td>MCA 2009</td><td>10000</td></tr>
<tr><td>Anand Kumar Krishnamurthy</td><td>Chem 2008</td><td>9150</td></tr>
<tr><td>Goutam Rangaswamy</td><td>Chem 2010</td><td>9150</td></tr>
<tr><td>Vijayalakshmi Sethuraman</td><td>Chem 2011</td><td>9150</td></tr>
<tr><td>Hari Ganesh</td><td>2010</td><td>9150</td></tr>
<tr><td>Thanjiappan A</td><td>CHE 2012</td><td>8000</td></tr>
<tr><td>Geetha Devarajan</td><td>EEE 2003</td><td>6161</td></tr>
<tr><td>Krishna NG</td><td>Chem 2010</td><td>6100</td></tr>
<tr><td>Malikannan Sankarasubbu</td><td>IT 2004</td><td>6100</td></tr>
<tr><td>Aravind</td><td>CSE 2005</td><td>6100</td></tr>
<tr><td>Rajarajan Palanimurugan</td><td>2009</td><td>6100</td></tr>
<tr><td>Venkatesh AV</td><td>ECE 2007</td><td>6100</td></tr>
<tr><td>Nesamani P</td><td>IT 2008</td><td>6000</td></tr>
<tr><td>Padma Priya</td><td>IT</td><td>5000</td></tr>
<tr><td>Rajendran S</td><td>CSE 2005</td><td>5000</td></tr>
<tr><td>Ravi Shankar</td><td>MBA 2009</td><td>5000</td></tr>
<tr><td>Shankar D</td><td>MBA 2012</td><td>5000</td></tr>
<tr><td>Saravanan M</td><td>Chem 2012</td><td>5000</td></tr>
<tr><td>Karthik Murali</td><td>CSE 2004</td><td>5000</td></tr>
<tr><td>Priya Nair</td><td>BME 2011</td><td>5000</td></tr>
<tr><td>Sivapathi K</td><td>EEE 2012</td><td>5000</td></tr>
<tr><td>Bhuvaneshwaran S</td><td>EEE 2012</td><td>5000</td></tr>
<tr><td>Suresh V</td><td>ECE 2012</td><td>5000</td></tr>
<tr><td>Rajeev K</td><td>ECE 2012</td><td>5000</td></tr>
<tr><td>Santhiya S</td><td>CSE 2012</td><td>5000</td></tr>
<tr><td>Soumya B</td><td>ECE 2012</td><td>5000</td></tr>
<tr><td>Srivatsan</td><td>2001</td><td>5000</td></tr>
<tr><td>Ram Sasanka P</td><td>ECE 2010</td><td>4000</td></tr>
<tr><td>Murugesan MK</td><td>Chem 2010</td><td>4000</td></tr>
<tr><td>Priyadharshini</td><td>BME 2012</td><td>3500</td></tr>
<tr><td>Rajeshwari</td><td>CSE 2012</td><td>3500</td></tr>
<tr><td>Dushyanthi Vivekanandan</td><td>Chem 2011</td><td>3050</td></tr>
<tr><td>Shakthi Varman</td><td>Chem 2011</td><td>3050</td></tr>
<tr><td>Vaishnavi Srinivasan</td><td>Chem 2011</td><td>3050</td></tr>
<tr><td>Prabaharan B</td><td>MBA 2009</td><td>3000</td></tr>
<tr><td>Somasundaram</td><td>IT 2005</td><td>3000</td></tr>
<tr><td>Anand N</td><td>ECE 2006</td><td>3000</td></tr>
<tr><td>Senthil Kandasamy</td><td>MBA 2007</td><td>3000</td></tr>
<tr><td>Kruthiga</td><td>IT 2012</td><td>3000</td></tr>
<tr><td>Nehru Prakash</td><td>MCA 2009</td><td>3000</td></tr>
<tr><td>Shriram R G</td><td>MCA 2009</td><td>3000</td></tr>
<tr><td>Chenthil VM</td><td>Chem 2012</td><td>2000</td></tr>
<tr><td>Gayathri R</td><td>Chem 2009</td><td>2000</td></tr>
<tr><td>Lakshmi Nagarajan</td><td>Chem 2011</td><td>2000</td></tr>
<tr><td>Revathi Muthurakku</td><td>MCA 2009</td><td>2000</td></tr>
<tr><td>Thanasekar P </td><td>MCA 2009</td><td>2000</td></tr>
<tr><td>Palani Ramkumar </td><td>MCA 2009</td><td>2000</td></tr>
<tr><td>Sunil Subramanian</td><td>EEE 2006</td><td>1830</td></tr>
<tr><td>Arun Kumar Narasimhan</td><td>Chem 2009</td><td>1525</td></tr>
<tr><td>Ganesh</td><td>EEE 2003</td><td>1525</td></tr>
<tr><td>Lakshmi Janardhanan</td><td>Chem 2009</td><td>1500</td></tr>
<tr><td>Jensolin</td><td></td><td>1000</td></tr>
<tr><td>Ponni Priyadharshni</td><td>CSE 2011</td><td>1000</td></tr>
<tr><td>Anjana Parvathy S</td><td>CSE 2009</td><td>1000</td></tr>
<tr><td>Surendar Pandian</td><td>Chem 2009</td><td>1000</td></tr>
<tr><td>Vignesh R</td><td>Chem 2009</td><td>1000</td></tr>
<tr><td>Panneer Selvam</td><td>IT 2012</td><td>1000</td></tr>
<tr><td>Bhuvaneshwari</td><td>EEE 2012</td><td>1000</td></tr>
<tr><td>Dinesh Kumar </td><td>MCA 2009</td><td>1000</td></tr>
<tr><td>Karthika Pushpa</td><td>ECE 2013</td><td>500</td></tr>
<tr><td>Rohit P jain</td><td>ECE 2013</td><td>400</td></tr>
</table>
</div>
                <div class="tab-pane fade" id="profile">
                    <div style="margin: 5px;">Documentation for Receiving donations in SSN Trust Accounts</div>
                <div class="list-group">
  <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading">FOR INR FUNDS (Except NRE Accounts) </h4>
    <p class="list-group-item-text">
    <pre>
    1.Remitter can send INR contributions from any account (Except NRE Account), and the bank will accept the funds without any additional documentation from the Remitter or from         the Trust
    2.The remitter needs to provide only the following details<ul>
           <li>Bank Name : ICICI Bank Ltd
           Branch : Nungambakkam , Chennai 600034</li>
           <li>Address : 110, PRAKASH PRESIDIUM, UTHAMAR GANDHI SALAI, (NUNGAMBAKKAM HIGH ROAD), CHENNAI. 600034</li>
           <li>RTGS / NEFT Code : ICIC0000009</li>
           <li>Account Name : SSN Trust</li>
           <li>Account Number : 000901072623<li></ul>
    3.In order to channelize contribution, the remitter should give the following details on the comment field of Electronic Fund transfer: [Name]/[Degree]/[Branch]/[Year of Passing]
    4.After the transaction, the remitter should send a mail to alumniofficer@ssn.edu.in with Name of the remitter, Degree, Branch, Year of Passing, Amount transferred, Date of         transfer, Transaction Number along with the address to which the receipt is to be sent.
    </pre>
    </p>
  </a>
                    <a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading"> FOR INR Funds (From NRE Accounts)</h4>
    <p class="list-group-item-text">
    <pre>   1.The remitter can transfer INR funds from NRE Account. The remitter needs to provide only the following details : <ul>
           <li>Bank Name : ICICI Bank Ltd</li>
           <li>Branch : Nungambakkam , Chennai – 600034</li>
           <li>Address : 110, PRAKASH PRESIDIUM, UTHAMAR GANDHI SALAI, (NUNGAMBAKKAM HIGH ROAD), CHENNAI. 600034<li>
           <li>RTGS / NEFT Code : ICIC0000009</li>
           <li>Account Name : SSN Trust</li>
           <li>Account Number : 000901072623</li></ul>
    2.After the transaction is over the remitter should send a mail to the trust office at Trust.finance@ssn.edu.in with the following details (with a copy to Alumni Officer at         alumniofficer@ssn.edu.in ) 
           a. Name of the remitter 
           b. Remitter&lsquo;s Bank name 
           c. Amount & date of transfer 
           d. Branch and year of passing of the remitter 
           e. Address to which the receipt is to be sent 
           f. Scanned copy of the Passport of the remitter (first two pages and the last two pages) 
    3.After the money is transferred, the bank will communicate to the Trust (through E-Mail) the details of such funds received and kept on hold for want of Passport copy. 
    4.The mail will be sent to Trust.finance@ssn.edu.in.
    5.The Trust has to provide send the scanned copy of the remitter’s Passport within 3 working days of communication and only thereafter the funds will be released by the bank into the trust accounts.</pre>
    </p>
  </a>
                    <!---<a href="#" class="list-group-item ">
    <h4 class="list-group-item-heading">FOR Transfer of Foreign Funds </h4>
    <p class="list-group-item-text"><pre>Only funds in Foreign currencies can be remitted in to the below mentioned account number. 
    Details to be provided by the remitter to transfer the funds:     
	1.The remitter can transfer INR funds from NRE Account. The remitter needs to provide only the following details :<ul>
           <li>Bank Name : State bank of India </li>
           <li>Branch : NO.5 FIRST CROSS STREET , KASTURBA NAGAR, ADYAR, CHENNAI 600 020 </li>
           <li>Swift Code : SBININBB291 </li>
           <li>BSR Code : 01115 </li>
           <li>Account name : SSN Trust</li> 
           <li>Account number : 30128071688 </li></ul>
     No Other documentation will be required either from the Trust or the remitter for any foreign remittances received in the account. 
     After the transaction the remitter should send a mail to Trust.finance@ssn.edu.in and alumniofficer@ssn.edu.in with details of Remitter&lsquo;s name, Degree, Branch, 
     Year of Passing, Amount transferred, Date of transfer, Transaction Number and the address to which the receipt is to be sent. </pre></p>
  </a>--->
                    <b>Write Cheque or Demand Draft in favor of &ldquo;SSN Trust – ICICI Bank Account 000901072623&rdquo and send to the address: </b>
                    <pre>
  Administrative Officer, SSN Trust 
  211/95, V.M Street, 
  Mylapore, Chennai 600 004. 
  Phone: 91 44 2498 2656, 2498 6474 
  The alumni should send a mail to alumniofficer@ssn.edu.in with Name of the remitter, Degree, Branch, Year of Passing, Amount transferred, Date of transfer, Transaction   Number along with the address to which the receipt is to be sent.</pre>
</div>
                    
                </div>
               
              </div>
            </div>

</div>   </div><!--/span-->

        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class=" sidebar-nav">
            <div class="row">
      
       
        
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Scholarship fund Note </h3>
            </div>
            <div class="panel-body ">
                <?=$fundNote?>
              </div>
          </div>
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Benefited Student List </h3>
            </div>
            <div class="panel-body">
             <?=$studentlist?>
            </div>
          </div>
        
        
          <div class="panel panel-warning">
            <div class="panel-heading">
              <h3 class="panel-title">Testimonial from students</h3>
            </div>
            <div class="panel-body">
                <div class='bs-callout-warning'><?=$Testimonial?></div>
            
            </div>
          </div>
          
       
      </div>
          </div><!--/.well -->
        </div><!--/span-->
      </div><!--/row-->

      <!--hr-->

       <?php 
     @include ("./fragment/footer.php");
     ?>
    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/offcanvas.js"></script>
    <script src="./js/holder.js"></script>
  </body>
</html>

<?php
session_start();
require_once('connection.php');
$poid=$_SESSION['policeid'];
$query1= "SELECT `first_name` FROM police WHERE `policeid`='$poid'";
$result = $con->query($query1);
$first = $result->fetch_array()[0] ?? '';
$query2= "SELECT `last_name` FROM police WHERE `policeid`='$poid'";
$result2 = $con->query($query2);
$last = $result2->fetch_array()[0] ?? '';
$query22= "SELECT `mobile_no` FROM police WHERE `policeid`='$poid' ";
$result22 = $con->query($query22);
$mob = $result22->fetch_array()[0] ?? '';
if(!isset($_SESSION["policeid"])){
header("Location: PoliceLogin.php");
exit(); }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./welcome_police.css">
    <title>Welcome Police</title>

    <style> <?php include 'welcome_police.css' ?> </style>
</head>
<?php
if (isset($_GET['hand'])){
    $caseidd=mysqli_real_escape_string($con,$_GET['hand']);
    $vresult = mysqli_query($con,"SELECT `workingpolice` FROM userfir WHERE `caseid`='{$caseidd}'") or die("Query unsuccessful") ;
  if(mysqli_num_rows($vresult)> 1){
    echo "<div id='popup'>
    <h3> Already You are the Incharge of this Case.</h3><a href='welcome_police.php'>OK</a>
    </div>";
       }
  else{
    $work="Name: ".$first." ".$last." and Mobile Number: ".$mob;
    $vquery = mysqli_query($con,"UPDATE userfir SET `workingpolice`='$work' where caseid='$caseidd'");
    echo "<div id='popup'>
        <h3> Now You're the Incharge of this case.</h3><a href='welcome_police.php'>OK</a>
        </div>";
  
   }
  }

if (isset($_GET['caseid'])){
    $caseid=mysqli_real_escape_string($con,$_GET['caseid']);
    $uresult = mysqli_query($con,"SELECT `username` FROM userfir WHERE `caseid`='{$caseid}'") or die("Query unsuccessful") ;
	if(mysqli_num_rows($uresult)> 1){
        echo "<div id='popup'>
        <h3> Already Withdrawn! </h3><a href='welcome_police.php'>OK</a>
        </div>";}
else{
    $uquery = mysqli_query($con,"UPDATE userfir SET `confirmwithdraw`='yes' where caseid='$caseid'");
    echo "<div id='popup'>
        <h3> Fir Withdraw Successfully! </h3> <a href='welcome_police.php'>OK</a> 
        </div>";}

   }

   if (isset($_GET['caseidfed'])){
    $caseidfed=mysqli_real_escape_string($con,$_GET['caseidfed']);
    $fresult = mysqli_query($con,"SELECT `username` FROM userfir WHERE `caseid`='{$caseidfed}'") or die("Query unsuccessful") ;
	if(mysqli_num_rows($fresult)> 1){
        "<div id='popup'>
            <h3> You have Already Submitted the Feedback Report for this case!</h3><a href='welcome_police.php'>OK</a>
            </div>";
        
       }
else{
    ?>
    <form>
    <div class="box-div">
    <label for="victim-not">FeedBack Report:</label>
    <textarea name="feedback" class="txtara" rows="3" cols="30" placeholder="Enter FeedBack Report for Victim for this case"></textarea>
    </div>
    <div class="box-div btn-div">
     <button type="submit" name="submit" id="CaseSub">Submit the Feedback</button>
    </div>
    </form>
    <?php
    if($_POST['submit']){
        $fed=$_POST['feedback'];
        $fquery = mysqli_query($con,"INSERT INTO userfir('feedback') values('$fed') where caseid='$caseidfed'");
        "<div id='popup'>
        <h3> Thanks for giving you report on this case!</h3><a href='welcome_police.php'>OK</a>
        </div>";

    }
    

   }
}
?>

<body onload="table()">


    <section id="wlc_police">
        <div class="nav-wlc-police">
            <h2>Uttarakhand <br> Police Officer</h2>
            <nav>
            <ul id="wlc-police-links">
                    <li><a  onclick="complist()">Complaints</a></li>
                    <li><a onclick="HotspotArea()">Hotspot Areas</a></li>
                    <li><a onclick="AttendenceShow()">Attendance</a></li>
                    <li><i class="fa-solid fa-user"  onclick="signout()"></i></li>
                </ul>
            </nav>
            <div class="sign-out-box" id="sign-out-box">
                <ul id="profile-card">
                    <li> Officer Name: <?php echo $first." ".$last?></li>
                    <li> Police ID: <?php echo $_SESSION['policeid']?></li>
                    <li><button type="button"><a href="./sign_out.php">Sign Out</a></button></li>
   
                </ul>
            </div>
        </div>

        <div class="mid-section-police">
            <div class="button-table-complaints">
                <button type="button" id="compBtn" onclick="complist()">Click Here to see the Complaints</button>
                <div id="table"></div>
            </div>

            <div class="button-Hotspot-Areas">
                <button type="button" id="compBtn" onclick="HotspotArea()">Click Here to see the HotspotAreas</button>
                <div id="hotspot-list"></div>
            </div>

            <div class="button-Hotspot-Areas">
                <button type="button" id="compBtn" onclick="AttendanceShow()">Click Here to see Your Attendance</button>
                <div id="Attendence">
                  <div id="attend"></div>
                </div>
            </div>

            <div class="ApproveCaseWidthraw">
                <button type="button" id="compBtn" onclick="approve()">Click Here to See Case Widthraw Requests</button>
                <div id="policeofficers">
                    <div id="casewidthraw"></div>
                </div>
            </div>

        </div>
        <div class="last-section-footer">

        </div>
    </section>

    <script>
        var t = true;
        var ht = true;
        var wr = true;
        var so = true;
        var tr=true;
        table = () => {
            const res = new XMLHttpRequest();
            const htres = new XMLHttpRequest();
            const wreq = new XMLHttpRequest();
            const at = new XMLHttpRequest();
            res.onload = function () {
                document.getElementById("table").innerHTML = this.responseText;
            }
            htres.onload = function () {
                document.getElementById("hotspot-list").innerHTML = this.responseText;
            }
            wreq.onload = function () {
                document.getElementById("casewidthraw").innerHTML = this.responseText;
            }
            at.onload = function() {
                document.getElementById("attend").innerHTML = this.responseText;
            }
            res.open("GET", "complaint_list_police.php");
            htres.open("GET", "hotspotareas.php");
            wreq.open("GET", "casewidthraw.php");
            at.open("GET","attendence.php");
            res.send();
            htres.send();
            wreq.send();
            at.send();
        }

        setInterval(function () {
            table();
        }, 10000);

        complist = () => {
            if (t) {

                document.getElementById('table').style = "display:block";
                t = false;
            } else {
                document.getElementById('table').style = "display:none";
                t = true;
            }
        }

        HotspotArea = () => {
            if (wr) {

                document.getElementById('hotspot-list').style = "display:block";
                wr = false;
            } else {
                document.getElementById('hotspot-list').style = "display:none";
                wr = true;
            }
        }
  

        approve = () => {
            if (ht) {

                document.getElementById('policeofficers').style = "display:block";
                ht = false;
            } else {
                document.getElementById('policeofficers').style = "display:none";
                ht = true;
            }
        }
        AttendanceShow = () => {
            if (tr) {

                document.getElementById('Attendence').style = "display:block";
                tr = false;
            } else {
                document.getElementById('Attendence').style = "display:none";
                tr = true;
            }
        }

        signout = () => {
            if (so) {

                document.getElementById('sign-out-box').style = "display:block";
                so = false;
            } else {
                document.getElementById('sign-out-box').style = "display:none";
                so = true;
            }
        }

    </script>

</body>

</html>
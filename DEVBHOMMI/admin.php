<?php
session_start();
if(!isset($_SESSION["adminid"])){
header("Location: adminlogin.php");
exit(); }
?>
<!DOCTYPE html>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer"
    />
    <style> <?php echo include 'welcome_police.css' ?> </style>
    
    <title>Welcome Admin</title>
</head>
<?php
    require('connection.php');
    if (isset($_GET['id'])){
        $pid=mysqli_real_escape_string($con,$_GET['id']);
        $result = mysqli_query($con,"SELECT `policeid` FROM policeverify WHERE `policeid`='{$pid}'") or die("Query unsuccessful") ;
        if(mysqli_num_rows($result)> 1){
            echo "<div id='popup'>
            <h3> Already Verified! </h3><a href='admin.php'>OK</a>
            </div>";
        }
    else{
        $query2 = mysqli_query($con,"UPDATE policeverify SET `checkpolice`='yes' where policeid='$pid'");
        $query3 = mysqli_query($con,"UPDATE police SET `adminc`='yes' where policeid='$pid'");
        echo "<div id='popup'>
        <h3> Verified Successfully! </h3> <a href='admin.php'>OK</a> 
        </div>";}

    }
    if (isset($_GET['rid'])){
        $rid=mysqli_real_escape_string($con,$_GET['rid']);
        $rresult = mysqli_query($con,"SELECT `policeid` FROM policeverify WHERE `policeid`='{$rid}'") or die("Query unsuccessful") ;
        if(mysqli_num_rows($rresult)> 1){
            echo "<div class='heading'>S
            <h3 style=color:white; >ALREADY REJECTED,<a style=color:orange; href='admin.php'>Click For Another Verification</a></h3>
            <br> </div>";
           }
    else{
        $rquery2 = mysqli_query($con,"UPDATE policeverify SET `checkpolice`='no' where policeid='$rid'");
        $rquery3 = mysqli_query($con,"UPDATE police SET `adminc`='rejected' where policeid='$rid'");
        echo "<div id='popup'>
        <h3> Rejected Successfully! </h3> <a href='admin.php'>OK</a> 
        </div>";
    
       }
    }
?>

<body onload="table()">



    <section id="wlc_police">
        <div class="nav-wlc-police">
            <h2>Uttarakhand <br> Police Admin(Head)</h2>
            <nav>
                <ul id="wlc-police-links">
                    <li><a onclick="complist()">Complaints</a></li>
                    <li><a onclick="HotspotArea()">Hotspot Areas</a></li>
                    <li><a onclick="AprovePolice()">Working Officers</a></li>
                    <li><a onclick="PoliceShow()">Approve New Police</a></li>
                    <li><a onclick="attend()">Attendence</a></li>
                    <li><i class="fa-solid fa-user" onclick="signout()"></i></li>
                </ul>
            </nav>
            <div class="sign-out-box2" id="sign-out-box">
                <button type="button"><a href="./sign_out.php">Sign Out</a></button>
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
            <div class="ApproveCaseWidthraw">
                <button type="button" id="compBtn" onclick="AprovePolice()">Click Here to See Working Police Officers</button>
                <div id="validpoliceofficers">
                    <div id="aprovedpol"></div>
                </div>
            </div>


            <div class="ApproveCaseWidthraw">
                <button type="button" id="compBtn" onclick="PoliceShow()">Click Here to Approve New Register Police Officers Details</button>
                <div id="policeofficers">
                    <div id="casewidthraw"></div>
                </div>
            </div>
            <div class="ApproveCaseWidthraw">
                <button type="button" id="compBtn" onclick="attend()">Click Here Police Officers Attedence</button>
                <div id="attend">
                    <div id="Attendence"></div>
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
        var po=true;
        var tr=true;
        table = () => {
            const res = new XMLHttpRequest();
            const htres = new XMLHttpRequest();
            const wreq = new XMLHttpRequest();
            const pol = new XMLHttpRequest();
            const at = new XMLHttpRequest();
            res.onload = function() {
                document.getElementById("table").innerHTML = this.responseText;
            }
            htres.onload = function() {
                document.getElementById("hotspot-list").innerHTML = this.responseText;
            }
            wreq.onload = function() {
                document.getElementById("casewidthraw").innerHTML = this.responseText;
            }
            pol.onload = function() {
                document.getElementById("aprovedpol").innerHTML = this.responseText;
            }
            at.onload = function() {
                document.getElementById("Attendence").innerHTML = this.responseText;
            }
            
            res.open("GET", "complaint_list_admin.php");
            htres.open("GET", "hotspotareas.php");
            wreq.open("GET", "policeverify.php");
            pol.open("GET","approvedpolice.php");
            at.open("GET","admin_attendence.php");
            res.send();
            htres.send();
            wreq.send();
            pol.send();
            at.send();
        }

        setInterval(function() {
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


        PoliceShow = () => {
            if (ht) {

                document.getElementById('policeofficers').style = "display:block";
                ht = false;
            } else {
                document.getElementById('policeofficers').style = "display:none";
                ht = true;
            }
        }
        AprovePolice = () => {
            if (po) {

                document.getElementById('validpoliceofficers').style = "display:block";
                po= false;
            } else {
                document.getElementById('validpoliceofficers').style = "display:none";
                po = true;
            }
        }
        attend = () => {
            if (tr) {

                document.getElementById('attend').style = "display:block";
                tr = false;
            } else {
                document.getElementById('attend').style = "display:none";
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



</body>

</html>
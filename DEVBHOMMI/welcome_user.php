<?php
session_start();
$username = $_SESSION['user_name'];
if (!isset($_SESSION["user_name"])) {
    header("Location: UserLogin.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>

    <title>Welcome User</title>
    <link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">

    <style>
        <?php echo include 'welcome_user.css' ?>
    </style>

</head>

<body onload="table()">
    <?php

    require('connection.php');
    if (isset($_GET['caseidd'])){
        $caseidd=mysqli_real_escape_string($con,$_GET['caseidd']);
        $vresult = mysqli_query($con,"SELECT `username` FROM userfir WHERE `caseid`='{$caseidd}'") or die("Query unsuccessful") ;
        if(mysqli_num_rows($vresult)> 1){
            echo "<div id='popup'>
                <h3> Already Requested for Withdraw! </h3><a href='admin.php'>OK</a>
                </div>";
            
           }
    else{
        $vquery = mysqli_query($con,"UPDATE userfir SET `requestw`='yes' where caseid='$caseidd'");
        $vquery2 = mysqli_query($con,"UPDATE userfir SET `confirmwithdraw`='no' where caseid='$caseidd'");
        echo "<div id='popup'>
            <h3> Request Submitted Wait for Police Officer Approval! </h3> <a href='admin.php'>OK</a> 
            </div>";}
    
       }

    if (isset($_POST['submit'])) {
        $victimname = $_POST['victimname'];
        $vfathername = $_POST['vfathername'];
        $aadharno = $_POST['aadharno'];
        $victim = $_POST['victim'];
        $witness = $_POST['witness'];
        $crimeinfo = $_POST['crimeinfo'];
        $criminalinfo = $_POST['criminalinfo'];
        date_default_timezone_set('Asia/Kolkata');
        $my_date = date("Y-m-d H:i:s");
        $crimecity = filter_input(INPUT_POST, 'crimecity', FILTER_SANITIZE_STRING);
        $crimestation = filter_input(INPUT_POST, 'crimestation', FILTER_SANITIZE_STRING);
        $crimelocation = $_POST['crimelocation'];
        $incidentdate = date('Y-m-d', strtotime($_POST['incidentdate']));
        $incidentstart = $_POST['incidentstart'];
        $incidentend = $_POST['incidentend'];
        $suspectinfo = $_POST['suspectinfo'];
        $typeofcrime = filter_input(INPUT_POST, 'typeofcrime', FILTER_SANITIZE_STRING);
        if (strlen($aadharno) != 12) {
            echo "<div id='popup'>
    <h3> Aadhar Number must be 12digits </h3> <a href='welcome_user.php'> OK </a>
   </div>";
        } else {
            /*$query1= "SELECT `user_name` FROM regist WHERE `aadharno`='$aadharno'";
                    $result = $con->query($query1);
                    $username = $result->fetch_array()[0] ?? '';*/
            $path1 = "prooffir/";
            $path2 = "firsignature/";
            $temp1 = explode(".", $_FILES["file1"]["name"]);
            $temp2 = explode(".", $_FILES["file2"]["name"]);
            $filename1 = $username . '.' . end($temp1);
            $filename2 = $username . '.' . end($temp2);
            $path1 = $path1 . $filename1;
            $path2 = $path2 . $filename2;

            
if (move_uploaded_file($_FILES['file1']['tmp_name'], $path1)) {
    if (move_uploaded_file($_FILES['file2']['tmp_name'], $path2)) {
    
   $aResult = mysqli_query($con, "INSERT INTO userfir (`username`,`victimname`,`vfathername`,`victim`,`witness`,`crimeinfo`,`criminalinfo`,`crimelocation`,
   `crimestation`,`crimecity`,`incidentdate`,`incidentstart`,`incidentend`,`suspectinfo`,`typeofcrime`,`incidentproof`,`signature`,`casedt`,`workingpolice`,`confirmwithdraw`,`requestw`) values ('$username','$victimname','$vfathername','$victim','$witness','$crimeinfo','$criminalinfo','$crimelocation','$crimestation','$crimecity','$incidentdate','$incidentstart','$incidentend','$suspectinfo','$typeofcrime','$path1','$path2','$my_date','Not Assigned Any Police Officer','nope','no')");
    
  echo "<div id='popup'>
    <h3> Fir Registered Sucessfully! <br> Officers will get to you soon </h3> <a href='welcome_user.php'> OK </a>
   </div>";
    }
   } else {
    echo "<div id='popup'>
    <h3> Error while uploading file </h3> <a href='welcome_user.php'> OK </a>
   </div>";
}
    
    
        }
    }

    ?>



    <section id="complaint-section">


        <nav class="wlc-nav">
            <img src="./images/police-badge.png" alt="wlc-navbar-logo" class="logo-welcom">
            <div class="icon-buttons">
                <button type="button" id="navsignoutbtn" name="sign_out"><a href="./sign_out.php">Sign Out</a></button>
                <a href="#footer">Helpline Numbers</a>
                <img src="./images/user.png" alt="user-icon" class="logo-welcom">
            </div>

        </nav>


        <div class="midtext2">

            <button id="Complaint_form" onclick="display()"> Click here to fill the complaint </button>
            <form action="" method="post" name="user" enctype="multipart/form-data" id="cform">

                <div class="container-form-complaint">

                    <div class="box-div cformint">
                        <input id="victimname" type="text" name="victimname" placeholder="Your Full Name" value="" required>
                        <input id="v_fathername" type="text" name="vfathername" placeholder="Your Father Name" value="" required>
                    </div>

                    <div class="box-div">
                        <label for="victim-not">Are you a Victim?</label>
                        <div class="lable-box">
                            <label for="victim">Yes</label>
                            <input type="radio" name="victim" value="Yes">
                            <label for="victim">No</label>
                            <input type="radio" name="victim" value="No">
                        </div>
                    </div>

                    <div class="box-div">
                        <label for="victim-not">Are you a Witness?</label>
                        <div class="lable-box">
                            <label for="Witness-yes">Yes</label>
                            <input type="radio" name="witness" value="Yes">
                            <label for="Witness-no">No</label>
                            <input type="radio" name="witness" value="No">
                        </div>
                    </div>

                    <div class="box-div">
                        <label for="crimelocation" class="photoID">Enter Your Aadhar Number</label>
                        <input id="Crime-Cat" type="text" name="aadharno" value="" required>
                    </div>

                    <div class="box-div">
                        <label for="victim-not">In case if you have Criminals Information fill this field here</label>
                        <textarea name="criminalinfo" class="txtara" rows="3" cols="30" placeholder="Write here any Information Related to Criminal"></textarea>
                    </div>

                    <div class="box-div">
                        <label for="Type-selection"> Select the Crime Category </label>
                        <select name="typeofcrime" id="Crime-Cat">
                            <option>Crime Category Not Available Here</option>
                            <optgroup label="Drug Crimes">
                                <option>Drug Manufacture</option>
                                <option>Drug Transportation</option>
                                <option>A Drug Scam</option>
                                <option>Bad Drug Deal</option>
                                <option>Illegal use of Drugs</option>
                                <option>Any Other</option>
                            </optgroup>
                            <optgroup label="Street Crimes">
                                <option>Rape</option>
                                <option>Robbery</option>
                                <option>Assault</option>
                                <option>Burglary</option>
                                <option>Larceny</option>
                                <option>Accident</option>
                                <option>Any Other</option>
                            </optgroup>
                            <optgroup label="Organized Crimes">

                                <option>Organized gang criminality</option>
                                <option>Racketeering</option>
                                <option>Syndicate Crime</option>
                                <option>Smuggling</option>
                                <option>Any Other</option>
                            </optgroup>

                            <optgroup label="Online Crimes">
                                <option>Cyber Attack</option>
                                <option>Online Fraud</option>
                                <option>Stealing Data</option>
                                <option>Illegal Gambling</option>
                                <option>Sell Of Illegal Items Online</option>
                                <option>Copyright Infringement</option>
                                <option>Any Other</option>
                            </optgroup>
                        </select>

                    </div>

                    <div class="box-div">
					<label for="policestationcity">Select District</label>
					<select name="crimecity" id="police_city" onchange="change_select(this)">
                    <option value="">select your District</option>
						<option value="Almora">Almora</option>
						<option value="Bageshwar">Bageshwar</option>
						<option value="Chamoli">Chamoli</option>
						<option value="Champawat">Champawat</option>
						<option value="Dehradun">Dehradun</option>
						<option value="Haridwar">Haridwar</option>
						<option value="Nainital">Nainital</option>
						<option value="Pauri Garhwal">Pauri Garhwal</option>
						<option value="Pithoragarh">Pithoragarh</option>
						<option value="Rudraprayag">Rudraprayag</option>
						<option value="Tehri Garhwal">Tehri Garhwal</option>
						<option value="Udham Singh Nagar">Udham Singh Nagar</option>
						<option value="Uttarkashi">Uttarkashi</option>
					</select>
				</div>

                    <div class="box-div">
                        <label for="Police Office" class="photoID">Select Your Near by Police Station</label>
                        <select name="crimestation" id="country">
                            <option>Select Police Station</option>
                        </select>
                    </div>

                    <div class="box-div">
                        <label for="crimelocation"> Exact Crime Location</label>
                        <input id="Crime-Cat" type="text" name="crimelocation" value="" required>
                    </div>


                    <div class="box-div">
                        <textarea class="txtara" name="suspectinfo" rows="3" cols="38" placeholder="Write Details About the suspect"></textarea>
                        <textarea class="txtara" name="crimeinfo" rows="3" cols="38" placeholder="Write about the incident in brief"></textarea>
                    </div>

                    <div class="box-div">
                        <label for="incidentdate" class="photoID"> Incident/Crime Date </label>
                        <input id="incidentdate" type="date" name="incidentdate" value="" required>
                    </div>

                    <div class="box-div">
                        <label for="incidenttime" class="photoID">Incident/Crime Start and End Time </label><br>
                        <input id="incidentstart" type="time" name="incidentstart" placeholder="Enter Incident Start Time" value="" required>
                        <input id="incidentend" type="time" name="incidentend" placeholder="Enter Incident End Time" value="" required>
                    </div>

                    <div class="box-div filediv">
                        <label for="incidentproof" class="photoID">Incident/Crime Proof</label>
                        <input id="incident" type="file" name="file1" accept=".pdf">
                    </div>

                    <div class="box-div filediv">
                        <label for="authenticate" class="photoID"> Share Your Orignal Signature </label>
                        <input id="signature" type="file" name="file2" accept=".pdf">
                    </div>

                    <div class="box-div btn-div">
                        <button type="submit" name="submit" id="CaseSub">Submit Your Complaint</button>
                    </div>
                </div>
            </form>
            <button type="button" id="Complaint_form" onclick="complist()">Click Here to see Your Complaints</button>
            <div id="table"></div>
        </div>

        </div>
        </div>



        <footer id="footer">
            <div class="cformfoot">
                <p>Uttarakhand Police HelpLine Numbers</p>
                <ul class="list-number">
                    <li>Cyber Helpline:1930</li>
                    <li>Information Regarding Drugs: 9412029536 0135-2656202</li>
                    <li>Women's Related Complaint: 9411112780</li>
                    <li>Police Control Room/ Emergency Number: 112</li>
                </ul>
            </div>
        </footer>

    </section>






    <script>
        var val = true;
        display = () => {

            if (val) {
                document.getElementById('cform').style = "display:block";
                document.getElementById('Complaint_form').style = "background-color: var(--crimsom)";
                val = false;
            } else {
                document.getElementById('cform').style = "display:none";
                document.getElementById('Complaint_form').style = "background-color: var(--darkblue)";
                val = true;
            }
        }
       

        var t = true;
        table = () => {
            const res = new XMLHttpRequest();
            res.onload = function() {
                document.getElementById("table").innerHTML = this.responseText;
            }
            res.open("GET", "user_complaint_list.php");
            res.send();

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
    </script>
    <script>
		change_select = (ele) => {

			var value_sel = ele.value;
			var thana = document.getElementById('country');

			thana.innerHTML = "";
			if (value_sel == "Almora") 
			{
				var object = ['PS Someshwar|PS Someshwar', 'PS Kotwali Almora|PS Kotwali Almora', 'PS Bhatroujkhan|PS Bhatroujkhan', 'PS Dwarahat|PS Dwarahat', 'PS Ranikhet|PS Ranikhet', 'PS Lamgara|PS Lamgara', 'PS Salt|PS Salt', 'PS ChaukhutiaPS Chaukhutia|PS ChaukhutiaPS Chaukhutia', 'PS Daniya|PS Daniya', 'Women Police Station Almora|Women Police Station Almora'];

			} else if (value_sel == "Bageshwar") 
			{
				var object = ['PS Kotwali Bageshwar|PS Kotwali Bageshwar', 'PS Baijnath|PS Baijnath', 'PS Jhiroli|PS Jhiroli', 'PS Kapkot|PS Kapkot', 'PS Kausani|PS Kausani', 'PS Kanda|PS Kanda'];

			} else if (value_sel == "Chamoli") 
			{
				var object = ['Virtual Police Station|Virtual Police Station', 'PS Gopeshwar|PS Gopeshwar', 'PS Chamoli|PS Chamoli', 'PS Joshimath|PS Joshimath', 'PS Karnprayag|PS Karnprayag', 'PS Tharali|PS Tharali', 'PS Pokhari|PS Pokhari', 'PS Gairsen|PS Gairsen', 'PS Govindghat|PS Govindghat', 'PS Badrinath|PS Badrinath'];

			} else if (value_sel == "Champawat") 
			{
				var object = ['PS Banbasa|PS Banbasa', 'PS Tanakpur|PS Tanakpur', 'PS Champawat|PS Champawat', 'PS Tamli|PS Tamli', 'PS Pancheshwar|PS Pancheshwar', 'PS Lohaghat|PS Lohaghat', 'PS Reethasahib|PS Reethasahib', 'PS Pati|PS Pati'];

			} else if (value_sel == "Dehradun") {

				var object = ['PS Kotwali Nagar|PS Kotwali Nagar', 'PS Dalanwala|PS Dalanwala', 'PS Rishikesh|PS Rishikesh', 'PS Mussoorie|PS Mussoorie', 'PS Vikas Nagar|PS Vikas Nagar', 'PS Doiwala|PS Doiwala', 'PS Patelnagar|PS Patelnagar', 'PS Cantt|PS Cantt','PS Basant Vihar|PS Basant Vihar','PS Nehru Colony|PS Nehru Colony','PS Rajpur|PS Rajpur','PS Raiwala|PS Raiwala','PS Clement Town|PS Clement Town','PS Sahaspur|PS Sahaspur','PS Raipur|PS Raipur','PS Chakrata|PS Chakrata','PS Kalsi|PS Kalsi','PS GRP|PS GRP','PS Ranipokhari|PS Ranipokhari','PS Prem Nagar|PS Prem Nagar','PS Tuini|PS Tuini','PS Selakui|PS Selakui','Cyber Crime Police Station|Cyber Crime Police Station'];

			} else if (value_sel == "Haridwar") {

				var object = ['PS Kotwali Nagar|PS Kotwali Nagar','PS Jwalapur|PS Jwalapur','PS Kankhal|PS Kankhal','PS Ranipur|PS Ranipur','PS Roorkee|PS Roorkee','PS Gangnahar|PS Gangnahar','PS Bhagwanpur|PS Bhagwanpur','PS Mangalore|PS Mangalore','PS Jhabrera|PS Jhabrera','PS Lakshar|PS Lakshar','PS Pathri|PS Pathri','PS Shyampur|PS Shyampur','PS Khanpur|PS Khanpur','PS Bahadarabad|PS Bahadarabad','PS Buggawala|PS Buggawala','PS Sidkul|PS Sidkul','PS Kaliyar Sharif|PS Kaliyar Sharif'];

			} else if (value_sel == "Nainital") {

				var object = ['PS Mallital|PS Mallital','PS Tallital|PS Tallital','PS Bhawali|PS Bhawali','PS Bheemtal|PS Bheemtal','PS Mukteshwar|PS Mukteshwar','PS Kaladhungi|PS Kaladhungi','PS Ramnagar|PS Ramnagar','PS Lalkuan|PS Lalkuan','PS Haldwani|PS Haldwani','PS Chorglia|PS Chorglia','PS Kathgodam|PS Kathgodam','PS Betalghat|PS Betalghat','PS Mukhani|PS Mukhani','PS Banabhulpura|PS Banabhulpura'];

			} else if (value_sel == "Pauri Garhwal") {

				var object = ['PS Pauri|PS Pauri','PS Srinagar|PS Srinagar','PS Devprayag|PS Devprayag','PS Laxmanjhula|PS Laxmanjhula','PS Satpuli|PS Satpuli','PS lansdowne|PS lansdowne','PS Kotdwar|PS Kotdwar','PS Kalagarh|PS Kalagarh','PS Dhumakot|PS Dhumakot','PS Rikhanikhal|PS Rikhanikhal','PS Thalisain|PS Thalisain','PS Paithani|PS Paithani','Women Police Station Srinagar|Women Police Station Srinagar'];

			} else if (value_sel == "Pithoragarh") {

				var object = ['PS Kotwali Pithoragarh|PS Kotwali Pithoragarh','PS Gangolihat','PSbai|PS Gangolihat','PS Bairinag|PS Bairinag','PS Jhulaghat|PS Jhulaghat','PS Thal|PS Thal','PS Kanalichina|PS Kanalichina','PS Didihat|PS Didihat','PS Askot|PS Askot','PS Munsiyari|PS Munsiyari','PS Jauljeevi|PS Jauljeevi','PS Baluwakot|PS Baluwakot','PS Dharchula|PS Dharchula','PS Pangla|PS Pangla','PS Nachni|PS Nachni','PS Gunji|PS Gunji','PS Jajradewal|PS Jajradewal','PS Pangla|PS Pangla'];

			} else if (value_sel == "Rudraprayag") {

				var object = ['PS Rudraprayag|PS Rudraprayag','PS Ukhimath|PS Ukhimath','PS Augustmuni|PS Augustmuni','PS Guptkashi|PS Guptkashi','PS Sonprayag|PS Sonprayag'];

			} else if (value_sel == "Tehri Garhwal") {

				var object = ['PS New Tehri|PS New Tehri','PS Kirtinagar|PS Kirtinagar','PS Devprayag|PS Devprayag','PS Chamba|PS Chamba','PS Narendranagar|PS Narendranagar','PS Munikireti|PS Munikireti','PS Ghansali|PS Ghansali','PS Kampty|PS Kampty','PS Hindolakhal|PS Hindolakhal','PS Lambgaon|PS Lambgaon','PS Thatuir|PS Thatuir'];

			} else if (value_sel == "Udham Singh Nagar") {

				var object = ['PS Jaspur|PS Jaspur','PS kunda|PS kunda','PS Kashipur|PS Kashipur','PS ITI|PS ITI','PS Bazpur|PS Bazpur','PS Kelakhera|PS Kelakhera','PS Gadarpur|PS Gadarpur','PS Dineshpur|PS Dineshpur','PS Pantnagar|PS Pantnagar','PS Rudrapur|PS Rudrapur','PS Transit Camp|PS Transit Camp','PS Pulbhatta|PS Pulbhatta','PS Kicha|PS Kicha','PS Sitarganj|PS Sitarganj','PS Nanakmatta|PS Nanakmatta','PS Khatima|PS Khatima','PS Jhankaiyan|PS Jhankaiyan','Cyber Police Station|Cyber Police Station'];

			} else if(value_sel == "Uttarkashi"){

				var object = ['PS Kotwali|PS Kotwali','PS Maneri|PS Maneri','PS Dharashu|PS Dharashu','PS Barkot|PS Barkot','PS Purola|PS Purola','PS Mori|PS Mori','PS Harshil|PS Harshil'];

			}else{
                var object = ['none|Select Police Station'];
            }

			for(var obj in object){
				var pair = object[obj].split('|');
				var newoption = document.createElement('option');
				newoption.value = pair[0];
				newoption.innerHTML = pair[1];
			    thana.options.add(newoption);		
			}
		}
	</script>

</body>

</html>
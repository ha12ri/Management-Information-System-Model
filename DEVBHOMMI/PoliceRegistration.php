<?php

require_once('connection.php');


if (isset($_POST['sign_up'])) {
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$user_name = $_POST['user_name'];
	$email = $_POST['email'];
	$police_city = filter_input(INPUT_POST, 'police_city', FILTER_SANITIZE_STRING);
	$policeid = $_POST['policeid'];
	$pass = $_POST['pass'];
	$office = filter_input(INPUT_POST, 'office', FILTER_SANITIZE_STRING);
	$c_pass = $_POST['c_pass'];
	$mobile_no = $_POST['mobile_no'];
	$joiningdate = date('Y-m-d', strtotime($_POST['joiningdate']));
	$check_email = mysqli_query($con, "SELECT email FROM police where email = '$email' ");
	$sql = "SELECT policeid FROM police WHERE policeid='{$policeid}'";
	$check_user = mysqli_query($con, "SELECT user_name FROM police where user_name= '$user_name' ");
	$result = mysqli_query($con, $sql) or die("Query unsuccessful");
	if (mysqli_num_rows($check_email) > 0) {
		echo ('Email Already exists');
	} elseif (mysqli_num_rows($check_user) > 0) {
		echo ('Username Already exists');
	} elseif (mysqli_num_rows($result) > 0) {
		echo " Police ID is already exist";
	} elseif (strlen($user_name) < 2 && strlen($user_name) > 15) {
		echo "Enter Character between 3 To 15 .";
	} elseif (strlen($pass) <= 6 && strlen($pass) >= 20) {
	} elseif (strlen($pass) <= 6 && strlen($pass) >= 20) {
	} elseif ($pass != $c_pass) {
		echo "<script>alert('Password Does Not Same')</script>";
	} else {
		$path = "idpolice/";
		$temp = explode(".", $_FILES["file"]["name"]);
		$filename = $policeid . '.' . end($temp);
		$path = $path . $filename;
		if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
			$pResult = mysqli_query($con, "INSERT INTO police (`first_name`,`last_name`,`user_name`,`email`,`policeid`,`pass`,`mobile_no`,`joiningdate`,`office`,`police_city`,`document`,`adminc`) values ('$first_name','$last_name','$user_name','$email','$policeid','$pass','$mobile_no','$joiningdate','$office','$police_city','$path','no')");
			$aquery = mysqli_query($con, "INSERT INTO policeverify (`policeid`,`checkpolice`) values('$policeid','notconfirmed')");
			echo "<script>alert('successfully Register Please Wait for Comfirmation From Head of Police Department');</script>";
			header("location:PoliceLogin.php");
		}
	}
}
?>

<html>

<head>
	<style>
		<?php echo include 'PoliceRegistration.css' ?>
	</style>
	<title>Police Registration Page</title>
	<link rel="icon" type="image/x-icon" href="./images/mis-logo-png-transparent.png">
</head>

<body>

	<section id="hero">
		<form action="" method="post" name="user" enctype="multipart/form-data">
			<h1 class="heading">SIGN UP FOR POLICE OFFICER'S</h1>
			<div class="container">

				<div class="box-div">
					<input id="first_name" type="text" name="first_name" placeholder="First Name" value="" required>
					<input id="last_name" type="text" name="last_name" placeholder="Last Name" value="" required>
				</div>

				<div class="box-div">
					<input id="email" type="text" name="email" placeholder="Email ID" value="" required>
					<input id="User_Name" type="text" name="user_name" placeholder="Enter Your User Name" required>
				</div>

				<div class="box-div">
					<input id="pass" type="password" name="pass" placeholder="Enter Password" maxlength="16" required>
					<input id="c_pass" type="password" name="c_pass" placeholder="Enter Confirm Password" maxlength="16" required>
				</div>

				<div class="box-div">
					<input id="PoliceId" type="number" name="policeid" placeholder="Enter Police ID Number" maxlength="12" size="12" value="" required>
					<input id="mobile" type="number" name="mobile_no" placeholder="Mobile No." value="" required>
				</div>
				<div class="box-div">
					<label for="policestationcity">Select the police Station District</label>
					<select name="police_city" id="police_city" onchange="change_select(this)">
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
					<label for="Police Office" class="photoID">Select Your Police Station</label>
					<select id="country" name="office">
						<option>Select Police Station</option>
					</select>
				</div>
				<div class="box-div">
					<label for="joingingdate" class="photoID">Your Joining Date</label>
					<input id="joiningdate" type="date" name="joiningdate" value="" required>
				</div>

				<div class="box-div">
					<label for="PoliceIdPhoto" class="photoID">Submit an Pdf of your Police ID card</label>
					<input id="Profilephoto" type="file" name="file" accept=".pdf" required>

				</div>

				<div class="box-div">
					<input id="submit" type="submit" name="sign_up" value="SIGN UP">
				</div>
				<p class="RegiUser">Already Have an Account <a href='./PoliceLogin.php' target="_blank">LOGIN</a></p>

			</div>
		</form>
	</section>
	
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
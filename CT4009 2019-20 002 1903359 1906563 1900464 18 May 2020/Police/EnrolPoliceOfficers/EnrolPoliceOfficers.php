<?php
$page_title = "Enrol Police Officers";
require('../../globalFiles/policeLoginHeader.php');
?>

<form id="formUserReg" action="EnrolPoliceOfficersDAO.php" method="POST">
	<div class="margin">
		<fieldset id="enrolment">
			<legend>Enrol new Police</legend>
			<input id="firstName" class="form-control" name="firstName" type="text" placeholder="Enter your First Name" required="Required">
			<br>
			<input id="secondName" class="form-control" name="secondName" type="text" placeholder="Enter Last Name" required="Required">
			<br>
			<input id="policeRank" class="form-control" name="policeRank" type="text" placeholder="Enter Police Rank" required="Required">
			<br>
			<input id="policeNumber" class="form-control" name="policeNumber" type="text" placeholder="Create Police Number" required="Required">
			<br>
			<input id="createPassword" class="form-control" name="createPassword" type="password" placeholder="Create a password" required="Required">
			<br>
			<input type="password" class="form-control" name="ConPassword" id="ConPassword" placeholder="Confirm password" required="Required">
			<br>
			<input id="btnUserform" class="btn btn-primary" type="Submit" onclick="return Confirm()">
			<!-- <input style="text-align: center;" class="btn btn-outline-secondary" type="button" onclick="location.href='../PoliceLogin/PoliceLogin.php'; "value="Back to Police" /> -->
			<a class="btn btn-outline-secondary" href="../PoliceLogin/PoliceLogin.php">Back to Police</a>
		</fieldset>
	</div>
</form>
<script type="text/javascript">
	function Confirm() {
		var pass = document.getElementById("password").value;
		var ConPass = document.getElementById("ConPassword").value;
		if (pass != ConPass) { // if the password are not the same on entry
			alert("Sorry, the passwords do not match"); // alert the user it does not match
			return false;
		}
		return true;
	}

	<?php
	require('../../globalFiles/footer.php');
	?>
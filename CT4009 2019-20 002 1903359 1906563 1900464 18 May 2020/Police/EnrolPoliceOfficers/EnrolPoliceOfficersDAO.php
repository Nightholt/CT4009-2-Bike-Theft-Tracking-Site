<?php
		include "../../globalFiles/config.php"; // include the database configuration file
		//gets the id from the html form
		$firstname=$_POST['firstName']; 
		$lastname=$_POST['secondName'];
		$policeRank=$_POST['policeRank'];
		$policeNumber = $_POST['policeNumber'];
		$createPassword=$_POST['createPassword'];
		$passwordLength = strlen($createPassword); // variable for checking password length
		$createPassword = password_hash( $createPassword , PASSWORD_BCRYPT ); // hashes the users inputted password 
		//$createPassword = sha1(mysqli_real_escape_string($connection, trim($_POST['password'])));


		$query1 = "SELECT * FROM police_login WHERE policeNumber='".$policeNumber."'"; // query that will take the users email and matches it up with the existing database

		$result1 = mysqli_query($connection, $query1); // uses the connection to database with the query 

		if (mysqli_num_rows($result1)>=1) { // checks if there are wows in database
			//alert to say email is already in database then it cant be used 
            echo "<script language='javascript'>";
            echo 'alert("Number Taken");';
            echo 'window.location.replace("EnrolPoliceOfficers.php");';
			echo "</script>";
		}
		elseif ($passwordLength < 6 ){ // if the inputted length is less than 6
			//Says password entered is not strong
            echo "<script language='javascript'>";
            echo 'alert("Password not strong enough");';
            echo 'window.location.replace("EnrolPoliceOfficers.php");';
			echo "</script>";			
		}
	
		else { // if all data is okay
			$sql = "INSERT INTO `police_login`".
			"values".
			"('$firstname', '$lastname', '$policeRank', '$policeNumber', '$createPassword')"; // insert all form data into the table in the database
		
		if(mysqli_query($connection, $sql)) {
		header("Location: https://s1903359-ct4009.uogs.co.uk/Police/EnrolPoliceOfficers/EnrolPoliceOfficers.php"); // once all correct go to the login page
		} else {
			echo mysqli_error($connection); // says if there is a connection error
			return;
		}
		mysqli_close($connection);		}


		//header("Location: https://s1903359-ct4009.uogs.co.uk/Public/Login/Login.html"); 
  
		exit; 

?>
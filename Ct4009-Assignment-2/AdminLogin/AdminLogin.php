<?php
$page_title = "Admin Login"; // name of the current page 
require('../../globalFiles/policeLoginHeader.php'); // link to the php header 
?>

<!--Form login for the username and passwrod to the registration of the police registration-->
<form name="login" action="AdminLoginDAO.php" method="POST">
    <div class="margin">
        <fieldset>
            <legend>Admin Login</legend><!--legend that acts as a title of the login-->

            Enter your number:<br>
            <input type="text" class="form-control" name="AdminNumber" id="AdminNumber"> <!--field for the admin number-->
            <br /><br>

            Enter your password:<br>
            <input type="password" class="form-control" name="AdminPass" id="AdminPass"><!--field for the admin password-->
            <br />
            <input type="submit" class="btn btn-primary" value="Login"></button><!--once the button is pressed it will use the javascript function -->

            <a class="btn btn-outline-secondary" href="../PoliceLogin/PoliceLogin.php">Back To Police Login</a>
        </fieldset>
    </div>
</form>




<?php
require('../../globalFiles/footer.php'); // referecne to the header in the gobal folder
?>
<?php
$page_title = "Admin Login";
require('../../globalFiles/policeLoginHeader.php');
?>

<!--Form login for the username and passwrod to the rest of the control panel-->
<form name="login">
    <div class="margin">
        <fieldset>
            <legend>Admin Login</legend>

            Enter your username:<br>
            <input type="text" class="form-control" name="username">
            <br /><br>

            Enter your password:<br>
            <input type="password" class="form-control" name="Adminpassword">
            <br /><br />
            <input type="button" class="btn btn-primary" value="Login" onClick="pasuser(this.form)"></button>

            <a class="btn btn-outline-secondary" href="../PoliceLogin/PoliceLogin.php">Back To Police Login</a>
        </fieldset>
    </div>
</form>



<script language="javascript">
    function pasuser(form) {
        if (form.username.value == "Yeet") {
            if (form.Adminpassword.value == "Welcome") {
                location = "./EnrolPoliceOfficers/EnrolPoliceOfficers.php"
            } else {
                alert("Invalid Password")
            }
        } else {
            alert("Invalid UserID")
        }
    }
</script>

<?php
require('../../globalFiles/footer.php');
?>
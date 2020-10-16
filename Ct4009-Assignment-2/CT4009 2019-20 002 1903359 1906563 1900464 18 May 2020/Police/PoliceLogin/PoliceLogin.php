<?php
$page_title = "Police Login";
require('../../globalFiles/policeLoginHeader.php');
?>

<!--Form login for the username and passwrod to the rest of the control panel-->
<form name="login" action="PoliceLoginDAO.php" method="POST">
  <div class="margin">
    <fieldset>
      <legend>Login</legend>
      <?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
      ?>
        You are already logged in<br /><br />
        <a class="btn btn-outline-secondary" href="../../globalFiles/Logout.php">Logout</a>
        <a class="btn btn-dark" href="..\PoliceHome\PoliceHome.php">Back</a>

      <?php } else { ?>
        Enter your Police Number:<br>
        <input type="text" class="form-control" name="policeNumber" placeholder="Police Number">
        </br>
        <br>

        Enter Password:<br>
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        </br>
        <br>

        <input type="submit" class="btn btn-primary" value="Login" onclick="return Confirm()" />

        <a class="btn btn-outline-secondary" href="../AdminLogin/AdminLogin.php">Enrol Police</a>
      <?php } ?>
    </fieldset>
  </div>
</form>

<?php
require('../../globalFiles/footer.php');
?>
<?php
  //page title
  $page_title = "Stolen List";
  //get header for page
  require('../../globalFiles/policeHeader.php');
?>

<style>
  .form-control {
    width: 310px;
  }

  .flex {
    display: flex;
    flex-direction: row;
  }
</style>
<?php if (isset($_SESSION['firstName']) && !empty($_SESSION['firstName'])) {
  //check if user logged in
?>

<h3>What time frame would you like to view the stolen bikes in </h3><hr/>
<form id="formViewStolen" action="ViewStolenListDAO.php" method="POST">
  <!--Displays a calendar for the police to pick a week from-->
  <form id="formWeek">
    Enter a week:
    <div class="flex">
      <!--stores it as a week with the name stolenWeek-->
      <input type="week" id = "thisWeek" class="form-control" name="stolenWeek" required>
      <!--creates and names a submit button for the week function-->
      <input type="submit" class="btn btn-primary" name="submitWeek" >
    </div>
  </form>
</form>
<br><br>
<form id="formViewStolen" action="ViewStolenListDAO.php" method="POST">
  <!--Displays a calendar for the police to choose a month from-->
  <form id="formMonth">
    Enter a month:
    <div class="flex">
      <!--Stores the choice as a month with the name stolenMonth-->
      <input type="month" id ="thisMonth" class="form-control" name="stolenMonth" required>
        <!--This will set the max month to be the current one-->
        <script>
          //sets the variable today as a date
          var today = new Date();
          //gets todays month
          var month = today.getMonth() + 1; //Need to add 1 because Januaury is one
          //gets todays year
          var year = today.getFullYear();
          if (month < 10) {
          //if the month is 1->9 adds a 0 so that it is 01 instead of 1
          month = '0' + month
          }
          //puts all the parts of the date together so that it forms a date
          thismon = year + '-' +month;
          //sets this date as teh max value that the user can enter
          document.getElementById("thisMonth").max = thismon;
        </script>
      <!--Creates a submit button for the month function-->
      <input type="submit" class="btn btn-primary" name="submitMonth">
    </div>
  </form>
</form>
<br><br>
<form id="formViewStolen" action="ViewStolenListDAO.php" method="POST">
  <!--Displays a box for the police to choose a year from-->
  <form id="formYear">
    Enter a year:
    <div class="flex">
      <!--Stores the choice as a month with the name stolenYear-->
      <input type="number" id = "thisYear" class="form-control" name="stolenYear" placeholder="YYYY" min="2019" max="2100" required>
      <!--This will set the max month to be the current one-->
      <script>
          //sets the variable today as a date
          var today = new Date();
          //gets todays year
          var year = today.getFullYear();
          //sets this date as teh max value that the user can enter
          document.getElementById("thisYear").max = year;
        </script>
      <!--Creates a submit button for the month function-->
      <input type="submit" class="btn btn-primary" name="submitYear">
    </div>
  </form>
</form>

<?php } else { ?>
  <!-- won't display form if user not logged in -->
  <div id="notLoggedIn">
    <h3>Please Log in to access this</h3>
    <hr />
    <a class="btn btn-primary" href="../PoliceLogin/PoliceLogin.php" role="button">Login as Police</a>
  </div>

<?php }
//footer for page
require('../../globalFiles/footer.php');
?>
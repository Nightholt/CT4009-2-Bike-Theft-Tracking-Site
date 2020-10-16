//gets the value for the bike id and stores it in a variable
var bikeID = $('#bikeID').val();
//passes this variable to StolenEcommerceDAO.php and calls that page
window.location.href = "StolenEcommerceDAO.php?w1=" + bikeID;
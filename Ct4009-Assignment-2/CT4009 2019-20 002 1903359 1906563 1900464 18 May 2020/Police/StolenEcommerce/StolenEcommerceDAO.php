<?php
  //sets the title of page
  $page_title = "Stolen Ecommerce";
  //calls the css for the page
  require('../../globalFiles/policeHeader.php');
  error_reporting(E_ALL);  // Turn on all errors, warnings, and notices for easier debugging

  //if there is a value store in w1 then:
  if (isset($_GET["w1"])) {
    //This gets all the values from previous pages and stores it in variables to be put into the table
    $details = $_GET["w1"];
      //splits up the data by the '-', got from the previous page into an array called columns
    $columns = explode('-', $details);
    //into the bike id
    $id = $columns[0];
    //and bike brand
    $brand = $columns[1];
    //and bike model
    $model = $columns[2];
    //set the word bike
    $word = "bike";
    //get all the data from the table where the bike id is then: 
    $sql = "SELECT * FROM tbl_bikes WHERE bikeID = '" . $id . "'";
    $answer = mysqli_query($connection, $sql);
    //while there is a result from the query then:
    while ($row = mysqli_fetch_array($answer)) {
      //set the data from the colum wSize to be the variable $wheels
      $wheels = $row['wSize'];
    }
    //concatenate the searchTerm so that it is "bike brand model wheelsize" "
    $searchTerm = $word . ' ' . $brand . ' ' . $model . ' ' . $wheels. '" ';
  }

  // API request variables
  $endpoint = 'https://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
  //set the query to be the searchTerm
  $query = $searchTerm;
  // Create a PHP array of the item filters you want to use in your request
  $filterarray =
    array(
      array(
        'name' => 'MaxPrice',
        'value' => '1000',
        'paramName' => 'Currency',
        'paramValue' => 'GBP'),
      array(
        'name' => 'FreeShippingOnly',
        'value' => 'false',
        'paramName' => '',
        'paramValue' => ''),
      array(
        'name' => 'ListingType',
        'value' => array('AuctionWithBIN','FixedPrice','StoreInventory'),
        'paramName' => '',
        'paramValue' => ''),
      array(
        'name' => 'LocatedIn',
        'value' => 'GB',
        'paramName' => '',
        'paramValue' => ''),
    );

  // Generates an XML snippet from the array of item filters
  function buildXMLFilter ($filterarray) {
    global $xmlfilter;
    // Iterate through each filter in the array
    foreach ($filterarray as $itemfilter) {
      $xmlfilter .= "<itemFilter>\n";
      // Iterate through each key in the filter
      foreach($itemfilter as $key => $value) {
        if(is_array($value)) {
          // If value is an array, iterate through each array value
          foreach($value as $arrayval) {
            $xmlfilter .= " <$key>$arrayval</$key>\n";
          } 
        }else {
          if($value != "") {
            $xmlfilter .= " <$key>$value</$key>\n";
          }
        } 
      }
      $xmlfilter .= "</itemFilter>\n";
    }
    return "$xmlfilter";
  } // End of buildXMLFilter function

  // Build the item filter XML code
  buildXMLFilter($filterarray);

  // Construct the findItemsByKeywords POST call
  // Load the call and capture the response returned by the eBay API
  // the constructCallAndGetResponse function is defined below
  $resp = simplexml_load_string(constructPostCallAndGetResponse($endpoint, $query, $xmlfilter));

  // Check to see if the call was successful, else print an error
  if ($resp->ack == "Success") {
    $results = '';  // Initialize the $results variable

    // Parse the desired information from the response
    foreach($resp->searchResult->item as $item) {
      $pic   = $item->galleryURL;
      $link  = $item->viewItemURL;
      $title = $item->title;
      // Build the desired HTML code for each searchResult.item node and append it to $results
      $results .= "<tr><td><img src=\"$pic\"></td><td><a href=\"$link\">$title</a></br><a href=\"../ViewComparison/ViewComparisonDAO.php?bikeID=$id & name=$title\">Compare to stolen bike</a></td></tr>";
    }

  }else {  // If the response does not indicate 'Success,' print an error
    $results  = "<h3>Oops! The request was not successful. Make sure you are using a valid ";
    $results .= "AppID for the Production environment.</h3>";
  }
?>

<!-- Build the HTML page with values from the call response -->
<html>
  <head>
  </head>
  <body>
    <!--Create a table format for the page-->
    <div class="container">
      <div class="row">
        <div class="col">
          <!--Title for the page-->
          <h2>Search Ebay for the stolen bikes</h2>
          <hr />  
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--call the StolenEcommerceDAO.php page-->
          <form id ='stlnBikes' method="get" action="StolenEcommerceDAO.php">
            <!--Explanation for the user-->
            <h4>Select a stolen bike to search on ebay</h4>
            <?php
              //link to the database
              include '../../globalFiles/config.php';
              //the table is then searched so that all bikes that have been stolen are shown
              $result = mysqli_query($connection, "SELECT * FROM tbl_bikes WHERE stolen = '1'");
              //this creates the dropdown which will be filled with data from the table
              echo "<select class='browser-default custom-select' id = 'bikeID'>";
              echo "<option value='0'>ID - brand - model</option>";
              while ($row = mysqli_fetch_Array($result)) {
                //this prints out the bike ID, the brand and model for all the missing bikes 
                echo "<option>$row[bikeID] - $row[brand] - $row[model] </option>";
              }
              mysqli_close($connection);
            ?>
            <input type="submit" class="btn btn-primary" id="btnSubmit"></input>
            <script>
              //when the submit button is pressed the js file will be called.
              $('#stlnBikes').on('submit', function(e) {
			  	var formData = new FormData(this);

			  	//add val of bike dropdown to form data to be posted to DAO
			  	var bike = $('#bikeID').val();
			  	formData.append('bike', bike);

			  	if ($('#bikeID').val() === '0') { //guard against empty selection input
					alert("Please Select a Bike");
					return false;
			  	}

			  	//ajax to post data from form to js file
			  	e.preventDefault();
			  	$.ajax({
					url: "StolenEcommerceDAO.js",
					method: "POST",
					data: formData,
					contentType: false,
					cache: false,
					processData: false,
					success: function(echoedMsg) {},
					error: function(err) {
				  		alert("There was an error. Try again please!" + err);
					} 
			  	});
			  });
            </script>
          </form><br />
        </div>
      </div>
    </div>
    <div id="ebay" style="width: 700px; height: 500px;"> 
      <table>
        <tr>
          <td>
            <?php 
              //print out the results from ebay
              if (!empty($results)){
                echo $results;
              }else{
                echo "No results found";
              }
            ?>
          </td>
        </tr>
      </table>
    </div> <br>
  </body>
</html>

<?php
  function constructPostCallAndGetResponse($endpoint, $query, $xmlfilter) {
    global $xmlrequest;

    // Create the XML request to be POSTed
    $xmlrequest  = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
    $xmlrequest .= "<findItemsByKeywordsRequest xmlns=\"http://www.ebay.com/marketplace/search/v1/services\">\n";
    $xmlrequest .= "<keywords>";
    $xmlrequest .= $query;
    $xmlrequest .= "</keywords>\n";
    $xmlrequest .= $xmlfilter;
    $xmlrequest .= "<paginationInput>\n <entriesPerPage>5</entriesPerPage>\n</paginationInput>\n";
    $xmlrequest .= "</findItemsByKeywordsRequest>";

    // Set up the HTTP headers
    $headers = array(
      'X-EBAY-SOA-OPERATION-NAME: findItemsByKeywords',
      'X-EBAY-SOA-SERVICE-VERSION: 1.3.0',
      'X-EBAY-SOA-REQUEST-DATA-FORMAT: XML',
      'X-EBAY-SOA-GLOBAL-ID: EBAY-GB',
      'X-EBAY-SOA-SECURITY-APPNAME: Charlott-PoliceBi-PRD-5196b7be0-91d89b79',
      'Content-Type: text/xml;charset=utf-8',
    );

    $session  = curl_init($endpoint);                       // create a curl session
    curl_setopt($session, CURLOPT_POST, true);              // POST request type
    curl_setopt($session, CURLOPT_HTTPHEADER, $headers);    // set headers using $headers array
    curl_setopt($session, CURLOPT_POSTFIELDS, $xmlrequest); // set the body of the POST
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);    // return values as a string, not to std out

    $responsexml = curl_exec($session);                     // send the request
    curl_close($session);                                   // close the session
    return $responsexml;                                    // returns a string

  }  // End of constructPostCallAndGetResponse function
?>
<?php
  //sets the title of page
  $page_title = "View Comparison";
  //calls the css for the page
  require('../../globalFiles/policeHeader.php');
  error_reporting(E_ALL);  // Turn on all errors, warnings, and notices for easier debugging
  if (isset($_GET["name"])) {
    //This gets the value from previous pages and stores it in variables to be put into the table
		$name = $_GET["name"];
  }
  if (isset($_GET["bikeID"])) {
    //This gets the value from previous pages and stores it in variables to be put into the table
		$bikeID = $_GET["bikeID"];
  }
  $query =  $name;

  // API request variables
  $endpoint = 'https://svcs.ebay.com/services/search/FindingService/v1';  // URL to call
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
      $results .= "<tr><td><img src=\"$pic\"></td><td><a href=\"$link\">$title</a></br></td></tr>";
              
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
          <h2>Ebay Bike</h2>
          <hr />  
          <?php 
              //print out the results from ebay
              echo $results;
            ?>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <!--Title for the page-->
          <h2>Stolen Bike</h2>
          <hr />  
          <section id="sectionBikeImages" >
            <!--create a section for the bike image to be printed to-->
          </section>
          <?php
            //sql query to get the data from the image table for the relevant bike
            $sql = "SELECT * FROM tbl_bikeImages WHERE bikeID = '$bikeID'";
            //get the results from the sql query
            $res = mysqli_query($connection, $sql);
            //while there is a result from the query
            while ($row = mysqli_fetch_array($res)) {
              //store the imageID from the database in a variable
              $imgID = $row['imgID'];
              $json[] = $row;
            }
          ?>
          <!--js-->
          <script>
            //call the below js function
            getItemImages();
            function getItemImages() {
              //get the image ID from the php and store in variable
              var imgID = "<?php echo $imgID ?>";
              //if the bike doesnt have an image registered then the id is stored
              //if there is an image the it will be called imageid.jpeg or image.jpg
              //n and v store true or false depending if the word inbetween "" is in imgID
              var n = imgID.includes("jpg");
              var v = imgID.includes("jpeg");
              //get the bikeID from the php
              var bikeID = "<?php echo $bikeID ?>";
              //if the bike hase an image then
              if ((n == true) || (v == true)){
                //initialise html variable
                var html = '';
                var imageID = '../../Public/bikeImages/' + imgID;
                //store the bike image to be printed to the page
                html = html + '<img src="' + imageID + '"alt = "' + imageID + '" height="200" width="200">';
                //prints the data to the section on the page
                $('#sectionBikeImages').html(html);
              }else{
                //if the bike has no images the user is alerted
                alert("This bike has no images");
              }
            }
          </script>
        </div>
        <div class="col-md-auto">
          <!--print heading-->
          <h2>Stolen Bike Details</h2>
          <hr />
          <!--css for the printed table-->
          <style>
            #details td,#details th {
              /*set border for the table*/
              border: 5px solid #2b2b2b;
              padding: 8px;
            }
            #details th {
              /*css for the headings in the table*/
              padding-top: 12px;
              padding-bottom: 12px;
              text-align: left;
              background-color: #0032a0;
              color: white;
            }
          </style>
          <?php
            //sql query to get all the bikes from the table which are stolen
            $sql = "SELECT * FROM tbl_bikes WHERE bikeID = '$bikeID' AND stolen = 1";
            //store the result from the query
            $result = mysqli_query($connection, $sql);
            //if there ar eresults from the query then
            if(mysqli_num_rows($result)>0){ 
              if (mysqli_query($connection, $sql)) {
                //creates the table with the following headings
                echo "<table border='1' id='details'>
                <tr>
                <th>Bike ID</th>
                <th>MPN</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Bike type</th>
                <th>Wheel size</th>
                <th>Colour</th>
                <th>Number of gears</th>
                <th>Brakes</th>
                <th>Suspension</th>
                <th>Gender</th>
                <th>Age</th>
                </tr>";
                //for each row in the results this will loop
                while ($row = mysqli_fetch_array($result)) {
                  //the data from the database get printed into the table
                  echo "<tr>";
                  echo "<td>" . $row['bikeID'] . "</td>";
                  echo "<td>" . $row['mpn'] . "</td>";
                  echo "<td>" . $row['brand'] . "</td>";
                  echo "<td>" . $row['model'] . "</td>";
                  echo "<td>" . $row['bikeType'] . "</td>";
                  echo "<td>" . $row['wSize'] . "</td>";
                  echo "<td>" . $row['colour'] . "</td>";
                  echo "<td>" . $row['nGears'] . "</td>";
                  echo "<td>" . $row['brakes'] . "</td>";
                  echo "<td>" . $row['suspension'] . "</td>";
                  echo "<td>" . $row['gender'] . "</td>";
                  echo "<td>" . $row['age'] . "</td>";
                }
                echo "</table>";
                //if query is not completed error is shown
              } else {
                 echo mysqli_error($connection);
                return;
              }
            }else{
              //if there are no results from the sql query
              echo "<script language='javascript'>";
              echo 'alert("There are no bikes which are reported stolen");';
              echo "</script>";
            }
          ?>
        </div>
      </div>
    </div>
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
    $xmlrequest .= "<paginationInput>\n <entriesPerPage>1</entriesPerPage>\n</paginationInput>\n";
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
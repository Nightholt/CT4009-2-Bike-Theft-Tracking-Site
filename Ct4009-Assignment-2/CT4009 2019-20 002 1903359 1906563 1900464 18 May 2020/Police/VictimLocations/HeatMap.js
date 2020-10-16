var map, heatmap;
//show google map and heatmap
function initMap() {
    //this sets the center of the map to be gloucester
    var mapCenter = new google.maps.LatLng(51.8642, -2.2382);
    map = new google.maps.Map(document.getElementById('map'), {
        //sets the amount that the map is zoomed in
        zoom: 15,
        center: mapCenter
    });
    var locations = [];
    var lat, lng, locObj;

    //send request to php, the returns data of locations
    $.post("HeatMap.php", "", function(data) {
        $.each(data, function(key, value) {
            //saves the value from the database in a variable
            lat = value['Latitude'];
            //saves the value from the database in a variable
            lng = value['Longitude'];
            //sets the marker as 
            locObj = new google.maps.LatLng(lat, lng);
            locations.push(locObj);
        });
        return locations;
    }, "json");
    //this creates the heatmap
    heatmap = new google.maps.visualization.HeatmapLayer({
        //the data that is shown is then displayed
        data: locations,
        map: map
    });
}
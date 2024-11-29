<?php
/**
 * Gets a number of posts and displays them as options
 * @param  array $query_args Optional. Overrides defaults.
 * @return array             An array of options that matches the CMB2 options array
 */
function cmb2_render_address_field_callback( $field, $value, $object_id, $object_type, $field_type ) {
  ?>
  <!DOCTYPE html>
  <html>
    <head>
      <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
      <meta charset="utf-8">
      <title>Places Search Box</title>
      <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
          height: 100%;
        }
        /* Optional: Makes the sample page fill the window. */
        #description {
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
        }

        #infowindow-content .title {
          font-weight: bold;
        }

        #infowindow-content {
          display: none;
        }

        #map #infowindow-content {
          display: inline;
        }

        .pac-card {
          margin: 10px 10px 0 0;
          border-radius: 2px 0 0 2px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          outline: none;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
          background-color: #fff;
          font-family: Roboto;
        }

        #pac-container {
          padding-bottom: 12px;
          margin-right: 12px;
        }

        .pac-controls {
          display: inline-block;
          padding: 5px 11px;
        }

        .pac-controls label {
          font-family: Roboto;
          font-size: 13px;
          font-weight: 300;
        }

        #pac-input {
          background-color: #fff;
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
          margin-left: 12px;
          text-overflow: ellipsis;
          border: none;
              border-bottom-color: currentcolor;
              border-bottom-style: none;
              border-bottom-width: medium;
          border-bottom: 2px solid red;
          margin: 1%;
              margin-left: 1%;
          text-align: center;
          margin-left: 17%;
          line-height: 2;
          width: 50%;

        }

        #pac-input:focus {
          border-color: #4d90fe;
        }

        #title {
          color: #fff;
          background-color: #4d90fe;
          font-size: 25px;
          font-weight: 500;
          padding: 6px 12px;
        }
        #target {
          width: 345px;
        }
      </style>
    </head>
    <body>
      <p style="visibility: hidden;" id="instruction" >Insert Address Above Box</p>
      <input id="pac-input" class="controls" type="text" placeholder="Search Box">
      <div id="map"></div>
      <script>
        // This example adds a search box to a map, using the Google Place Autocomplete
        // feature. People can enter geographical searches. The search box will return a
        // pick list containing a mix of places and predicted search terms.

        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

        function initAutocomplete() {
          var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 0, lng: -0 },
            zoom: 2.9,
            mapTypeId: 'roadmap'
          });

          map.addListener('click', function(e) {
          placeMarkerAndPanTo(e.latLng, map);
        });


          // Create the search box and link it to the UI element.
          var input = document.getElementById('pac-input');
          var searchBox = new google.maps.places.SearchBox(input);
          map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
          map.addListener('bounds_changed', function() {
            searchBox.setBounds(map.getBounds());
          });

          var markers = [];
          // Listen for the event fired when the user selects a prediction and retrieve
          // more details for that place.
          searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
              return;
            }

            // Clear out the old markers.
            markers.forEach(function(marker) {
              marker.setMap(null);
            });
            markers = [];

            // For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function(place) {
              if (!place.geometry) {
                console.log("Returned place contains no geometry");
                return;
              }

              var icon = {
                url: place.icon,
                //size: new google.maps.Size(71, 71),
                //origin: new google.maps.Point(0, 0),
                //anchor: new google.maps.Point(17, 34),
                //scaledSize: new google.maps.Size(25, 25)
              };

              var myLatlng = new google.maps.LatLng(41.38,2.18);

              // Create a marker for each place.
              markers.push(new google.maps.Marker({
                map: map,
                //icon: icon,
                title: place.name,
                draggable: true,
                position: myLatlng,
                map: map,
                title: "Your location"
                //position: place.geometry.location
              }));

              if (place.geometry.viewport) {
                // Only geocodes have viewport.
                bounds.union(place.geometry.viewport);
              } else {
                //bounds.extend(place.geometry.location);
                //alert(event.latLng);

              }

            });
            map.fitBounds(bounds);

          });

          function placeMarkerAndPanTo(latLng, map) {
            var marker = new google.maps.Marker({
              position: latLng,
              map: map
            });
          };


          google.maps.event.addListener(map, 'click', function(event) {

              var cordinates = event.latLng;
              map.panTo( cordinates );
              //alert( cordinates );
              //console.log( cordinates.lat() );
              document.getElementById("submitted_latitude").value = cordinates.lat();
              document.getElementById("submitted_longitude").value = cordinates.lng();
          });
          }


          //google.maps.event.addDomListener(window, 'load', initialize);





      </script>
      <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoJXJ2Xkt_HwRNeRjEtAbwKVpjlXoQg1I&libraries=places&callback=initAutocomplete"
           async defer></script>
    </body>
  </html>

<!--
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoJXJ2Xkt_HwRNeRjEtAbwKVpjlXoQg1I&libraries=places"></script>

 <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">

 <input type="text" placeholder="Enter Area name to populate Latitude and Longitude" name="address" onFocus="initializeAutocomplete()" id="address" ><br>


 <script type="text/javascript">
   function initializeAutocomplete(){
     var input = document.getElementById('address');
     //console.log( input.value );

     var options = {}

     var autocomplete = new google.maps.places.Autocomplete( input, options );

     google.maps.event.addListener(autocomplete, 'place_changed', function() {
       var place = autocomplete.getPlace();
       var lat = place.geometry.location.lat();
       var lng = place.geometry.location.lng();
       var placeId = place.place_id;
       // to set city name, using the locality param
       var componentForm = {
         locality: 'short_name',
       };
       for (var i = 0; i < place.address_components.length; i++) {
         var addressType = place.address_components[i].types[0];
         if (componentForm[addressType]) {
           var val = place.address_components[i][componentForm[addressType]];
           //document.getElementById("city").value = val;
         }
       }
       document.getElementById("submitted_latitude").value = lat;
       document.getElementById("submitted_longitude").value = lng;
       document.getElementById("submitted_address").value = input.value;
       //document.getElementById("location_id").value = placeId;
     });
   }
 </script>
-->

 <?php
}

add_filter( 'cmb2_render_address', 'cmb2_render_address_field_callback', 10, 5 );

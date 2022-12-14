<?php include 'header.php';?>
<?php include 'breadcrumb.php';?>

    
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Rudraksha Suggestion</h2>
                       <form method='post' action='rudraksha-suggestion.php'>
                           
<div class="group-input">
                                <label for="username">Name</label>
                                <input  name="fullname" placeholder="Name" required="">
                            </div>
                            
                            <div class="group-input">
                                <label for="pass">Date</label>

                                <input  name="date" type='date'  placeholder="Date of Year" required="">
                            </div>



                           <div class="group-input">
                                <label for="pass">Time</label>

                                <input  name="time" type='time' required="">
                            </div>  
                     
                             <div class="form-group">
                        <label for="">Location</label>
                        <div id="locationField">
                            <input id="rz_location-pac-input"  type="text" placeholder="Enter a location" class="form-control" name="location" required>
                        </div>
                        <div id="rz_location-map" style="position: relative; overflow: hidden;">
                            <div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
                               <div style="overflow: hidden;"></div>

                               <div class="gm-style" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px;">
                                  <div tabindex="0" style="position: absolute; z-index: 0; left: 0px; top: 0px; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; cursor: url(&quot;https://maps.gstatic.com/mapfiles/openhand_8_8.cur&quot;), default; touch-action: pan-x pan-y;">
                                     <div style="z-index: 1; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">
                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 100; width: 100%;">
                                           <div style="position: absolute; left: 0px; top: 0px; z-index: 0;">
                                              <div style="position: absolute; z-index: 987; transform: matrix(1, 0, 0, 1, -21, -245);">
                                                 <div style="position: absolute; left: 0px; top: 0px; width: 256px; height: 256px;">
                                                    <div style="width: 256px; height: 256px;"></div>

                                                 </div>
                                              </div>
                                           </div>
                                        </div>

                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 101; width: 100%;"></div>
                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 102; width: 100%;"></div>
                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 103; width: 100%;"></div>
                                        <div style="position: absolute; left: 0px; top: 0px; z-index: 0;"></div>

                                     </div>

                                     <div class="gm-style-pbc" style="z-index: 2; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; opacity: 0;">

                                        <p class="gm-style-pbt"></p>
                                     </div>

                                     <div style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;">
                                        <div style="z-index: 4; position: absolute; left: 50%; top: 50%; width: 100%; transform: translate(0px, 0px);">

                                           <div style="position: absolute; left: 0px; top: 0px; z-index: 104; width: 100%;"></div>
                                           <div style="position: absolute; left: 0px; top: 0px; z-index: 105; width: 100%;"></div>
                                           <div style="position: absolute; left: 0px; top: 0px; z-index: 106; width: 100%;"></div>
                                           <div style="position: absolute; left: 0px; top: 0px; z-index: 107; width: 100%;"></div>

                                        </div>
                                     </div>
                                  </div>

                                  <iframe aria-hidden="true" frameborder="0" tabindex="-1" style="z-index: -1; position: absolute; width: 100%; height: 100%; top: 0px; left: 0px; border: none;"></iframe>

                               </div>
                            </div>
                         </div>
                    </div>

                    <div class="form-group">
                        <label for="">Latitude</label>
                        <input type="text" name="latitude"  class="form-control drop_lat" id="input_lat"  placeholder="Latitude" readonly required>
                    </div>

                    <div class="form-group">
                        <label for="">Longitude</label>
                        <input type="text" name="longitude" class="form-control drop_lng"  placeholder="Longitude" readonly required>
                    </div>




                            <button type="submit" class="site-btn register-btn">Submit Now</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->
    

<?php include 'footer.php';?>

<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    function initMap() {
        var elementExists = document.getElementById("rz_location-map");
        if (elementExists) {

            var map = new google.maps.Map(document.getElementById('rz_location-map'), {
                center: {
                    lat: -33.8688,
                    lng: 151.2195
                },
                zoom: 13,
                mapTypeId: 'roadmap'
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('rz_location-pac-input');
            var geocoder = new google.maps.Geocoder;

            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // var searchBox = new google.maps.places.Autocomplete(input);
            // searchBox.setComponentRestrictions(
            // {'country': ['in']});

            // Bias the SearchBox results towards current map's viewport.
            map.addListener('bounds_changed', function() {
                searchBox.setBounds(map.getBounds());
            });
            console.log(searchBox);


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
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };

                    // Create a marker for each place.
                    markers.push(new google.maps.Marker({
                        map: map,
                        icon: icon,
                        title: place.name,
                        position: place.geometry.location
                    }));

                    if (place.geometry.viewport) {
                        // Only geocodes have viewport.
                        bounds.union(place.geometry.viewport);
                        // document.getElementsByClassName('drop_lat').value = place.geometry.location.lat();
                        // document.getElementsByClassName('drop_lng').value = place.geometry.location.lng();
                        console.log(place)
                        $(".drop_lat").val(place.geometry.location.lat());
                        $(".drop_lng").val(place.geometry.location.lng());
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    }
 </script>

<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD7BIoSvmyufubmdVEdlb2sTr4waQUexHQ&libraries=places&region=in&callback=initMap">
    </script>
    


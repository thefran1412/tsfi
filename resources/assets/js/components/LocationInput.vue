<template>
    <div>
        <div class="content-bottom-header">
            <input id="pac-input" class="controls" type="text"
            placeholder="Enter a location">
            <div id="map" ref="map" ></div>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {

            }
        },
        mounted: function() {
            this.initMap();
        },
        methods: {
            initMap: function() {

                 var myLatLng = {lat: 41.366438452538, lng: 2.0970153808594};

                 var map = new google.maps.Map(this.$refs.map , {
                    center: myLatLng,
                    scrollwheel: true,
                    zoom: 16
                 })

                  var input = document.getElementById('pac-input');

                  var autocomplete = new google.maps.places.Autocomplete(input);
                  autocomplete.bindTo('bounds', map);

                  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

                  var infowindow = new google.maps.InfoWindow();

                  var marker = new google.maps.Marker({
                    map: map
                  });

                  marker.addListener('click', function() {
                    infowindow.open(map, marker);
                  });

                  autocomplete.addListener('place_changed', function() {
                    infowindow.close();
                    var place = autocomplete.getPlace();

                    if (!place.geometry) {
                      return;
                    }

                    if (place.geometry.viewport) {
                      map.fitBounds(place.geometry.viewport);
                    } else {
                      map.setCenter(place.geometry.location);
                      map.setZoom(17);
                    }

                    // Set the position of the marker using the place ID and location.
                    marker.setPlace({
                      placeId: place.place_id,
                      location: place.geometry.location
                    });
                    marker.setVisible(true);

                    console.log(place.geometry.location.lat());
                    console.log(place.geometry.location.lng());

                    infowindow.setContent('<div><strong>' + place.name + '</strong><br>'+ '<br>' +
                        place.formatted_address);
                    infowindow.open(map, marker);
                  });
            }
        }
    }
</script>

<style type="text/css">
   #map {width:100%;}

   .controls {
        background-color: #fff;
        border-radius: 2px;
        border: 1px solid transparent;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        box-sizing: border-box;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        height: 29px;
        margin-left: 17px;
        margin-top: 10px;
        outline: none;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 400px;
      }

      .controls:focus {
        border-color: #4d90fe;
      }
 </style>
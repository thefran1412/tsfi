var lat;
var lng;
$("#create").submit(function(e){
  if ($("#pac-input").is(":focus")) {
    e.preventDefault();
  }else{
    $('#lat').val(lat);
    $('#lng').val(lng);
  }
}); 


function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 41.627619, lng: 2},
    zoom: 7,
    scrollwheel: false
  });

  var input = document.getElementById('pac-input');

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  var infowindow = new google.maps.InfoWindow();
  var infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
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
    
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();
    // console.log(lat, lng);

    infowindowContent.children['place-name'].textContent = place.name;
    // infowindowContent.children['place-id'].textContent = place.place_id;
    // infowindowContent.children['place-address'].textContent = place.formatted_address;
    infowindow.open(map, marker);
    });
}
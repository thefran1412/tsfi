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

var map;
var input;
var autocomplete;
var infowindow;
var infowindowContent;
var marker;
var place;

var lat;
var lng;
var zoom = 7;

function initMap(ilat = 41.627619, ilng = 2, dir = null) {

  var myLatLng = {lat: ilat, lng: ilng};
  
  if (dir != null) {
    zoom = 17;
  }

  map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: zoom,
    scrollwheel: false
  });

  infowindow = new google.maps.InfoWindow();
  infowindowContent = document.getElementById('infowindow-content');

  infowindow.setContent(infowindowContent);
  
  if (dir != null) {
    marker = new google.maps.Marker({
      position: myLatLng,
      map: map,
      title: dir
    });

    infowindow.open(map, marker);
  }
  else{
    
    marker = new google.maps.Marker({
      map: map
    });
    marker.addListener('click', function() {
      infowindow.open(map, marker);
    });
    
  }
  input = document.getElementById('pac-input');

  autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  autocomplete.addListener('place_changed', function() {
    
    infowindow.close();

    place = autocomplete.getPlace();

    if (place.geometry.viewport) {
      map.fitBounds(place.geometry.viewport);
      //exec
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

    console.log(lat, lng);

    infowindowContent.children['place-name'].textContent = place.name;
    infowindow.open(map, marker);
  });
}

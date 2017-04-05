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
  console.log(dir);

  if (dir != null) {
    zoom = 17;
  }

  map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: ilat, lng: ilng},
      zoom: zoom,
      scrollwheel: false
    });

  input = document.getElementById('pac-input');

  autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.bindTo('bounds', map);

  // map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

  infowindow = new google.maps.InfoWindow();
  infowindowContent = document.getElementById('infowindow-content');
  infowindow.setContent(infowindowContent);
  marker = new google.maps.Marker({
    map: map
  });
  marker.addListener('click', function() {
    infowindow.open(map, marker);
  });
  if (dir != null) {
    marker.setPlace({
      placeId: place.place_id,
      location: place.geometry.location
    });
    marker.setVisible(true);
    
    lat = place.geometry.location.lat();
    lng = place.geometry.location.lng();

    infowindowContent.children['place-name'].textContent = place.name;
    infowindow.open(map, marker);
    infowindow.open(map, marker);

  }
  //change();
  // console.log('exec');
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
  // console.log(lat, lng);

  infowindowContent.children['place-name'].textContent = place.name;
  // infowindowContent.children['place-id'].textContent = place.place_id;
  // infowindowContent.children['place-address'].textContent = place.formatted_address;
  infowindow.open(map, marker);
    });
}

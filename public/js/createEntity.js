$("#create").submit(function(e){
  if ($("#pac-input").is(":focus")) {
    console.log($("#pac-input").is(":focus"));
    e.preventDefault();
  }
}); 



$( "#pac-input" ).focus(function() {
  
});




function valid() {
  
  var cool = true;
  
  $(".form-control").each(function( index ) {
    
    console.log( index + ": " + $( this ).val() );
      $(this).parent().addClass('has-error');
    
      var r = null;
      switch($(this).attr('id')) {
        case 'url':
            r = isUrlValid($(this).val());
            break;
        case 'phone':
            r = isPhoneValid($(this).val());
            break;
        case 'location':
            break;
        default:
            r = isValid($(this).val());
      }

      console.log(r);

      if (r) {
        $(this).parent().removeClass('has-error').addClass('has-success');
      } else {
        $(this).parent().removeClass('has-success').addClass('has-error');
        cool = false;
      }
  });

  return cool;
}
function isUrlValid(url) {
  var valid = isValid(url);
  if (valid){
    var e = /^(https?:\/\/)?([\da-z\.-]+\.[a-z\.]{2,6}|[\d\.]+)([\/:?=&#]{1}[\da-z\.-]+)*[\/\?]?$/ig;
    return e.test(url)
  }
  else if (valid == 'empty'){
    return true;
  } 
  else {
    return false;
  }
}
function isPhoneValid(argument) {
  var valid = isValid(url);
  if (valid){
    var e = /\d{9}/ig;
    return e.test(url)
  }
  else if (valid == 'empty'){
    return true;
  } 
  else {
    return false;
  }
}

function isValid(value) {
  if (value == '') {
    if ($(this).prop('required')) {
      return false;
    }
    else{
      return 'empty';
    }
  }
  return true;
}




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

    infowindowContent.children['place-name'].textContent = place.name;
    infowindowContent.children['place-id'].textContent = place.place_id;
    infowindowContent.children['place-address'].textContent =
        place.formatted_address;
    infowindow.open(map, marker);
    });
}
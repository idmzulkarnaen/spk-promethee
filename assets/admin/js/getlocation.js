var geocoder;  
var map;
var infowindow = new google.maps.InfoWindow();
var marker; 
var g_err = 0;

function initialize() {

  var markers = [];
  var haightAshbury = {lat: -1.4368616234108336, lng: 120.02197086811066};
  var mapOptions = {
    zoom: 5,
    center: haightAshbury,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false
  };  

  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

  // Create the search box and link it to the UI element.  

  var input = document.getElementById('pac-input');
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  var searchBox = new google.maps.places.SearchBox(input);

  // [START region_getplaces]  
  // Listen for the event fired when the user selects an item from the  
  // pick list. Retrieve the matching places for that item.  

  google.maps.event.addListener(searchBox, 'places_changed', function() {  
    var places = searchBox.getPlaces();  
    if (places.length == 0) {  
      return;  
    }  
    for (var i = 0, marker; marker = markers[i]; i++) {  
      marker.setMap(null);  
    }

    // For each place, get the icon, place name, and location.  
    markers = [];  
    var bounds = new google.maps.LatLngBounds();  
    for (var i = 0, place; place = places[i]; i++) {  
      var image = {  
        url: place.icon,  
        size: new google.maps.Size(75, 75),  
        origin: new google.maps.Point(0, 0),  
        anchor: new google.maps.Point(17, 34),  
        scaledSize: new google.maps.Size(25, 25)  
      };  

      // Create a marker for each place.  

      var marker = new google.maps.Marker({  
        map: map,  
        icon: image,  
        title: place.name,  
        position: place.geometry.location  
      }); 
      $('.lat').val(marker.position.lat());  
      $('.lon').val(marker.position.lng());    
      markers.push(marker);  
      bounds.extend(place.geometry.location);
    }  
    map.fitBounds(bounds);
  });

  google.maps.event.addListener(map, 'click', function(event) {
    for (var i = 0; i < markers.length; i++) {
      markers[i].setMap(map);
    }
    markers = [];
    marker = new google.maps.Marker({
      position: event.latLng,
      map: map
    });

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map, marker);
      infowindow.setContent($('#namapeternakan').val());
    });

    $('.lat').val(marker.position.lat());  
    $('.lon').val(marker.position.lng());  
  });
  // [END region_getplaces]  

  // Bias the SearchBox results towards places that are within the bounds of the  
  // current map's viewport.
  google.maps.event.addListener(map, 'bounds_changed', function() {  
    var bounds = map.getBounds();  
    searchBox.setBounds(bounds);  
  });

} 

google.maps.event.addDomListener(window, 'load', initialize);  
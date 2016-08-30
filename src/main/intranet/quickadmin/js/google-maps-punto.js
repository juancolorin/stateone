var map;
var nuevo = true;
var markersArray = [];
	
$(document).ready(function(){
	//loadMap();
});


function loadMap()
{
	geocoder = new google.maps.Geocoder();
	/* Opciones del Mapa */
	var latInicial = '36.89308';
	var longInicial = '-2.56170';
	if($('#latitud').val() != '' && $('#longitud').val() != ''){
		longInicial = $('#longitud').val();
		latInicial = $('#latitud').val();
	}
	var zoomInicial = 8;
	var initialLatlng = new google.maps.LatLng(latInicial, longInicial);
    var myOptions = 
    {
      zoom: zoomInicial,
      center: initialLatlng,
      mapTypeId: google.maps.MapTypeId.ROADMAP,
      mapTypeControl: true,
      mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
      streetViewControl: true
    }
    
    map = new google.maps.Map(document.getElementById("mapagoogle"), myOptions);
    
    google.maps.event.addListener(map, 'click', function(event) 
    {
    	if (nuevo) {
	    	var myLatLng = event.latLng;
	    	addMarker(event.latLng);
    	}
    });
    
    if($('#latitud').val() != '' && $('#longitud').val() != ''){
    	var myLatLng = new google.maps.LatLng($('#latitud').val(), $('#longitud').val());
    	addMarker(myLatLng);
    } else if ($('#direccion').val() != '') {
    	address = $('#direccion').val();
    	if ($('#cp').length > 0) {
    		if ($('#cp').val() != '') {
    			address =  $('#cp').val() + " " + address + " " + $('#cp').val();
    			if ($('#cp').length > 0) {
    				var provincias = $("#provincias_id option[value='" + $('#provincias_id').val() + "']").text();
    		    	if (provincias != '') {
    		    		address =  provincias + " " + address;
    		    	}
    			}
    		}
    	}else if ($('#provincias_id').length > 0) {
    		var provincias = $("#provincias_id option[value='" + $('#provincias_id').val() + "']").text();
	    	if (provincias != '') {
	    		address =  provincias + " " + address;
	    	}
    	}
		if (!(typeof zoom == 'undefined')) {
			codeAddress(address, zoom);
		} else {
			codeAddress(address, false);
		}
	}
    
}

function codeAddress(address, zoom) 
{
    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
    	  var addressLocation = results[0].geometry.location;
    	  map.setCenter(addressLocation);
    	  addMarker(addressLocation);
    	  if (zoom) {
    		  map.setZoom(zoom);
    	  } else {
    		  map.setZoom(18);
    	  }
      } else {
        alert("No hemos podido encontrar la dirección introducida: " + status);
      }
    });
}

function addMarker(location) 
{
	deleteOverlays();
	var image = '/public/static/images/home-ico.png';
	var marker = new google.maps.Marker({
		position: location,
		draggable: true,
	    animation: google.maps.Animation.DROP,
	    icon: image,
		map: map
	});
	updateLocation(location);
	
	google.maps.event.addListener(marker, 'dragend', function() {
		if(aplicarLatLong != 'N'){
			updateLocation(marker.position);
		}
	});
	markersArray.push(marker);
}

function updateLocation(location) 
{
	var lat = location.lat();
    var lng = location.lng();
	$('#longitud').val(lng);
	$('#latitud').val(lat);
}

function deleteOverlays() 
{
	if (markersArray) {
		for (i in markersArray) {
			markersArray[i].setMap(null);
		}
		markersArray.length = 0;
    }
}

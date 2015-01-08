/*--------------------------------------------------------------
Maps
--------------------------------------------------------------*/

function initialise() {

	var addressName = mw_map_vars.addressName,
		googleMapsLink = mw_map_vars.googleMapsLink,
		mapStyle = mw_map_vars.mapStyle,
		mapMarker = mw_map_vars.mapMarker,
		pinOrCustom = mw_map_vars.pin,
		pinImage = mw_map_vars.pinImage,
		radius = mw_map_vars.radiusDistance,
		mile = 1609.344;
		pluginUrl = mw_map_vars.pluginUrl;

	var myLatlng = new google.maps.LatLng( mw_map_vars.lat, mw_map_vars.long ); // Add the coordinate
	
	currentLatLong = myLatlng;
	
	var mapOptions = {

		zoom: parseInt(mw_map_vars.zoom), // The initial zoom level when your map loads (0-20)
		minZoom: 0, // Minimum zoom level allowed (0-20)
		maxZoom: 20, // Maximum soom level allowed (0-20)
		zoomControl:true, // Set to true if using zoomControlOptions below, or false to remove all zoom controls.
		zoomControlOptions: {
			style:google.maps.ZoomControlStyle.SMALL, // Change to SMALL to force just the + and - buttons.
			position: google.maps.ControlPosition.RIGHT_TOP
		},
		center: myLatlng, // Centre the Map to our coordinates variable
		mapTypeId: google.maps.MapTypeId.ROADMAP, // Set the type of Map
		scrollwheel: false,
		panControl:true, // Set to false to disable
		panControlOptions: {
			position: google.maps.ControlPosition.RIGHT_TOP
		},
		mapTypeControl:false, // Disable Map/Satellite switch
		scaleControl:true, // Set to false to hide scale
		streetViewControl:false, // Set to disable to hide street view
		overviewMapControl:false, // Set to false to remove overview control
		rotateControl:false // Set to false to disable rotate control
	
	};

	var map = new google.maps.Map(document.getElementById('map-wrapper'), mapOptions); 
	
	google.maps.event.addDomListener(window, 'resize', function() { map.setCenter(currentLatLong); });

	if ( pinOrCustom == 'custom' ) { 

		var image = new google.maps.MarkerImage( ""+ pinImage +"", null, null, null, new google.maps.Size( mw_map_vars.markerWidth, mw_map_vars.markerHeight )); // Create a variable for our marker image.

	} else {

		var image = new google.maps.MarkerImage( pluginUrl +"/mw-business-details/image/map-marker.png", null, null, null, new google.maps.Size(46,71)); // Create a variable for our marker image.

	};
		
	var marker = new google.maps.Marker({ // Set the marker
		position: myLatlng, // Position marker to coordinates
		icon:image, //use our image as the marker
		map: map, // assign the market to our map variable
		title: 'Click to view in Google Maps' // Marker ALT Text
	});	

	if ( mapMarker == "radius" ) { 

		// hide Icon
		marker.setVisible(false);	

		radiusCalc = mile * radius;
		console.log(radiusCalc);

		// set radius
		var circle = new google.maps.Circle({
	  		map: map,
	  		radius: radiusCalc,
	  		fillColor: '#a54fee',
	        strokeColor: '#CD0000',
	   		strokeOpacity: 0,		
		});

		circle.bindTo('center', marker, 'position');	

	} 

	var infowindow = new google.maps.InfoWindow({ // Create a new InfoWindow
			
		content: '<h3>'+ addressName +'</h3><p><a target="_blank" href="' + googleMapsLink + '"> View on Google Maps</a></p>' // HTML contents of the InfoWindow
	
	});

	if ( mw_map_vars.showInfoWindow == "show" ) { 

		infowindow.open(map,marker); // Open our InfoWindow

		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
				
			infowindow.open(map,marker); // Open our InfoWindow

		});

	} else { 

		google.maps.event.addListener(marker, 'click', function() { // Add a Click Listener to our marker
				
			infowindow.open(map,marker); // Open our InfoWindow

		});

	}

	if ( mapStyle === "colourful" ) { 

		var styles = [{"featureType":"road","elementType":"labels","stylers":[{"visibility":"simplified"},{"lightness":20}]},{"featureType":"administrative.land_parcel","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"landscape.man_made","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels","stylers":[{"visibility":"simplified"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"hue":"#a1cdfc"},{"saturation":30},{"lightness":49}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"hue":"#f49935"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"hue":"#fad959"}]}];

	} else if ( mapStyle === "grey" ) {


		var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];

	} else if ( mapStyle === "pale" ) {

		var styles = [{"featureType":"water","stylers":[{"visibility":"on"},{"color":"#acbcc9"}]},{"featureType":"landscape","stylers":[{"color":"#f2e5d4"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"color":"#c5c6c6"}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#e4d7c6"}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#fbfaf7"}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#c5dac6"}]},{"featureType":"administrative","stylers":[{"visibility":"on"},{"lightness":33}]},{"featureType":"road"},{"featureType":"poi.park","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":20}]},{},{"featureType":"road","stylers":[{"lightness":20}]}];


	} else if ( mapStyle === "custom" ) {

		var styles = jQuery.parseJSON(mw_map_vars.customMap);

	}

	map.setOptions({ styles: styles })

}

// FUNCTION TO RUN GOOGLE MAP, IF DIV IS VISABLE

jQuery(document).ready(function($){

	if ($('#map-wrapper').length > 0) {

		initialise();

	}

			
});

function singleMap(){var e=new google.maps.Geocoder;e.geocode({address:autoAddress},function(e,t){if("OK"==t)var a=e[0].geometry.location.lat(),s=e[0].geometry.location.lng();var r=new google.maps.LatLng(a,s);google.maps.Map.prototype.setCenterWithOffset=function(e,t,a){var s=this,r=new google.maps.OverlayView;r.onAdd=function(){var r=this.getProjection(),i=r.fromLatLngToContainerPixel(e);i.x=i.x+t,i.y=i.y+a,s.setCenter(r.fromContainerPixelToLatLng(i))},r.draw=function(){},r.setMap(this)},currentLatLong=r;var i={zoom:parseInt(mw_map_vars.zoom),minZoom:0,maxZoom:20,zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.SMALL,position:google.maps.ControlPosition.RIGHT_TOP},center:r,mapTypeId:google.maps.MapTypeId.ROADMAP,scrollwheel:!1,panControl:!1,panControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP},mapTypeControl:!1,scaleControl:!1,streetViewControl:!1,overviewMapControl:!1,rotateControl:!1},l=new google.maps.Map(document.getElementById("map-wrapper"),i);if(google.maps.event.addDomListener(window,"resize",function(){l.setCenter(currentLatLong)}),"custom"==pinOrCustom)var o=new google.maps.MarkerImage(""+pinImage,null,null,null,new google.maps.Size(parseInt(mw_map_vars.markerWidth),parseInt(mw_map_vars.markerHeight)));else var o=new google.maps.MarkerImage(pluginUrl+"/mw-business-details/image/map-marker.png",null,null,null,new google.maps.Size(46,71));var n=new google.maps.Marker({position:r,icon:o,map:l,title:"Click to view in Google Maps"});if("radius"==mapMarker){n.setVisible(!1),radiusCalc=mile*radius,console.log(radiusCalc);var p=new google.maps.Circle({map:l,radius:radiusCalc,fillColor:"#a54fee",strokeColor:"#CD0000",strokeOpacity:0});p.bindTo("center",n,"position")}var y=new google.maps.InfoWindow({content:"<h3>"+addressName+'</h3><p class="map-address">'+autoAddress+'</p><p><a target="_blank" href="'+googleMapsLink+'"> View on Google Maps</a></p>'});if("show"==mw_map_vars.showInfoWindow?(y.open(l,n),google.maps.event.addListener(n,"click",function(){y.open(l,n)}),l.setCenterWithOffset(currentLatLong,0,-110),google.maps.event.addDomListener(window,"resize",function(){l.setCenterWithOffset(currentLatLong,0,-110)})):google.maps.event.addListener(n,"click",function(){y.open(l,n)}),"colourful"===mapStyle)var m=[{featureType:"road",elementType:"labels",stylers:[{visibility:"simplified"},{lightness:20}]},{featureType:"administrative.land_parcel",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.local",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"road.highway",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"poi",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{hue:"#a1cdfc"},{saturation:30},{lightness:49}]},{featureType:"road.highway",elementType:"geometry",stylers:[{hue:"#f49935"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{hue:"#fad959"}]}];else if("grey"===mapStyle)var m=[{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}];else if("pale"===mapStyle)var m=[{featureType:"water",stylers:[{visibility:"on"},{color:"#acbcc9"}]},{featureType:"landscape",stylers:[{color:"#f2e5d4"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#c5c6c6"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#e4d7c6"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#fbfaf7"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#c5dac6"}]},{featureType:"administrative",stylers:[{visibility:"on"},{lightness:33}]},{featureType:"road"},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"on"},{lightness:20}]},{},{featureType:"road",stylers:[{lightness:20}]}];else if("custom"===mapStyle)var m=jQuery.parseJSON(mw_map_vars.customMap);l.setOptions({styles:m})})}function staticMap(){var e=new google.maps.LatLng(lat,long);google.maps.Map.prototype.setCenterWithOffset=function(e,t,a){var s=this,r=new google.maps.OverlayView;r.onAdd=function(){var r=this.getProjection(),i=r.fromLatLngToContainerPixel(e);i.x=i.x+t,i.y=i.y+a,s.setCenter(r.fromContainerPixelToLatLng(i))},r.draw=function(){},r.setMap(this)},currentLatLong=e;var t={zoom:parseInt(mw_map_vars.zoom),minZoom:0,maxZoom:20,zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.SMALL,position:google.maps.ControlPosition.RIGHT_TOP},center:e,mapTypeId:google.maps.MapTypeId.ROADMAP,scrollwheel:!1,panControl:!1,panControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP},mapTypeControl:!1,scaleControl:!1,streetViewControl:!1,overviewMapControl:!1,rotateControl:!1},a=new google.maps.Map(document.getElementById("map-wrapper"),t);if(google.maps.event.addDomListener(window,"resize",function(){a.setCenter(currentLatLong)}),"custom"==pinOrCustom)var s=new google.maps.MarkerImage(""+pinImage,null,null,null,new google.maps.Size(parseInt(mw_map_vars.markerWidth),parseInt(mw_map_vars.markerHeight)));else var s=new google.maps.MarkerImage(pluginUrl+"/mw-business-details/image/map-marker.png",null,null,null,new google.maps.Size(46,71));var r=new google.maps.Marker({position:e,icon:s,map:a,title:"Click to view in Google Maps"});if("radius"==mapMarker){r.setVisible(!1),radiusCalc=mile*radius,console.log(radiusCalc);var i=new google.maps.Circle({map:a,radius:radiusCalc,fillColor:"#a54fee",strokeColor:"#CD0000",strokeOpacity:0});i.bindTo("center",r,"position")}var l=new google.maps.InfoWindow({content:"<h3>"+addressName+'</h3><p class="map-address">3 Avon Valley Business Park, Chapel Way, St Annes,  Avon Bristol BS4 4EU</p><p><a target="_blank" href="'+googleMapsLink+'"> View on Google Maps</a></p>'});if("show"==mw_map_vars.showInfoWindow?(l.open(a,r),google.maps.event.addListener(r,"click",function(){l.open(a,r)}),a.setCenterWithOffset(currentLatLong,0,-110),google.maps.event.addDomListener(window,"resize",function(){a.setCenterWithOffset(currentLatLong,0,-110)})):google.maps.event.addListener(r,"click",function(){l.open(a,r)}),"colourful"===mapStyle)var o=[{featureType:"road",elementType:"labels",stylers:[{visibility:"simplified"},{lightness:20}]},{featureType:"administrative.land_parcel",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.local",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"road.highway",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"poi",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{hue:"#a1cdfc"},{saturation:30},{lightness:49}]},{featureType:"road.highway",elementType:"geometry",stylers:[{hue:"#f49935"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{hue:"#fad959"}]}];else if("grey"===mapStyle)var o=[{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}];else if("pale"===mapStyle)var o=[{featureType:"water",stylers:[{visibility:"on"},{color:"#acbcc9"}]},{featureType:"landscape",stylers:[{color:"#f2e5d4"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#c5c6c6"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#e4d7c6"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#fbfaf7"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#c5dac6"}]},{featureType:"administrative",stylers:[{visibility:"on"},{lightness:33}]},{featureType:"road"},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"on"},{lightness:20}]},{},{featureType:"road",stylers:[{lightness:20}]}];else if("custom"===mapStyle)var o=jQuery.parseJSON(mw_map_vars.customMap);a.setOptions({styles:o})}function multiMap(){for(var e=new google.maps.Geocoder,t=[],a=0;a<autoAddress.length;a++)t.push({address:autoAddress[a].address});for(var s={zoom:parseInt(mw_map_vars.zoom),minZoom:0,maxZoom:20,zoomControl:!0,zoomControlOptions:{style:google.maps.ZoomControlStyle.SMALL,position:google.maps.ControlPosition.RIGHT_TOP},mapTypeId:google.maps.MapTypeId.ROADMAP,scrollwheel:!1,panControl:!1,panControlOptions:{position:google.maps.ControlPosition.RIGHT_TOP},mapTypeControl:!1,scaleControl:!1,streetViewControl:!1,overviewMapControl:!1,rotateControl:!1},r=new google.maps.Map(document.getElementById("map-wrapper"),s),a=0;a<t.length;a++)e.geocode({address:t[a].address},function(e,t){if(t==google.maps.GeocoderStatus.OK){var a=new google.maps.Marker({map:r,position:e[0].geometry.location,icon:l});i.extend(e[0].geometry.location),r.fitBounds(i)}else alert("Geocode was not successful for the following reason: "+t)});var i=new google.maps.LatLngBounds;if("custom"==pinOrCustom)var l=new google.maps.MarkerImage(""+pinImage,null,null,null,new google.maps.Size(parseInt(mw_map_vars.markerWidth),parseInt(mw_map_vars.markerHeight)));else var l=new google.maps.MarkerImage(pluginUrl+"/mw-business-details/image/map-marker.png",null,null,null,new google.maps.Size(46,71));if("colourful"===mapStyle)var o=[{featureType:"road",elementType:"labels",stylers:[{visibility:"simplified"},{lightness:20}]},{featureType:"administrative.land_parcel",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"landscape.man_made",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"transit",elementType:"all",stylers:[{visibility:"off"}]},{featureType:"road.local",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"road.local",elementType:"geometry",stylers:[{visibility:"simplified"}]},{featureType:"road.highway",elementType:"labels",stylers:[{visibility:"simplified"}]},{featureType:"poi",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"road.arterial",elementType:"labels",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"all",stylers:[{hue:"#a1cdfc"},{saturation:30},{lightness:49}]},{featureType:"road.highway",elementType:"geometry",stylers:[{hue:"#f49935"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{hue:"#fad959"}]}];else if("grey"===mapStyle)var o=[{featureType:"landscape",stylers:[{saturation:-100},{lightness:65},{visibility:"on"}]},{featureType:"poi",stylers:[{saturation:-100},{lightness:51},{visibility:"simplified"}]},{featureType:"road.highway",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"road.arterial",stylers:[{saturation:-100},{lightness:30},{visibility:"on"}]},{featureType:"road.local",stylers:[{saturation:-100},{lightness:40},{visibility:"on"}]},{featureType:"transit",stylers:[{saturation:-100},{visibility:"simplified"}]},{featureType:"administrative.province",stylers:[{visibility:"off"}]},{featureType:"water",elementType:"labels",stylers:[{visibility:"on"},{lightness:-25},{saturation:-100}]},{featureType:"water",elementType:"geometry",stylers:[{hue:"#ffff00"},{lightness:-25},{saturation:-97}]}];else if("pale"===mapStyle)var o=[{featureType:"water",stylers:[{visibility:"on"},{color:"#acbcc9"}]},{featureType:"landscape",stylers:[{color:"#f2e5d4"}]},{featureType:"road.highway",elementType:"geometry",stylers:[{color:"#c5c6c6"}]},{featureType:"road.arterial",elementType:"geometry",stylers:[{color:"#e4d7c6"}]},{featureType:"road.local",elementType:"geometry",stylers:[{color:"#fbfaf7"}]},{featureType:"poi.park",elementType:"geometry",stylers:[{color:"#c5dac6"}]},{featureType:"administrative",stylers:[{visibility:"on"},{lightness:33}]},{featureType:"road"},{featureType:"poi.park",elementType:"labels",stylers:[{visibility:"on"},{lightness:20}]},{},{featureType:"road",stylers:[{lightness:20}]}];else if("custom"===mapStyle)var o=jQuery.parseJSON(mw_map_vars.customMap);r.setOptions({styles:o})}var addressName=mw_map_vars.addressName,long=mw_map_vars["long"],lat=mw_map_vars.lat,googleMapsLink=mw_map_vars.googleMapsLink,mapStyle=mw_map_vars.mapStyle,mapMarker=mw_map_vars.mapMarker,pinOrCustom=mw_map_vars.pin,pinImage=mw_map_vars.pinImage,radius=mw_map_vars.radiusDistance,mile=1609.344;pluginUrl=mw_map_vars.pluginUrl,autoAddress=mw_map_vars.autoAddress,jQuery(document).ready(function($){function e(){var e=$("#map-wrapper"),t=$(window).height(),a=e.offset().top,s=$(window).scrollTop(),r=a-t;e.length>0&&parseInt(s)>parseInt(r)&&e.children().length<1&&(long||lat?staticMap():"string"!=typeof autoAddress?multiMap():singleMap())}$(window).scroll(function(){e()}),e()});
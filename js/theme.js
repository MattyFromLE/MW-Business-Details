jQuery(document).ready(function( $ ){


	// custom uploader
    var custom_uploader;
 
    $('.uploadButton').click(function(e) {
 
        e.preventDefault();

        $(this).addClass("uploadActive");
 
		//stop custom uploader from instantiating more than twice...
		//If the uploader object has already been created, reopen the dialog
        /*if (custom_uploader) {
            custom_uploader.open();
            return;
        }*/
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        var myinput = $(this).attr('id');
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function( ) {

            attachment = custom_uploader.state().get('selection').first().toJSON();

            if ( $('.uploadButton').hasClass("uploadActive") ) {

                $(".uploadActive").parent().find('input.imageUrl').val(attachment.url);
                $(".uploadActive").parent().find('input.imageSrc').val(attachment.id);

                // console.log(attachment.sizes[ { 'medium': 'height' } ]);

            }

        });
 
        //Open the uploader dialog
        custom_uploader.open();
 
    });

    // ======================================================================
    // TAB FUNCTIONALITY
    // switches containers in the backend to go between sections
    // ======================================================================

    $("h2 a:first").addClass("nav-tab-active");
    $(".postbox:first").delay(250).fadeIn(250);

    $("h2 a").click(function(){

    	var tabMatch = $(this).attr("class").split(' ')[0];

    	// console.log(tabMatch)

    	$(this).addClass("nav-tab-active").siblings().removeClass("nav-tab-active");
    	$("#"+ tabMatch).fadeIn(250).siblings().fadeOut(0);

    });

    // ======================================================================
    // GOOGLE MAPS
    // checks the select for two variables, shows/hides corresponding format
    // ======================================================================

        function pinOrRadius(){

            var pinOrRadius = $("select#mapMarker").find(":selected").val();

            if ( pinOrRadius === "pin" ) {

                $(".pin").fadeIn(250);
                $(".radius").fadeOut(0);

            } else if ( pinOrRadius === "radius" ) {

                $(".pin").fadeOut(250);
                $(".radius").fadeIn(0);

            }

        }

    // ======================================================================
    // MAP STYLE
    // checks map style select button
    // ======================================================================

        function mapStyle(){

            var mapStyle = $("select#mapStyle").find(":selected").val();

            if ( mapStyle === "custom" ) {

                $(".custom-map").fadeIn(250);

            } else {

                $(".custom-map").fadeOut(250);

            }

        }

        $("select#mapMarker").change(function(){

            pinOrRadius();

        });

        $("select#mapStyle").change(function(){

            mapStyle();

        });

        // ======================================================================
        // DEFAULT PIN OR CUSTOM
        // checks if default pin or custom pin wanted
        // ======================================================================

        function defaultOrCustomPin() {

            var defaultOrCustomPin = $("select#pin").find(":selected").val();

            if ( defaultOrCustomPin === "custom" ) {

                $(".defaultOrCustomPin").each(function( i ){

                    $(this).fadeIn(100);

                });

            } else { 

                $(".defaultOrCustomPin").each(function( i ){

                    $(this).fadeOut(100);

                });
            }

        }

        $("select#pin").change(function(){

            defaultOrCustomPin();

        });

        defaultOrCustomPin();
        pinOrRadius();
        mapStyle();

    // ======================================================================
    // OPENING TIMES
    // checks the select for two variables, shows/hides corresponding format
    // ======================================================================

    	function openingTime(){

    		var openingOption = $("select#openingTimeFormat").find(":selected").val();

    		$(".times").fadeIn(250);

    		if ( openingOption === "monFri" ) {

    			$(".monFri, .weekend").fadeIn(250);
    			$(".weekdays, .twentyfour").fadeOut(0);

            } else if ( openingOption === "everyday" ) {

                $(".monFri, .twentyfour").fadeOut(250);
                $(".weekdays, .weekend").fadeIn(0);

            } else if ( openingOption === "twentyfour" ) {

                $(".monFri, .weekdays, .weekend").fadeOut(250);
                $(".twentyfour").fadeIn(0);

            }

    	}

        $("select#openingTimeFormat").change(function(){

        	openingTime();

        });

        openingTime();

    // ======================================================================
    // Second Address
    // checks if second address checkbox is checked
    // ======================================================================

    function secondAddress() {

        var checkbox = $("input#secondAddress");

        if ( checkbox.is(":checked") ) { 

            $(".secondAddress").each(function( i ){

                $(this).stop().delay( i * 225 ).fadeIn(250);

            });

        } else { 

            $(".secondAddress").stop().fadeOut(250);

        }

    }

    $("input#secondAddress").click(function(){

        secondAddress();

    });

    secondAddress();

});
<?php 

class mw_business_details_shortcodes {

	public function __construct() {
		$this->register_shortcodes();
		add_action('wp_head', array(&$this, 'mw_scripts'), 6);  
		add_action('wp_head', array(&$this, 'mw_tracking'));  
		// add_action('wp_head', array(&$this, 'mw_svgToPng')); 
	}

	/*---------------------------------------------------------------------------
	Shortcodes
	---------------------------------------------------------------------------*/

	public function register_shortcodes(){
		
	   add_shortcode('companyLogo', array(&$this, 'mwCompanyLogo'));
	   add_shortcode('contactPage', array(&$this, 'mwContactPage'));
	   add_shortcode('addressSchema', array(&$this, 'mwAddressSchema'));
	   add_shortcode('secondAddress', array(&$this, 'mwSecondAddress'));
	   add_shortcode('socialLinks', array(&$this, 'mwSocialLinks'));
	   add_shortcode('mainNumber', array(&$this, 'mwMainNumber'));
	   add_shortcode('altNumber', array(&$this, 'mwAltNumber'));
	   add_shortcode('faxNumber', array(&$this, 'mwFaxNumber'));
	   add_shortcode('email', array(&$this, 'mwEmail'));
	   add_shortcode('companyName', array(&$this, 'mwCompanyName'));
	   add_shortcode('companyNumber', array(&$this, 'mwCompanyNumber'));
	   add_shortcode('mapWrapper', array(&$this, 'mwMapWrapper'));
	   add_shortcode('openingTimes', array(&$this, 'mwOpeningTimes'));

	}

	/*---------------------------------------------------------------------------
	Company Logo
	---------------------------------------------------------------------------*/

	public function mwCompanyLogo() {

		$logoID = get_option('business_logo_id');
		$logoSrc = wp_get_attachment_image_src( $logoID, 'mw-logo-size' );

		if ( $logoID ) {

			$html = ' ';

			$html .= '<div id="logo" class="logo" itemscope itemtype="http://schema.org/Organization">';

			$html .= '<a itemprop="url" href="'. get_bloginfo('url') .'" rel="home" >';
			
			$html .= '<img itemprop="logo" src="'. $logoSrc[0] .'" id="mainlogo" alt="'.get_bloginfo("name").' Logo" />';
			
			$html .= '</a>';

			$html .= '</div>';

			return $html;

		}

	}


	/*---------------------------------------------------------------------------
	Company Name
	---------------------------------------------------------------------------*/


	public function mwCompanyName() {

		$defaultName = get_bloginfo("name");
	    $customName = get_option( "company_name" );

	    if ( $customName ) { 

	    	$companyName = '<span>'.$customName.'</span>'; 

	    } else { 

	    	$companyName = '<span>'.$defaultName.'</span>'; 

	    }
	   
	    return $defaultName;

	}


	/*---------------------------------------------------------------------------
	Company Number
	---------------------------------------------------------------------------*/


	public function mwCompanyNumber() {

		$companyNumber = get_option( "company_no" );

		if ( $companyNumber ) {
	 
			$html = ' ';
			$html .= '<p>Company Number: '. $companyNumber .'</p>';

			return $html;

		}


	}


	/*---------------------------------------------------------------------------
	Google Maps
	---------------------------------------------------------------------------*/


	public function mw_scripts() {

		if ( get_option("mapShow") == "show" ) {

			$defaultName = get_bloginfo("name");
		    $customName = get_option( "company_name" );

		    if ( $customName ) { 
		    	$companyName = $customName; 
		    } else { 
		    	$companyName = $defaultName; 
		    }
		
			$mapShowPage = get_option( "mapShowPage", array() );

			foreach ($mapShowPage as $page) {
			  
			  $pageID[] = $page;

			}

			if ( is_page( $pageID ) ) {

				// Enqueue google API for Google Maps
				wp_register_script( 'add-google-script', 'https://maps.googleapis.com/maps/api/js?sensor=false' );
				wp_enqueue_script( 'add-google-script' );  
				wp_register_script( 'maps_scripts', plugins_url('js/min/maps-min.js', __FILE__ ),'','', '' );
				wp_enqueue_script( 'maps_scripts' );				

				// enqueue map styles 
				wp_enqueue_style( 'mw-frontend-theme', plugins_url('css/mw-business-details-frontend.css', __FILE__ ),'', null );

			}

			// plugin url
			$pluginUrl = plugins_url();

			// address mame
			$addressName = $companyName;

			// map position
			$lat = get_option( "lat" );
			$long = get_option( "long" );
			$zoom = get_option( "zoom" );

			// infowindow
			$showInfoWindow = get_option( "showInfoWindow" );

			// map style
			$customMap = get_option( "customMap" );
			$style = get_option( "mapStyle" );

			// marker
			$mapMarker = get_option( "mapMarker" );
			$pin = get_option( "pin" );
			$pinImage = get_option( "pinImage" );
			$markerWidth = get_option( "markerWidth" );
			$markerHeight = get_option( "markerHeight" );

			// google plus link
			$googleMapsLink = get_option( "googleMapsLink" );


			// var_dump( $pinImage );

			// radius
			$radiusDistance = get_option('radiusDistance');

			if ( $addressName || $lat || $long || $zoom || $customMap || $style || $mapMarker || $pinImage || $radiusDistance || $googleMapsLink ) { 


				wp_localize_script('maps_scripts', 'mw_map_vars', array(

							// plugin url
							'pluginUrl' => __( $pluginUrl, 'mw-business-details' ),

							// address name
							'addressName' => __( $addressName, 'mw-business-details' ),

							// map position
							'lat' => __( $lat, 'mw-business-details'),
							'long' => __( $long, 'mw-business-details'),
							'zoom' => __( $zoom, 'mw-business-details'),

							// map style
							'customMap' => $customMap,
							'mapStyle' => __( $style, 'mw-business-details' ),

							// show info window
							'showInfoWindow' => __( $showInfoWindow, 'mw-business-details' ),

							// marker
							'mapMarker' => __( $mapMarker, 'mw-business-details' ),
							'markerWidth' => __( $markerWidth, 'mw-business-details' ),
							'markerHeight' => __( $markerHeight, 'mw-business-details' ),
							'markerHeight' => __( $markerHeight, 'mw-business-details' ),
							'pin' => $pin,
							'pinImage' => $pinImage,

							// radius
							'radiusDistance' => __( $radiusDistance, 'mw-business-details' ),

							// google map link
							'googleMapsLink' => __( $googleMapsLink, 'mw-business-details' ),

						) );

			}

		}

	}

	public function mwMapWrapper(){
		if ( get_option("mapShow") == "show" ) {
			// map div
			$html = '<div id="map-wrapper"></div>';

			return $html;	
		}
	}


	/*---------------------------------------------------------------------------
	Tracking JS
	---------------------------------------------------------------------------*/

	public function mw_tracking(){

		$tracking = get_option( 'autoTracking' );

		// var_dump($tracking);

		if ( $tracking !== "1" ) {

			wp_register_script( 'tracking_scripts', plugins_url('/js/min/tracking-min.js', __FILE__ ),'','', '' );
			wp_enqueue_script( 'tracking_scripts' );

			$showTrackingAlert = get_option( 'showTrackingAlert' ); //var_dump($showTrackingAlert);

					wp_localize_script ('tracking_scripts', 'mw_tracking_vars', array(

						// plugin url
						'showTrackingAlert' => __( $showTrackingAlert, 'mw-business-details' )

					)

				);

			}

		}


	/*---------------------------------------------------------------------------
	SVG to PNG // when we drop ie8
	---------------------------------------------------------------------------*/

	// public function mw_svgToPng(){

	// 	echo '<!--[if lt IE 9]>

	// 	    <script src="'. plugins_url('/mw-business-details/js/min/svg-to-png-min.js') .'"></script>

	// 	<![endif]-->';

	// }


	/*---------------------------------------------------------------------------
	Social Links
	---------------------------------------------------------------------------*/

	public function mwSocialLinks( $atts ) {
			
		$defaultName = get_bloginfo( "name" );
		$companyName = get_option( "company_name" );
		if ( $companyName ) { $defaultName = $companyName;};
		
		if ( isset( $atts['title'] ) ) {

			$mwTitle = $atts['title'];

		}

		// yoast variables
		$yoastSocial = get_option('wpseo_social'); 
		$yoastFacebook = $yoastSocial['facebook_site'];
		$yoastTwitter = $yoastSocial['twitter_site'];
		$yoastGooglePlus = $yoastSocial['plus-publisher'];

		// if yoast facebook option is being used
		if ( $yoastFacebook ) {

			$mwFacebook = $yoastFacebook;

		} else { 

			$mwFacebook = get_option('facebook');

		}

		// if yoast twitter option is being used
		if ( $yoastTwitter ) {

			$mwTwitter = $yoastTwitter;

		} else { 

			$mwTwitter = get_option('twitter');

		}

		// if yoast g-plus option is being used
		if ( $yoastGooglePlus ) {

			$mwGooglePlus = $yoastGooglePlus;

		} else { 

			$mwGooglePlus = get_option('googlePlus');

		}

		// not included in yoast anyway
		$mwLinkedIn = get_option('linkedIn');

		if ( $atts['class'] ) { 

			$containerClass = $atts['class']; 

		} else { 

			$containerClass = ''; 

		};

		$html = ' ';
		// social
		if ( $mwTwitter || $mwFacebook || $mwLinkedIn || $mwGooglePlus ) { 

		$html .= '<div class="mw-business-details '. $containerClass .'">'; 

		if ( $mwTitle ) {

			$html .= '<p class="h3 schemaTitle">'.$mwTitle.'</p>';

		}

		$html .= '<ul class="social-methods" id="'.$atts["id"].'-social-links">';

			if ( $mwTwitter ) { $html .= '<li><a target="_blank" class="twitter" href="'.$mwTwitter.'" title="View '.$defaultName.' on Twitter">  <i class="fa fa-twitter"></i> </a></li>'; }

			if ( $mwFacebook ) { $html .= '<li><a target="_blank" class="facebook" href="'.$mwFacebook.'" title="View '.$defaultName.' on Facebook"> <i class="fa fa-facebook"></i> </a></li>'; }

			if ( $mwLinkedIn ) { $html .= '<li><a target="_blank" class="linkedIn" href="'.$mwLinkedIn.'" title="View '.$defaultName.' on LinkedIn">  <i class="fa fa-linkedin"></i>  </a></li>'; }

			if ( $mwGooglePlus) { $html .= '<li><a target="_blank" class="googleplus" href="'.$mwGooglePlus.'" title="View '.$defaultName.' on Google Plus">  <i class="fa fa-google-plus"></i>  </a></li>'; }
							
		$html .= '</ul></div> ';

		}

		return $html;
			
	}

	/*---------------------------------------------------------------------------
	Full Address Schema
	---------------------------------------------------------------------------*/

	public function mwAddressSchema( $atts ) {

			$defaultName = get_bloginfo( "name" );
			$companyName = get_option( "company_name" );
			// dynamic naming
			if ( $companyName ) { $defaultName = $companyName; };
			$businessType = get_option( "businessType" );
			$streetAddress = get_option( "street_address" );
			$streetAddressTwo = get_option( "street_address_two" );
			$addressLocality = get_option( "address_locality" );
			$addressRegion = get_option( "address_region" );
			$postCode = get_option( "post_code" );

			$html = '';

			if ( isset($atts["schema"] ) === "show" ) {
				
				$html = '<div  id="'.$atts["id"].'-address" class="mw-business-details" itemscope="" itemtype="http://schema.org/'.$businessType.'">';


				$html .= '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				
				if ( isset($mwTitle) ) {

					$html .= '<p class="h3 schemaTitle">'.$mwTitle.'</p>';

				}

				$html .= '<p itemprop="name"><strong>'.$defaultName.'</strong></p>';
				
				$html .= '<ul class="address">';
				$html .= '<li itemprop="streetAddress">'.$streetAddress.'</li>';
				$html .= '<li itemprop="streetAddress">'.$streetAddressTwo.'</li>';
				$html .= '<li itemprop="addressLocality">'.$addressLocality.'</li>';
				$html .= '<li itemprop="addressRegion">'.$addressRegion.'</li>';
				$html .= '<li itemprop="postalCode">'.$postCode.'</li>';
				$html .= '</ul></div>';
				$html .= '</div>';

			} else {

				// address
				$html .= '<div class="mw-business-details">';
				
				if ( isset($mwTitle) ) {

					$html .= '<p class="h3 schemaTitle">'.$mwTitle.'</p>';

				}
				
				$html .= '<ul class="address">';
				$html .= '<li><strong>'.$defaultName.'</strong></li>';
				$html .= '<li>'.$streetAddress.'</li>';
				$html .= '<li>'.$addressLocality.'</li>';
				$html .= '<li>'.$addressRegion.'</li>';
				$html .= '<li>'.$postCode.'</li>';
				$html .= '</ul>';
				$html .= '</div>';

			}

			//closing div
			return $html;

	}

	/*---------------------------------------------------------------------------
	Second Address
	---------------------------------------------------------------------------*/

	public function mwSecondAddress( ) {

		$addressName = get_option("second_address_name");
		$streetAddress = get_option( "second_street_address" );
		$streetAddressTwo = get_option( "second_street_address_two" );
		$addressLocality = get_option( "second_address_locality" );
		$addressRegion = get_option( "second_address_region" );
		$postCode = get_option( "second_post_code" );
		$showSecondAddress = get_option('secondAddress');
		$businessType = get_option( "businessType" );

		// var_dump($showSecondAddress);

		if ( $showSecondAddress === "1" ) {

			$html = ' ';

			if ( $addressName || $streetAddress || $addressLocality || $addressRegion || $postCode ){ 

				$html = '<div  id="'.$atts["id"].'-address" class="mw-business-details" itemscope="" itemtype="http://schema.org/'.$businessType.'">';

				$html .= '<p class="heading">'. $addressName .'</p>';
				//address
				$html .= '<ul class="address">';

				$html .= '<li>'.$streetAddress.'</li>';
				$html .= '<li>'.$streetAddressTwo.'</li>';
				$html .= '<li>'.$addressLocality.'</li>';
				$html .= '<li>'.$addressRegion.'</li>';
				$html .= '<li>'.$postCode.'</li>';
				$html .= '</ul>';

				//closing div
				$html .= '</div>';

			}

			return $html;

		}

	}


	/*---------------------------------------------------------------------------
	Main Number
	---------------------------------------------------------------------------*/

	public function mwMainNumber( $atts ) {

		$telNumber = get_option( "tel_no" );
		$telNoSpace = preg_replace('/[\s-]+/', '', $telNumber);
		$telNoBrackets = str_replace(array( '(', ')' ), '', $telNoSpace);
		
		$html = ' ';
		$html .= '<a href="tel:'.$telNoBrackets.'" title="Call Today" id="'.$atts["id"].'-phone">'.$telNumber.'</a>';
		return $html;

	}


	/*---------------------------------------------------------------------------
	Fax Number
	---------------------------------------------------------------------------*/

	public function mwFaxNumber( ) {

		$fax_no = get_option( "fax_no" );
		$html = ' ';
		$html .= '<li>'.$fax_no.'</li>';
		return $html;

	}

	/*---------------------------------------------------------------------------
	Alternative Number
	---------------------------------------------------------------------------*/


	public function mwAltNumber( $atts ) {

		$altNumber = get_option( "alt_no" );
		$altNoSpace = preg_replace("/[\s-]+/", "", $altNumber);
		$html = ' ';
		$html = '<a href="tel:'.$altNoSpace.'" title="Call Today" id="'.$atts["id"].'-alt-phone">'.$altNumber.'</a>';
		return $html;
		
	}

	/*---------------------------------------------------------------------------
	E-Mail
	---------------------------------------------------------------------------*/


	public function mwEmail( $atts ) {

		// address
		$defaultEmail = get_bloginfo( "email" );
		$customEmail = get_option( "e-mail_address" );
		
		if ( $customEmail ) {

			$email = $customEmail;

		} else { 

			$email = $defaultEmail;

		}

		$html = ' ';
		$html .= '<a href="mailto:'.$email.'" title="E-Mail Us" id="'.$atts["id"].'-email">'.$email.'</a>';
		return $html;
		
	}


	/*---------------------------------------------------------------------------
	Contact Page Schema
	---------------------------------------------------------------------------*/


	public function mwContactPage( $atts ) {
		
			// company details
			$defaultName = get_bloginfo( "name" );
			$companyName = get_option( "company_name" );
			
			if ( $companyName ) {

				$defaultName = $companyName;

			};

			// other 
			$businessType = get_option( "businessType" );
			$contactPageText = get_option( "mw-contact-text" );
			if ( isset( $atts['title'] ) ) {

				$mwTitle = $atts['title'];

			}

			// address
			$businessType = get_option( "businessType" );
			$streetAddress = get_option( "street_address" );
			$streetAddressTwo = get_option( "street_address_two" );
			$addressLocality = get_option( "address_locality" );
			$addressRegion = get_option( "address_region" );
			$postCode = get_option( "post_code" );


			// contact numbers
			$mainNumber = get_option( "tel_no" );
			$mainNumberNoSpace = preg_replace("/[\s-]+/", "", $mainNumber);
			$mainNumberNoBrackets = str_replace( array( '(', ')' ), '', $mainNumberNoSpace);
			$faxNumber = get_option( "fax_no" );
			$altNumber = get_option( "alt_no" );
			$altNoSpace = preg_replace("/[\s-]+/", "", $altNumber);
			$emailAddress = get_option( "e-mail_address" );

			$html = ' ';
				
			$html = '<div id="'.$atts["id"].'-address" class="mw-business-details" itemscope="" itemtype="http://schema.org/'.$businessType.'">';

				// telephones
				if ( $mainNumber || $altNumber || $faxNumber ) {

					if ( $mwTitle ) {

						$html .= '<p class="schemaTitle h3">'.$mwTitle.'</p>';

					}

					$html .= '<ul class="numbers">';

					$html .= '<li><a itemprop="telephone" href="tel:'.$mainNumberNoBrackets.'" title="Call Today" id="contact-phone">'.$mainNumber.'</a></li>';
				
					if ($faxNumber) {

						$html .= '<li>'.$faxNumber.'</li>';
					}
				
					if ($altNumber) {
					
						$html .= '<li><a href="tel:'.$altNoSpace.'" title="Call Today" id="contact-mobile-phone">'.$altNumber.'</a></li>';
					
					}

					if ($emailAddress) {
					
						$html .= '<li><a href="mailto:'.$emailAddress.'" title="E-Mail Us Today" id="email">' .$emailAddress.'</a></li>';
					
					}
					
					$html .= '</ul>';

				}

				// address
				$html .= '<div itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">';
				
					$html .= '<p class="h3 schemaTitle">Address</p>';
					$html .= '<p itemprop="name"><strong>'.$defaultName.'</strong></p>';
					
					$html .= '<ul class="address">';
					$html .= '<li itemprop="streetAddress">'.$streetAddress.'</li>';
					$html .= '<li itemprop="streetAddress">'.$streetAddressTwo.'</li>';
					$html .= '<li itemprop="addressLocality">'.$addressLocality.'</li>';
					$html .= '<li itemprop="addressRegion">'.$addressRegion.'</li>';
					$html .= '<li itemprop="postalCode">'.$postCode.'</li>';
					$html .= '</ul>';

				$html .= '</div>';

				// social
				$html .= $this->mwSocialLinks( $atts=array( 'title' => 'Socialise', 'id' => $atts['id'], 'class' => 'social-methods' ) );

				// opening times
				$html .= $this->mwOpeningTimes( $atts=array( 'title' => 'Opening Times', 'schema' => 'hide' ) );

			// closing div
			$html .= '</div>';

		return $html;
		
	}

	/*---------------------------------------------------------------------------
	Opening Times
	---------------------------------------------------------------------------*/

	public function mwOpeningTimes( $atts ) {
		
		// set up vars
		$businessType = get_option( "businessType" );
		$openingTimesFormat = get_option( "openingTimeFormat" );
		$twentyFourSeven = get_option( "twentyFourSeven" );
		$monFriTimes = get_option( "monFriTimes" );
		$monday = get_option( "monday" );
		$tuesday = get_option( "tuesday" );
		$wednesday = get_option( "wednesday" );
		$thursday = get_option( "thursday" );
		$friday = get_option( "friday" );
		$saturday = get_option( "saturday" );
		$sunday = get_option( "sunday" );
		if ( isset( $atts['title'] ) ) {

			$mwTitle = $atts['title'];

		}

		$html = ' ';

		if ( $atts["schema"] === "show" ) {

			$html .= '<div class="mw-business-details opening-times" itemscope="" itemtype="http://schema.org/'.$businessType.'">';

		} else {

			$html .= '<div class="mw-business-details opening-times" >';

		}

		if ( $mwTitle ) {

			$html .= '<p class="h3 schemaTitle">'.$mwTitle.'</p>';

		}

		if ( $openingTimesFormat || $monFriTimes || $monday || $tuesday || $wednesday || $thursday || $friday || $saturday || $sunday ) {

			$html .= '<ul>';

			if ( $openingTimesFormat === 'monFri' ) {

				if ( $monFriTimes ) {
					$html .= '<li><meta itemprop="openingHours" content="Mo-Fr '.$monFriTimes.'" ><strong>Monday - Friday</strong>: '.$monFriTimes.'</li>';
					if ( $saturday ) {
						$html .= '<li><meta itemprop="openingHours" content="Sa '.$saturday.'" ><strong>Saturday</strong>: '.$saturday.'</li>';
					} else { 
						$html .= '<li><strong>Saturday</strong>: Closed</li>'; 
					}
					
					if ( $sunday ) {
						$html .= '<li><meta itemprop="openingHours" content="Su '.$sunday.'" ><strong>Sunday</strong>: '.$sunday.'</li>';
					} else { 
						$html .= '<li><strong>Sunday</strong>: Closed</li>';
				 	}

				}

			} else if ( $openingTimesFormat === 'everyday' ) {
				
				if ( $monday ) {
					$html .= '<li><meta itemprop="openingHours" content="Mo '.$monday.'" ><strong>Monday</strong>: '.$monday.'</li>';
				} else { 
					$html .= '<li><strong>Monday</strong>: Closed</li>'; 
				}
				
				if ( $tuesday ) {
					$html .= '<li><meta itemprop="openingHours" content="Tu '.$tuesday.'" ><strong>Tuesday</strong>: '.$tuesday.'</li>';
				} else {
					$html .= '<li><strong>Tuesday</strong>: Closed</li>'; 
				}
				
				if ( $wednesday ) {
					$html .= '<li><meta itemprop="openingHours" content="We '.$wednesday.'" ><strong>Wednesday</strong>: '.$wednesday.'</li>';
				} else { 
					$html .= '<li><strong>Wednesday</strong>: Closed</li>'; 
				}
				
				if ( $thursday ) {
					$html .= '<li><meta itemprop="openingHours" content="Th '.$thursday.'" ><strong>Thursday</strong>: '.$thursday.'</li>';
				} else { 
					$html .= '<li><strong>Thursday</strong>: Closed</li>'; 
				}
				
				if ( $friday ) {
					$html .= '<li><meta itemprop="openingHours" content="Fr '.$friday.'" ><strong>Friday</strong>: '.$friday.'</li>';
				} else { 
					$html .= '<li><strong>Friday</strong>: Closed</li>'; 
				}

				if ( $saturday ) {
					$html .= '<li><meta itemprop="openingHours" content="Sa '.$saturday.'" ><strong>Saturday</strong>: '.$saturday.'</li>';
				} else { 
					$html .= '<li><strong>Saturday</strong>: Closed</li>'; 
				}
			
				if ( $sunday ) {
					$html .= '<li><meta itemprop="openingHours" content="Su '.$sunday.'" ><strong>Sunday</strong>: '.$sunday.'</li>';
				} else { 
					$html .= '<li><strong>Sunday</strong>: Closed</li>'; 
				}

			} else if ( $openingTimesFormat === "twentyfour" ) { 

				if ( $twentyFourSeven ) {
					$html .= '<li><meta itemprop="openingHours" content="Mo-Su" ><strong>'.$twentyFourSeven.'</strong></li>';
				}
			}
	 
			$html .= '</ul>';

		}

		$html .= '</div>';

		return $html;

	}

}
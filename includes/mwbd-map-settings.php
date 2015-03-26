<div class="wrap"><?php screen_icon(); ?><h2>  <?php bloginfo("name");?>  Business Details</h2><form method="post" action="options.php">  <?php settings_fields( 'mwbd_map_settings' ); do_settings_sections('mwbd_map_settings'); ?>  <div class="metabox-holder">    <!-- GOOGLE MAP SETTINGS -->    <div class="section" id="googleMaps">        <div class="inside">          <h3>Google Map Settings</h3>            <table class="form-table postbox">              <tbody>                            <tr>                <th>Tip</th>                <td>Use this section, to complete your map settings.</td>              </tr>              <tr valign="top" class="address">                <th scope="row">Google Map Pin</th>                <td>                <?php                     $businessAddresses = get_option('business_address');                    $addressChoice = get_option('addressChoice');                    $addressNumber = count($businessAddresses);                    echo '<select name="addressChoice" id="addressChoice">';                    foreach ( $businessAddresses as $businessAddress ) {                      $addressName = $businessAddress['address_name'];                      $addressNameSlug = str_replace( ' ', '-', $addressName );                      $addressNameSlug = strtolower($addressNameSlug);                        if ( $addressNameSlug == $addressChoice ) {                          $selected = 'selected';                        } else {                          $selected = '';                        }                        echo '<option value="'.$addressNameSlug.'" '. $selected .' >'. ucwords($addressName) .'</option>';                    }                      if ( $addressNumber > 1 ) {                      if ( $addressChoice == 'all' ) {                        $selected = 'selected';                      } else {                        $selected = '';                      }                      echo '<option value="all" '. $selected .' >Show All</option>';                    }                    echo '</select>';                    ?>                  <p class="description">Which address do you want to show on the map?</p></td>              </tr>              <tr class="latlong">                <th scope="row">Latitude / Longitude</th>                                  <td>                    <input type="text"  class="regular-text" name="lat" value="<?php echo get_option('lat'); ?>" placeholder="Latitude" />                    <input type="text"  class="regular-text" name="long" value="<?php echo get_option('long'); ?>" placeholder="Longitude" />                    <p class="description">Completing the above fields will override automatic address location.</p>                  </td>              </tr>              <tr valign="top" class="address">                <th scope="row">Map.js Enqueuing</th>                <td>                                <select multiple="multiple" name="mapShowPage[]" id="mapShowPage">                                      <?php                   $args = array(                      'post_type' => 'page',                      'post_status' => 'publish'                  );                  $pages = get_pages( $args );                  foreach ( $pages as $page ) {                    // find array of page ids                    $mapShowPage = get_option( 'mapShowPage', array() );                      foreach ($mapShowPage as $pageID) {                                  $selectedPages[] = $pageID;                      }                      var_dump($selectedPages);                                         $pageOption = '<option ';                     if ( in_array(  $page->ID, $selectedPages ) ) {                          $pageOption .= 'selected="selected"';                     }                    $pageOption .= 'value="'. $page->ID .'">';                    $pageOption .= $page->post_title;                    $pageOption .= '</option>';                    echo $pageOption;                  }                  ?>                </select>                <?php $mapShowPage = get_option( "mapShowPage", array() );                                ?>                <p class="description">It's important to only use Google Map API on pages that you're showing your map. Press CTRL, or CMD and click on the relevant pages.</p></td>              </tr>              </tbody>          </table>              <h3>Google Map Options</h3>                <table class="form-table postbox">                  <tbody>              <tr>                <th scope="row">Map Zoom Level</th>                <td><input type="text"  class="regular-text" name="zoom" value="<?php echo get_option('zoom'); ?>" placeholder="0 - 20" />                  <p class="description">Map Zoom.</p></td>              </tr>              <tr>                <th scope="row">Google Maps Link</th>                <td><input type="text"  class="regular-text" name="googleMapsLink" value="<?php echo get_option('googleMapsLink'); ?>" />                  <p class="description">Google Map Link (source from maps.google.com).</p></td>              </tr>              <tr>              <tr>                <th scope="row">Google Maps InfoWindow</th>                <td><select name="showInfoWindow" id="showInfoWindow">                      <option value="none">-- Select --</option>                      <option value="show" <?php if ( get_option('showInfoWindow') == 'show' ) { echo 'selected'; }; ?>>Show</option>                      <option value="hide" <?php if ( get_option('showInfoWindow') == 'hide' ) { echo 'selected'; }; ?>>Hide</option>                                       </select>                  <p class="description">Select show, to show the InfoWindow, selecting hide - will show the window when user clicks on the <marker class=""></marker></p></td>              </tr>              <tr>                <th scope="row">Marker: Pin or Radius?</th>                <td>                  <select name="mapMarker" id="mapMarker">                      <option value="none">-- Select --</option>                      <option value="pin" <?php if ( get_option('mapMarker') == 'pin' ) { echo 'selected'; }; ?>>Pin</option>                      <option value="radius" <?php if ( get_option('mapMarker') == 'radius' ) { echo 'selected'; }; ?>>Radius</option>                                       </select>                  <p class="description">Choose the style of your map marker.</p>                </td>              </tr>              <tr class="radius">                                <th scope="row">Radius Distance</th>                <td><input type="text"  class="regular-text" name="radiusDistance" value="<?php echo get_option('radiusDistance'); ?>" />                <p class="description">Input your radius, by miles.</p></td>              </tr>              <tr class="pin">                                <th scope="row">Marker Image Options</th>                <td>                <select name="pin" id="pin">                    <option value="none">-- Select --</option>                    <option value="default" <?php if ( get_option('pin') == 'default' ) { echo 'selected'; }; ?>>Default</option>                    <option value="custom" <?php if ( get_option('pin') == 'custom' ) { echo 'selected'; }; ?>>Custom</option>                                   </select>                <p class="description">Decide if you want to use our default marker, or to upload your own select: "Custom" and use the file uploader below.</p></td>              </tr>              <tr class="defaultOrCustomPin">                  <th scope="row"> Marker Image </th>                                            <td>                  <input id="pinImage" type="text"  class="regular-text imageUrl" size="36" name="pinImage" value="<?php esc_attr_e( get_option('pinImage') ); ?>" />                  <input id="pinImageButton" class="button uploadButton" type="button" value="Upload Pin" />                  <p class="description">Enter a URL or upload an image</p></td>              </tr>              <tr class="defaultOrCustomPin">                <th scope="row"> Marker Image Dimensions </th>                <td>                  <input type="text" class="regular-text dimensions" name="markerWidth" value="<?php echo get_option('markerWidth'); ?>" placeholder="Width" />                  <input type="text" class="regular-text dimensions" name="markerHeight" value="<?php echo get_option('markerHeight'); ?>" placeholder="Height" />                  <p class="description">Choose the size of your marker image.</p>                </td>              </tr>              <tr>                <th scope="row">Google Maps Style</th>                <td>                      <select name="mapStyle" id="mapStyle">                          <option value="none">-- Select --</option>                          <option value="grey" <?php if ( get_option('mapStyle') == 'grey' ) { echo 'selected'; }; ?>>Grey</option>                          <option value="pale" <?php if ( get_option('mapStyle') == 'pale' ) { echo 'selected'; }; ?>>Pale</option>                          <option value="colourful" <?php if ( get_option('mapStyle') == 'colourful' ) { echo 'selected'; }; ?>>Colourful</option>                          <option value="custom" <?php if ( get_option('mapStyle') == 'custom' ) { echo 'selected'; }; ?>>Custom</option>                                               </select>                      <p class="description">Choose the style of your map.</p>                </td>              </tr>              <tr class="custom-map">              <th scope="row">Custom Google Map Style</th>              <td>                <?php                 $content = get_option('customMap');                //wp_editor( $content, 'customMap', array( 'media_buttons' => false, 'textarea_rows' => 5 ) );                ?>                <textarea name="customMap" id="" cols="30" rows="10"> <?php echo $content; ?> </textarea>                  <p class="description">Source style code from resource like: SnazzyMaps.</p>              </td>              </tr>               </tr>                          </tbody>          </table>                <h3>Google Map Preview</h3>                            <table class="form-table postbox">                <tbody>              <tr>                <th>Preview Map</th>                <td>Preview your google map here. <a href="#" class="button ">Preview</a></td>              </tr>            </tbody>          </table>        </div>    </div>    </div>  <?php submit_button('Save Map Settings'); ?></form></div>
<?php 
/**
 * function to integrate with WPML which will display languages as buttons
 */

if( !function_exists("nautica_fnc_wpml_language_buttons") ){
   function nautica_fnc_wpml_language_buttons(){
     if( function_exists( 'icl_get_languages' ) ){
       $languages = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
       if( is_array( $languages ) ){
          
          foreach( $languages as $lang_k=>$lang ){
              if( $lang['active'] ){
                  $active_lang = $lang;
                  unset( $languages[$lang_k] );
              }
          }

          // disabled
          if( count( $languages ) ){
              $lang_status = 'enabled';
          } else {
              $lang_status = 'disabled';
          }
          
          echo '<div class="language wpml-languages quick-button '. $lang_status .'">';
          
              echo '<div class="heading active" href="'. esc_url( $active_lang['url'] ).'" ontouchstart="this.classList.toggle(\'hover\');">';
                  echo '<img src="'. esc_url( $active_lang['country_flag_url'] ) .'" alt="'. esc_attr( $active_lang['translated_name'] ) .'"/>';
                  echo esc_attr( $active_lang['translated_name'] );
                  if( count( $languages ) ) echo '<i class="icon-down-open-mini"></i>';
              echo '</div>';
              
              if( count( $languages ) ){
                  echo '<ul class="wpml-lang-dropdown list">';
                      foreach( $languages as $lang ){
                          echo '<li><a href="'. esc_url( $lang['url'] ) .'"><img src="'. esc_url( $lang['country_flag_url'] ) .'" alt="'. esc_attr( $lang['translated_name'] ) .'"/>'. esc_attr( $lang['translated_name'] ) .'</a></li>';
                      }
                  echo '</ul>';
              }
              
          echo '</div>';
        }
      } 
   }
}
 /**
  * find all header files with prefix name having header-
  */
function nautica_fnc_get_header_layouts(){
    $path = get_template_directory().'/header-*.php';
    $files = glob( $path  );
    $headers = array( '' => esc_html__('Default', 'nautica') );
    if( count($files)>0 ){
        foreach ($files as $key => $file) {
            $header = str_replace( "header-", '', str_replace( '.php', '', basename($file) ) );
            $headers[$header] = esc_html__( 'Header', 'nautica' ) . ' ' .str_replace( '-',' ', ucfirst( $header ) );
        }
    }

    return $headers;
}

/** Find all header files with prefix name having "header-" and push to array as names and keys **/
function nautica_fnc_get_header_layouts_to_array() {
    $path = get_template_directory().'/header-*.php';
    $files = glob( $path  );
    $headers = array();
    if( count($files)>0 ){
        foreach ($files as $key => $file) {
            $header_key = str_replace( "header-", '', str_replace( '.php', '', basename($file) ) );
            $header_name = esc_html__( 'Header', 'nautica' ) . ' ' .str_replace( '-',' ', ucfirst( $header_key ) );
            $headers[$header_key] = $header_name;
        }
        return $headers;
    } else {
        return false;
    }

}
 /**
  * Get list of footer profile as array. they are post from  post type 'footer'
  */
function nautica_fnc_get_footer_profiles(){
    
    $footers_type = get_posts( array('posts_per_page' => -1, 'post_type' => 'footer') );
    $footers = array(  '' => esc_html__('None', 'nautica') );
    foreach ($footers_type as $key => $value) {
        $footers[$value->ID] = $value->post_title;
    }

    wp_reset_postdata();

    return $footers;
}

/**
 * get list of menu group
 */
function nautica_fnc_get_menugroups(){
    $menus       = wp_get_nav_menus( );
    $option_menu = array( '' => '---Select Menu---' );
    foreach ($menus as $menu) {
        $option_menu[$menu->term_id]=$menu->name;
    }
    return $option_menu;
}

/**
 *
 */
function nautica_fnc_cst_skins(){
    $path = NAUTICA_THEME_DIR.'/css/skins/*';
    $files = glob($path , GLOB_ONLYDIR );
    $skins = array( 'default' => 'default' );
    if( count($files) > 0 ){
      foreach ($files as $key => $file) {
          $skin = str_replace( '.css', '', basename($file) );
          $skins[$skin] =  $skin;
      }
    }

    return $skins;
}

/**
 * Footer builder profile is custom post type, its content is shortcode rendering with visual composer 
 *
 * @param $footer 
 * 
 */
function nautica_fnc_render_post_content( $footer ){

  global $nautica_wpopconfig;

	$post = get_post( $footer );
  $nautica_wpopconfig['type'] = 'footer';
	if($post){
    	echo do_shortcode( $post->post_content ); 
  }
  
  $nautica_wpopconfig['type'] = '';

  wp_reset_postdata();	
}


/**
 * create a random key to use as primary key.
 */
if(!function_exists('nautica_fnc_makeid')){
    function nautica_fnc_makeid($length = 5){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}



if(!function_exists('nautica_fnc_excerpt')){
    //Custom Excerpt Function
    function nautica_fnc_excerpt($limit,$afterlimit='[...]') {
        $excerpt = get_the_excerpt();
        if( $excerpt != ''){
           $excerpt = explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = explode(' ', strip_tags(get_the_content( )), $limit);
        }
        if (count($excerpt)>=$limit) {
            array_pop($excerpt);
            $excerpt = implode(" ",$excerpt).' '.$afterlimit;
        } else {
            $excerpt = implode(" ",$excerpt);
        }
        $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
        return strip_shortcodes( $excerpt );
    }
}


function nautica_fnc_get_widget_block_styles(){
   return array(  'default' , 'primary', 'danger' , 'success', 'warning', 'coffe', 'bluesky' );
}


function get_pattern( $text ) {
    $pattern = get_shortcode_regex();
    preg_match_all( "/$pattern/s", $text, $c );
    return $c;
}

function parse_atts( $content ) {
    $content = preg_match_all( '/([^ ]*)=(\'([^\']*)\'|\"([^\"]*)\"|([^ ]*))/', trim( $content ), $c );
    list( $dummy, $keys, $values ) = array_values( $c );
    $c = array();
    foreach ( $keys as $key => $value ) {
        $value = trim( $values[ $key ], "\"'" );
        $type = is_numeric( $value ) ? 'int' : 'string';
        $type = in_array( strtolower( $value ), array( 'true', 'false' ) ) ? 'bool' : $type;
        switch ( $type ) {
            case 'int': $value = (int) $value; break;
            case 'bool': $value = strtolower( $value ) == 'true'; break;
        }
        $c[ $keys[ $key ] ] = $value;
    }
    return $c;
}

function the_shortcodes( &$output, $text, $child = false ) {

    $patts = get_pattern( $text );
    $t = array_filter( get_pattern( $text ) );
    if ( ! empty( $t ) ) {
        list( $d, $d, $parents, $atts, $d, $contents ) = $patts;
        $out2 = array();
        $n = 0;
        foreach( $parents as $k=>$parent ) {
            ++$n;
            $name = $child ? 'child' . $n : $n;
            $t = array_filter( get_pattern( $contents[ $k ] ) );
            $t_s = the_shortcodes( $out2, $contents[ $k ], true );
            $output[ $name ] = array( 'name' => $parents[ $k ] );
            $output[ $name ]['atts'] = parse_atts( $atts[ $k ] );
            $output[ $name ]['original_content'] = $contents[ $k ];
            $output[ $name ]['content'] = ! empty( $t ) && ! empty( $t_s ) ? $t_s : $contents[ $k ];
        }
    }
    return array_values( $output );
}
function un_htmlchars($str) {
    return str_replace ( array ('&lt;', '&gt;', '&quot;', '&amp;', '&#92;', '&#39;' ), array ('<', '>', '"', '&', chr ( 92 ), chr ( 39 ) ), $str );
}

function htmlchars($str) {
    return str_replace ( array ('\"','&', '<', '>', '"', chr ( 39 ) ), array ('"','&amp;', '&lt;', '&gt;', '&quot;', '&#39;' ), $str );
}
function html2txt($document){
    $search = array('@<script[^>]*?>.*?</script>@si',  // Strip out javascript
        '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
        '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
        '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments including CDATA
    );
    $text = preg_replace($search, ' ', $document);
    return $text;
}
function text(&$string) {
    $string = trim($string);
    $string = str_replace("\\'","'",$string);
    $string = str_replace("'","''",$string);
    $string = str_replace('\"',"&quot;",$string);
    $string = str_replace("<", "&lt;", $string);
    $string = str_replace(">", "&gt;", $string);
    return $string;
}
function getwords($str,$num)
{
    $limit = $num - 1 ;
    $str_tmp = '';
    //explode -- Split a string by string
    $arrstr = explode(" ", $str);
    if ( count($arrstr) <= $num ) { return $str; }
    if (!empty($arrstr))
    {
        for ( $j=0; $j< count($arrstr) ; $j++)
        {
            $str_tmp .= " " . $arrstr[$j];
            if ($j == $limit)
            {
                break;
            }
        }
    }
    return $str_tmp.'...';
}

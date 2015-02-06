<?php
/*
Plugin Name: Bible Text Embed
Version: 0.0.1
Plugin URI: http://www.joshuawieczorek.com/wordpress/plugins/bible-embed
Author: Joshua Wieczorek
Author URI: http://www.joshuawieczorek.com
Description: Embed the Bible right into your pages and posts via shortcodes.
*/


/*-----------------------------------------------
 *
 * - Sets the api key
 *
 * Gets, cleans, and stores the api key
 *    
 *-----------------------------------------------*/
add_action( 'init' , function(){
	if( isset( $_POST['bte-biblia-api-key-set'] , $_POST['bte-biblia-api-key'] ) ) {
		$api_key = preg_replace( '/\s+/' , '' ,  $_POST['bte-biblia-api-key'] );
		update_option( 'bte_biblia_api_key' , $api_key );
	}
} );

/*-----------------------------------------------
 *
 * - Bible Text Admin Page
 *
 * Displays admin settings page for the plugin
 *    
 *-----------------------------------------------*/
add_action('admin_menu', function(){
    add_submenu_page( 'options-general.php' , 'Bible Text Embed', 'BibleEmbed', 'administrator', 'bible-text-embed', 'bte_admin_page');
});


/*-----------------------------------------------
 *
 * - Admin Settings Page
 *
 * Displays the form and api key
 *    
 *-----------------------------------------------*/
if( !function_exists( 'bte_admin_page' ) )
{
	function bte_admin_page() 
	{
		$bte_api_key = get_option( 'bte_biblia_api_key' );
		?>
		<div class="wrap">
			<h1>Bible Text Embed</h1>
			<p>In order to utilize this plugin, you will need an API key from Biblia.Com. <a href="http://api.biblia.com/v1/Users/SignIn" target="_blank">Click here to register your API key.</a></p>
			<form method="post">
				<p><label for="bte-biblia-api-key">Biblia.Com API Key</label>: <input type="text" name="bte-biblia-api-key" id="bte-biblia-api-key" value="<?php echo $bte_api_key; ?>"></p>
				<p><input type="submit" name="bte-biblia-api-key-set" value="Set API Key" class="button"></p>
			</form>
			<h2>Shortcode Example</h2>
			<h3>Simple Usage:</h3>
			<p><code>[bible passage="Jn 3:16"]</code></p>
			<h3>Advanced Usage:</h3>
			<p>
				<code>[bible passage="John 3:15-18" version="KJV" shownum="no" 1vpl="no" versesep="div" sepclass="bible-verse"]</code><br><br>
				<b>"passage"</b> is the bible passage that you want to display.<br><br>
				<b>"version"</b> is the bible translation that you want to use (available translations are listed below). Default is KJV.<br><br>
				<b>"shownum"</b> show the verse numbers (yes or no), default is no.<br><br>
				<b>"1vpl"</b> one verse per line (yes or no), default is yes.<br><br>
				<b>"versesep"</b> is the html element that wraps a single verse, default is the "&lt;p&gt;" tag.<br><br>
				<b>"sepclass"</b> is the verse wrapper css class.  
			</p>

			<p><a href="http://api.biblia.com/docs/Available_Bibles" target="_blank" title="Biblia.Com"><img src="<?php echo plugins_url('bible-embed/bibles.png') ?>" alt="Available Bibles"></a></p>
			<p><a href="http://biblia.com" target="_blank" title="Biblia.Com"><img src="http://api.biblia.com/docs/Themes/Biblia/logo.png" alt="Biblia Logo"></a></p>
			<p><em>Bible Text Embed</em> Plugin &copy; <?php echo date( "Y" , time() ) ?> Joshua Wieczorek</p>
		</div>
		<?php
	}
}

/*-----------------------------------------------
 *
 * - Bible Shortcode
 *
 * Displays the requested bible passage
 *    
 *-----------------------------------------------*/
if(!function_exists('bte_bible_shortcode'))
{
    function bte_bible_shortcode( $atts )
    {              
        // Shortcode atts
        $a = shortcode_atts( array(        
            'passage'   => 'gen1:1',
            'version'	=> 'KJV',
            'format'  	=> '1verseline',
            'shownum'	=> 'no',
            '1vpl'		=> 'yes',
            'versesep'	=> 'p',
            'sepclass'	=> ''        
        ), $atts );        
        return bte_get_bible_passage( $a['passage'] , $a['version'] , $a['shownum'] , $a['1vpl'] , $a['versesep'] , $a['sepclass'] );        
    }    
}
add_shortcode( 'bible', 'bte_bible_shortcode' );


/*-----------------------------------------------
 *
 * - Bible Shortcode
 *
 * Displays the requested bible passage
 *    
 *-----------------------------------------------*/
if(!function_exists('bte_get_bible_passage'))
{
	function bte_get_bible_passage( $passage , $version , $shownum , $vpl , $versesep , $sepclass )
	{		
		$api_key = get_option( 'bte_biblia_api_key' );
		$passage = preg_replace( '/\s+/' , '' ,  $passage );
		if( !$api_key ) return 'Invalid API Key!';		
		// Avaiable versions
		$versions 				= array( 'ASV' , 'ARVANDYKE' , 'KJV' , 'LSG' , 'BYZ' , 'DARBY' , 'Elzevir' , 'ITDIODATI1649' , 'EMPHBBL' , 'KJV1900' , 'KJVAPOC' , 'LEB' , 'SCRMORPH' , 'FI-RAAMATTU' , 'RVR60' , 'RVA' , 'bb-sbb-rusbt' , 'eo-zamenbib' , 'TR1881' , 'TR1894MR' , 'SVV' , 'STEPHENS' , 'TANAKH' , 'wbtc-ptbrn' , 'WH1881MR' , 'YLT' ); 
		// If version is not in the array of versions set it to KJV
		if( !in_array( $version, $versions ) ) {
			$version = 'KJV';
		}
		// Request URL
		$url = "http://api.biblia.com/v1/bible/content/$version.js?passage=$passage&style=orationOneVersePerLine&key=$api_key";
		// Curl Methods
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_URL, $url );
		$result = curl_exec($curl);
		curl_close($curl);
		// Replace chars
		$result = str_replace( '–' , '-', $result );
		// Bible Array
		$bible_array = array();
		// Rendered bible
		$bible_rendered = '';
		// JSON decode the json object
		$bible = (array) json_decode( $result , false );
		// If error occurred
		if( !isset( $bible['text'] ) ) return 'Sorry, something went wrong! Please contact support for this plugin!';		
		// Else format text in single line verse
		$bible_array = explode( "\r\n" , $bible['text'] );
		unset($bible_array[0]);
		// Fill the bible rendered variable
		foreach ($bible_array as $verse ) {
			if( $shownum == 'no' ) {
				$verse = preg_replace( '/[0-9]/' , '' , $verse );
			}

			if( $vpl == 'yes' ) {
				$bible_rendered .= '<' . $versesep . '  class="' . $sepclass . '">' . $verse . '</' . $versesep . '>';
			} else {
				$bible_rendered .= $verse ;
			}
		}
		return $bible_rendered;
	}
}



<?php
/**
 * Shakepeers Skin
 *
 * @shakepeers.php
 * @ingroup Skins
 * @author Mark Nightingale (http://marknightingale.net)
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 */

if ( ! defined( 'MEDIAWIKI' ) ) die( "This is an extension to the MediaWiki package and cannot be run standalone." );

$wgExtensionCredits['skin'][] = array(
	'path'        => __FILE__,
	'name'        => 'Shakepeers Skin',
	'url'         => 'http://shakepeers.org',
	'author'      => '[http://marknightingale.net Mark Nightingale',
	'description' => 'MediaWiki skin for Shakepeers using Bootstrap 3',
);

$wgValidSkinNames['shakepeers'] = 'Shakepeers';
$wgAutoloadClasses['SkinShakepeers'] = __DIR__ . '/Shakepeers.skin.php';


$skinDirParts = explode( DIRECTORY_SEPARATOR, __DIR__ );
$skinDir = array_pop( $skinDirParts );

$wgMessagesDirs['shakepeers'] = __DIR__ . '/i18n';

$wgResourceModules['skins.shakepeers'] = array(
	'styles' => array(
		$skinDir . '/vendor/bootstrap/css/bootstrap.min.css'            => array( 'media' => 'all' ),
		$skinDir . '/vendor/google-code-prettify/prettify.css'          => array( 'media' => 'all' ),
		$skinDir . '/style.css'                                         => array( 'media' => 'all' ),
		$skinDir . '/vendor/flatline/style.css'                         => array( 'media' => 'all' ),
		$skinDir . '/vendor/yamm/yamm.css'                              => array( 'media' => 'all' ),
        $skinDir . '/vendor/jansy/jasny-bootstrap.min.css'              => array( 'media' => 'all' ),
		$skinDir . '/print.css'                                         => array( 'media' => 'print' ),
		$skinDir . '/custom.css'                                        => array( 'media' => 'all' ),
        
        
        
	),
	'scripts' => array(
		$skinDir . '/vendor/bootstrap/js/bootstrap.min.js',
		$skinDir . '/vendor/google-code-prettify/prettify.js',
		$skinDir . '/js/jquery.ba-dotimeout.min.js',
		$skinDir . '/vendor/jansy/jasny-bootstrap.min.js',
		$skinDir . '/js/behavior.js',
        $skinDir . '/myscripts.js'
	),
	'dependencies' => array(
		'jquery',
		'jquery.mwExtension',
		'jquery.client',
		'jquery.cookie',
	),
	'remoteBasePath' => &$GLOBALS['wgStylePath'],
	'localBasePath'  => &$GLOBALS['wgStyleDirectory'],
);

if ( isset( $wgSiteJS ) ) {
	$wgResourceModules['skins.shakepeers']['scripts'][] = $skinDir . '/' . $wgSiteJS;
}//end if

if ( isset( $wgSiteCSS ) ) {
	$wgResourceModules['skins.shakepeers']['styles'][] = $skinDir . '/' . $wgSiteCSS;
}//end if

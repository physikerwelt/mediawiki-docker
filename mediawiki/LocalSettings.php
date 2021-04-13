<?php
# This file was automatically generated by the MediaWiki 1.31.1
# installer. If you make manual changes, please keep track in case you
# need to recreate them later.
#
# See includes/DefaultSettings.php for all configurable settings
# and their default values, but don't forget to make changes in _this_
# file, not there.
#
# Further documentation for configuration settings may be found at:
# https://www.mediawiki.org/wiki/Manual:Configuration_settings

# Protect against web entry
if ( !defined( 'MEDIAWIKI' ) ) {
	exit;
}


## Uncomment this to disable output compression
# $wgDisableOutputCompression = true;

$wgSitename = "testwiki";
$wgMetaNamespace = "Testwiki";

## The URL base path to the directory containing the wiki;
## defaults for all runtime URL paths are based off of this.
## For more information on customizing the URLs
## (like /w/index.php/Page_title to /wiki/Page_title) please see:
## https://www.mediawiki.org/wiki/Manual:Short_URL
$wgScriptPath = "";
$wgArticlePath = "/wiki/$1";
$wgUsePathInfo = false;
## The protocol and server name to use in fully-qualified URLs
#$wgServer = "http://localhost";

## The URL path to static resources (images, scripts, etc.)
$wgResourceBasePath = $wgScriptPath;

## The URL path to the logo.  Make sure you change this from the default,
## or else you'll overwrite your logo when you upgrade!
$wgLogo = "$wgResourceBasePath/resources/assets/wiki.png";

## UPO means: this is also a user preference option

$wgEnableEmail = true;
$wgEnableUserEmail = true; # UPO

$wgEmergencyContact = "apache@localhost";
$wgPasswordSender = "apache@localhost";

$wgEnotifUserTalk = false; # UPO
$wgEnotifWatchlist = false; # UPO
$wgEmailAuthentication = true;

## Database settings
$wgDBtype = "mysql";
$wgDBserver = "db";
$wgDBname = "wiki_physikerwelt";
$wgDBuser = "wikiuser";
$wgDBpassword = "wikipassword";

# MySQL specific settings
$wgDBprefix = "";

# MySQL table options to use during installation or update
$wgDBTableOptions = "ENGINE=InnoDB, DEFAULT CHARSET=binary";

## Shared memory settings
$wgMainCacheType = CACHE_NONE;
##$wgMemCachedServers = [];

## To enable image uploads, make sure the 'images' directory
## is writable, then set this to true:
$wgEnableUploads = false;
$wgUseImageMagick = true;
$wgImageMagickConvertCommand = "/usr/bin/convert";

# InstantCommons allows wiki to use images from https://commons.wikimedia.org
$wgUseInstantCommons = true;

# Periodically send a pingback to https://www.mediawiki.org/ with basic data
# about this MediaWiki instance. The Wikimedia Foundation shares this data
# with MediaWiki developers to help guide future development efforts.
$wgPingback = true;

## If you use ImageMagick (or any other shell command) on a
## Linux server, this will need to be set to the name of an
## available UTF-8 locale
$wgShellLocale = "C.UTF-8";

## Set $wgCacheDirectory to a writable directory on the web server
## to make your wiki go slightly faster. The directory should not
## be publically accessible from the web.
#$wgCacheDirectory = "$IP/cache";

# Site language code, should be one of the list in ./languages/data/Names.php
$wgLanguageCode = "en";

$wgSecretKey = "4df29a6b28b4edea4e4e6ac10d465a59a8e110e6eccf0c1ba200bbebb1675327";

# Changing this will log out all existing sessions.
$wgAuthenticationTokenVersion = "1";

# Site upgrade key. Must be set to a string (default provided) to turn on the
# web installer while LocalSettings.php is in place
$wgUpgradeKey = "80ac496ceb6bfdf9";

## For attaching licensing metadata to pages, and displaying an
## appropriate copyright notice / icon. GNU Free Documentation
## License and Creative Commons licenses are supported so far.
$wgRightsPage = ""; # Set to the title of a wiki page that describes your license/copyright
$wgRightsUrl = "https://creativecommons.org/licenses/by/4.0/";
$wgRightsText = "Creative Commons Attribution";
$wgRightsIcon = "$wgResourceBasePath/resources/assets/licenses/cc-by.png";

# Path to the GNU diff3 utility. Used for conflict resolution.
$wgDiff3 = "/usr/bin/diff3";

# The following permissions were set based on your choice in the installer
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['*']['edit'] = false;

## Default skin: you can change the default skin. Use the internal symbolic
## names, ie 'vector', 'monobook':
$wgDefaultSkin = "vector";

# Enabled skins.
# The following skins were automatically enabled:
wfLoadSkin( 'Vector' );


# Enabled extensions. Most of the extensions are enabled by adding
# wfLoadExtensions('ExtensionName');
# to LocalSettings.php. Check specific extension documentation for more details.
# The following extensions were automatically enabled:
wfLoadExtension( 'Cite' );
wfLoadExtension( 'CiteThisPage' );
wfLoadExtension( 'CodeEditor' );
wfLoadExtension( 'ConfirmEdit' );
wfLoadExtension( 'Gadgets' );
wfLoadExtension( 'MultimediaViewer' );
wfLoadExtension( 'ParserFunctions' );
wfLoadExtension( 'PdfHandler' );
wfLoadExtension( 'ReplaceText' );
wfLoadExtension( 'SyntaxHighlight_GeSHi' );
wfLoadExtension( 'WikiEditor' );
wfLoadExtension( 'Math' );

# End of automatically generated settings.
# Add more configuration options below.
$wgMaxShellMemory = 2097152;
$wgMathoidCli = [
	'/srv/mathoid/cli.js',
	'-c',
	'/srv/mathoid/config.yaml',
];

if ( defined( 'MW_DB' ) ) {
	// Set $wikiId from the defined constant 'MW_DB' that is set by maintenance scripts.
	$wikiId = MW_DB;
} elseif ( !isset( $_SERVER['SERVER_NAME'] ) ) {
	die( "Server name not set.\n" );
}

$srv = $_SERVER['SERVER_NAME'];
if ( preg_match( '/([a-z-]+)\.beta\.(physikerwelt\.de|math\.wmflabs.org)/', $srv, $match ) == 1 ) {
	$wgDBname = 'wiki_' . $match[1];
	$wikiId = false;
	$wgDBuser = "wiki";
	$wgServer = 'https://' . $match[1] . '.beta.math.wmflabs.org';
	$wgLanguageCode = $match[1];
	//$wgDefaultUserOptions['math'] = 'source';
	$wgMathoidCli = false;
	$wgDisableTitleConversion = true;
	$wgDisableLangConversion = true;
	$wgEnableWikibaseRepo = true;
	$wgEnableWikibaseClient = true;
	require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
	require_once "$IP/extensions/Wikibase/repo/ExampleSettings.php";
	require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
	require_once "$IP/extensions/Wikibase/client/ExampleSettings.php";
	// $wgWBRepoSettings['siteLinkGroups'] = [ 'wikipedia', 'drmfgroup' ];
	//$wgWBClientSettings['siteGlobalID'] = $match[1];
} else {
	$wikiId = 'test';
	$dbMap = [
		'arq20' => 'arqmath20',
		'wikibase.svc' => 'arqmath20',
		'formulasearchengine.com' => 'enfse',
		'mathml' => 'mathml',
		'drmf' => 'drmfbeta',
		'wiki' => 'physikerwelt',
		'localhost' => 'test',
	];
	foreach ( $dbMap as $urlPart => $id ) {
		if ( strpos( $srv, $urlPart ) !== false ) {
			$wikiId = $id;
			$wgDBname = 'wiki_' . $id;
			break;
		}
	}
	switch ( $wikiId ) {
		case 'arqmath20':
			$wgServer = 'https://arq20.formulasearchengine.com';
			$wgSitename = "ArqMath20";
			$wgLogo = "/images/fse_132.png";
			$wgLogoHD = [
				"1.5x" => "/images/fse_202.png",
				"2x" => "/images/fse_270.png",
			];
			wfLoadExtension( 'Flow' );
			$wgNamespaceContentModels[NS_MAIN] = 'flow-board';
			$wgEnableWikibaseRepo = true;
			$wgEnableWikibaseClient = true;
			require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
			require_once "$IP/extensions/Wikibase/repo/ExampleSettings.php";
			require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
			require_once "$IP/extensions/Wikibase/client/ExampleSettings.php";
			$wgWBRepoSettings['siteLinkGroups'] = [ 'wikipedia' ];
			$wgWBClientSettings['siteGlobalID'] = 'arqmath20';
			// insert site with
			// php addSite.php --filepath=https://arq20.formulasearchengine.com/w/\$1 --pagepath=https://arq20.formulasearchengine.com/wiki/\$1 --language en --interwiki-id arqmath20wiki arqmath20 wikipedia
			$wgMathWikibasePropertyIdDefiningFormula = "P1";
			$wgMathWikibasePropertyIdHasPart = "P2";
			$wgMathWikibasePropertyIdQuantitySymbol = "P3";
			$wgWBRepoSettings['formatterUrlProperty'] = 'P4';
			$wgGroupPermissions['SchuBot']['flow-delete'] = true;
			$wgMetaNamespace = 'Project';
			wfLoadExtension( 'Scribunto' );
			$wgScribuntoDefaultEngine = 'luastandalone';
			$wgMainCacheType = CACHE_MEMCACHED;
			$wgParserCacheType = CACHE_MEMCACHED; # optional
			$wgMessageCacheType = CACHE_MEMCACHED; # optional
			$wgSessionCacheType = CACHE_MEMCACHED; # optional
			$wgMemCachedServers = [ 'memcached:11211' ];
			// To grant sysops permissions to edit interwiki data
			$wgGroupPermissions['sysop']['interwiki'] = true;
			$wgMathWmcServer = true;
			$wgMathDebug = true;
			$wgMathUploadEnabled = true;
			wfLoadExtension( 'MathSearch' );
			wfLoadExtension( 'OAuth' );
			$wgGroupPermissions['sysop']['mwoauthproposeconsumer'] = true;
			$wgGroupPermissions['sysop']['mwoauthmanageconsumer'] = true;
			$wgGroupPermissions['sysop']['mwoauthviewprivate'] = true;
			$wgGroupPermissions['sysop']['mwoauthupdateownconsumer'] = true;
			break;
		case 'physikerwelt':
			$wgServer = 'https://wiki.physikerwelt.de';
			$wgSitename = "PhysikWiki";
			$wgLanguageCode = 'de';
			enableSemantics( 'physikerwelt.de' );
			include_once( "$IP/extensions/SemanticDrilldown/SemanticDrilldown.php" );
			$wgLogo = "/images/PhysikWiki.png";
			$wgHashedUploadDirectory = false;
			$wgDevelopmentWarnings = false;
			// See https://phabricator.wikimedia.org/T273261#6904033
			error_reporting(0);
			break;
		case 'drmfbeta':
			$wgServer = 'https://drmf-beta.wmflabs.org';
			$wgSitename = 'DRMF';
			$wgCapitalLinks = false;
			$wgLogo = "/images/DRMF.png";
			$wgMetaNamespace = 'Project';
			wfLoadExtension( 'Scribunto' );
			$wgScribuntoDefaultEngine = 'luastandalone';
			$wgMathValidModes[] = 'latexml'; // adding LaTeXML as rendering option
			// Set LaTeXML as default rendering option;
			$wgDefaultUserOptions['math'] = 'latexml';
			// Specify the path to your LaTeXML instance that converts the \TeX commands to MathML (optional)
			$wgMathLaTeXMLUrl = 'http://latexml:8080/convert/';
			$wgMathDefaultLaTeXMLSetting = array(
				'format' => 'xhtml',
				'whatsin' => 'math',
				'whatsout' => 'math',
				'pmml',
				'cmml',
				'mathtex',
				'nodefaultresources',
				'preload' => array(
					'LaTeX.pool',
					'article.cls',
					'amsmath.sty',
					'amsthm.sty',
					'amstext.sty',
					'amssymb.sty',
					'eucal.sty',
					// '[dvipsnames]xcolor.sty',
					'url.sty',
					'hyperref.sty',
					'[ids]latexml.sty',
					'DLMFmath.sty',
					'DRMFfcns.sty',
					'DLMFsupport.sty.ltxml',
				),
				'linelength' => 90,
			);
			$wgMathMathMLUrl = 'http://mathoid:10042'; // linked docker service
			$wgMathDisableTexFilter = 'always';
			$wgHooks['MathFormulaPostRender'] = array( 'wfOnMathFormulaRendered' );
			$wgGroupPermissions['*']['edit'] = false;
			$wgGroupPermissions['*']['createaccount'] = false;
			$wgWBRepoSettings['formatterUrlProperty'] = 'P10';
			// See https://www.mediawiki.org/wiki/Extension_default_namespaces
			define( "NS_SOURCE", 130 );
			define( "NS_SOURCE_TALK", 131 );
			define( "NS_FORMULA", 132 );
			define( "NS_FORMULA_TALK", 133 );
			define( "NS_CD", 134 );
			define( "NS_CD_TALK", 135 );
			define( "NS_DEFINITION", 136 );
			define( "NS_DEFINITION_TALK", 137 );
			$wgExtraNamespaces = array(
				NS_SOURCE => "Source",
				NS_SOURCE_TALK => "Source_talk",
				NS_FORMULA => "Formula",
				NS_FORMULA_TALK => "Formula_talk",
				NS_CD => "CD",
				NS_CD_TALK => "CD_talk",
				NS_DEFINITION => "Definition",
				NS_DEFINITION_TALK => "Definition_talk",
			);
			/**
			 * Callback function that is called after a formula was rendered
			 * @param MathRenderer $Renderer
			 * @param string|null $Result reference to the rendering result
			 * @param int $pid
			 * @param int $eid
			 * @return bool
			 */
			function wfOnMathFormulaRendered(
				Parser $parser, MathRenderer $renderer, &$Result = null
			) {
				$id = $renderer->getID();
				if ( $id ) {
					$url = Title::newFromText( 'Formula:' . $id )->getLocalURL();
					$Result =
						preg_replace( "#</semantics>#",
							"<annotation encoding=\"OpenMath\" >" . $renderer->getUserInputTex() .
							"</annotation>\n</semantics>", $Result );
					$Result =
						'<a href="' . $url . '" id="' . $id . '" style="color:inherit;">' .
						$Result . '</a>';
				}

				return true;
			}

			$smwgNamespacesWithSemanticLinks[NS_FORMULA] = true;
			$smwgNamespacesWithSemanticLinks[NS_CD] = true;
			$wgFlaggedRevsStatsAge = false;
			$wgGroupPermissions['sysop']['review'] = true; #allow administrators to review revisions
			wfLoadExtension( 'MathSearch' );
			$wgEnableWikibaseRepo = true;
			$wgEnableWikibaseClient = true;
			require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
			require_once "$IP/extensions/Wikibase/repo/ExampleSettings.php";
			require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
			require_once "$IP/extensions/Wikibase/client/ExampleSettings.php";
			$wgWBRepoSettings['siteLinkGroups'] = [ 'wikipedia', 'drmfgroup' ];
			$wgWBClientSettings['siteGlobalID'] = 'drmf';
			// wfLoadExtension( 'Interwiki' );
			// wfLoadExtension( 'SiteMatrix' );
			// To grant sysops permissions to edit interwiki data
			$wgGroupPermissions['sysop']['interwiki'] = true;
			wfLoadExtension( 'OAuth' );
			$wgGroupPermissions['sysop']['mwoauthproposeconsumer'] = true;
			wfLoadExtension( 'DataTransfer' );
			break;
		case 'enfse':
			$wgServer = 'https://en.formulasearchengine.com';
			$wgSitename = 'formulasearchengine';
			$wgLogo = "/images/fse_132.png";
			$wgLogoHD = [
				"1.5x" => "/images/fse_202.png",
				"2x" => "/images/fse_270.png",
			];
			wfLoadExtension( 'MathSearch' );
			break;
		case 'mathml':
			$wgServer = 'https://mathml.formulasearchengine.com';
			$wgDBname = 'wiki_enfse';
			$wgSitename = 'MathML';
			$wgLogo = "/images/mathml.png";
			$wgResourceModules['mathml.customizations'] = array(
				'styles' => "mathml.css", // Stylesheet to be loaded in all skins
				// End custom styles for vector
				'localBasePath' => "$IP/mathml/",
				'remoteBasePath' => "$wgScriptPath/mathml/",
			);

			function efCustomBeforePageDisplay( &$out, &$skin ) {
				$out->addModules( array( 'mathml.customizations' ) );
			}

			$wgHooks['BeforePageDisplay'][] = 'efCustomBeforePageDisplay';
			break;
		case 'test':
			$wgServer = '//' . $srv;
			$wgShowExceptionDetails = true;
			$wgDebugToolbar = true;
			$wgShowSQLErrors = true;
			$wgShowDBErrorBacktrace = true;
			$wgEnableWikibaseRepo = true;
			$wgEnableWikibaseClient = true;
			wfLoadExtension( 'MathSearch' );
			// wfLoadExtension( 'Flow' );
			$wgGroupPermissions['*']['edit'] = true;
			$wgNamespaceContentModels[NS_TALK] = 'flow-board';
			$wgNamespaceContentModels[NS_USER_TALK] = 'flow-board';
			require_once "$IP/extensions/Wikibase/repo/Wikibase.php";
			require_once "$IP/extensions/Wikibase/repo/ExampleSettings.php";
			require_once "$IP/extensions/Wikibase/client/WikibaseClient.php";
			require_once "$IP/extensions/Wikibase/client/ExampleSettings.php";
//			$wgProfiler = [
//				'class' => 'ProfilerXhprof',
//				'output' => ['ProfilerOutputDump'],
//				'outputDir' => '/tmp/',
//			];
			$wgJobRunRate = 0;
			$wgEnableRestAPI = true;
			$wgWBRepoSettings['siteLinkGroups'] = [ 'wikipedia' ];
			$wgWBClientSettings['siteGlobalID'] = 'local-test';
			// insert site with
			// php addSite.php --filepath=http://localhost/w/\$1 --pagepath=http://localhost/wiki/\$1 --language en --interwiki-id local-test local-test wikipedia
			// $wgDebugLogFile = "php://stdout";
			$wgMathWikibasePropertyIdDefiningFormula = "P1";
			$wgMathWikibasePropertyIdHasPart = "P2";
			$wgMathWikibasePropertyIdQuantitySymbol = "P3";
			$wgWBRepoSettings['formatterUrlProperty'] = 'P4';
			break;
		default:
			break;
	}
	foreach ( glob( "/var/www/html/LocalSettings.d/*.php" ) as $filename ) {
		/** @noinspection PhpIncludeInspection */
		require_once $filename;
	}
}

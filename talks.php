<?php

if ( function_exists( 'wfLoadSkin' ) ) {
	wfLoadSkin( 'talks' );
	// Keep i18n globals so mergeMessageFileList.php doesn't break
	return true;
} else {
	die( 'This version of the Talks skin requires MediaWiki 1.25+' );
}

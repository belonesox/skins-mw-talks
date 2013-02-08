<?php
/**
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

/** */
require_once('includes/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class SkinTalks extends SkinTemplate {
	function initPage( OutputPage $out ) {
		SkinTemplate::initPage( $out );
		$this->skinname  = 'talks';
		$this->stylename = 'talks';
		$this->template  = 'TalksTemplate';
	}
}

/**
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class TalksTemplate extends QuickTemplate {
	/**
	 * Template filter callback for Talks skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	function execute() {


        // Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html 
    xmlns="http://www.w3.org/1999/xhtml" 
    xml:lang="<?php $this->text('lang') ?>" 
    lang="<?php $this->text('lang') ?>" 
    dir="<?php $this->text('dir') ?>">
    <head>
<!--[if lt IE 9]>
<script src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/html5/html5shiv.js"></script>
<![endif]-->        
        <meta http-equiv="Content-Type" 
              content="<?php $this->text('mimetype') ?>; 
              charset=<?php $this->text('charset') ?>" />
        <?php $this->html('headlinks') ?>
        <title><?php $this->text('pagetitle') ?></title>
		<style type="text/css" media="screen, projection">/*<![CDATA[*/
			@import "<?php $this->text('stylepath') ?>/common/shared.css?<?php echo $GLOBALS['wgStyleVersion'] ?>";
			@import "<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/main.css?<?php echo $GLOBALS['wgStyleVersion'] ?>";
		/*]]>*/
        </style>
		<link rel="stylesheet" type="text/css" <?php if(empty($this->data['printable']) ) { ?>media="print"<?php } ?> href="<?php $this->text('stylepath') ?>/common/commonPrint.css?<?php echo $GLOBALS['wgStyleVersion'] ?>" />
		
		<?php print Skin::makeGlobalVariablesScript( $this->data ); ?>
                
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('stylepath' ) ?>/common/wikibits.js?<?php echo $GLOBALS['wgStyleVersion'] ?>"><!-- wikibits js --></script>

		<!-- Head Scripts -->
<?php $this->html('headscripts') ?>
<?php	if($this->data['jsvarurl'  ]) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('jsvarurl'  ) ?>"><!-- site js --></script>
<?php	} ?>
<?php	if($this->data['pagecss'   ]) { ?>
		<style type="text/css"><?php $this->html('pagecss'   ) ?></style>
<?php	}
		if($this->data['usercss'   ]) { ?>
		<style type="text/css"><?php $this->html('usercss'   ) ?></style>
<?php	}
		if($this->data['userjs'    ]) { ?>
		<script type="<?php $this->text('jsmimetype') ?>" src="<?php $this->text('userjs' ) ?>"></script>
<?php	}
		if($this->data['userjsprev']) { ?>
		<script type="<?php $this->text('jsmimetype') ?>"><?php $this->html('userjsprev') ?></script>
<?php	}
		if($this->data['trackbackhtml']) print $this->data['trackbackhtml']; ?>








  </head>
  
  <body <?php if($this->data['body_ondblclick']) { ?>ondblclick="<?php $this->text('body_ondblclick') ?>"<?php } ?>
        <?php if($this->data['body_onload'    ]) { ?>onload="<?php     $this->text('body_onload')     ?>"<?php } ?>
        <?php if($this->data['nsclass'        ]) { ?>class="<?php      $this->text('nsclass')         ?>"<?php } ?>>
  <div id="globalWrapper">
      <?php if($this->data['catlinks']) { ?><div id="block-catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>

  <div id="block-search">
  	<div id="p-search" class="portlet">
  	  <h5><label for="searchInput"><?php $this->msg('search') ?></label></h5>
  	  <div class="pBody">
  	    <form name="searchform" action="<?php $this->text('searchaction') ?>" id="searchform">
  	      <input id="searchInput" name="search" type="text"
  	        <?php if($this->haveMsg('accesskey-search')) {
  	          ?>accesskey="<?php $this->msg('accesskey-search') ?>"<?php }
  	        if( isset( $this->data['search'] ) ) {
  	          ?> value="<?php $this->text('search') ?>"<?php } ?> />
  	      <input type='submit' name="go" class="searchButton" id="searchGoButton"
  	        value="<?php $this->msg('go') ?>"
  	        />&nbsp;<input type='submit' name="fulltext"
  	        class="searchButton"
  	        value="<?php $this->msg('search') ?>" />
  	    </form>
  	  </div>
  	</div>
  </div>
  
    <div id="column-content">
      	<div id="content">
	         <a name="top" id="contentTop"></a>
        	  <h1 class="firstHeading"><?php $this->text('title') ?></h1>
        	  <div id="bodyContent">
        	    <h3 id="siteSub"><?php $this->msg('tagline') ?></h3>
        	    <div id="contentSub"><?php $this->html('subtitle') ?></div>
        	    <?php if($this->data['undelete']) { ?><div id="contentSub"><?php     $this->html('undelete') ?></div><?php } ?>
        	    <?php if($this->data['newtalk'] ) { ?><div class="usermessage"><?php $this->html('newtalk')  ?></div><?php } ?>
        	    <!-- start content -->
        	    <?php $this->html('bodytext') ?>
        	    <?php if($this->data['catlinks']) { ?><div id="catlinks"><?php       $this->html('catlinks') ?></div><?php } ?>
        	    <!-- end content -->
        	    <div class="visualClear"></div>
        	  </div>
      	</div>
      </div>

      <div class="visualClear"></div>
      </div>
    </div>
  </body>
</html>
<?php
	wfRestoreWarnings();
	}
}

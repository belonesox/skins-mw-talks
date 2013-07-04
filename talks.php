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

	function getCategoryLinks() {
		global $wgUseCategoryBrowser;

		$out = $this->getOutput();

		if ( count( $out->mCategoryLinks ) == 0 ) {
			return '';
		}

		$embed = "<li>";
		$pop = "</li>";

		$allCats = $out->getCategoryLinks();
		$s = '';
		$colon = wfMsgExt( 'colon-separator', 'escapenoentities' );

		if ( !empty( $allCats['normal'] ) ) {
			$t = $embed . implode( "{$pop}{$embed}" , $allCats['normal'] ) . $pop;

			$msg = wfMsgExt( 'pagecategories', array( 'parsemag', 'escapenoentities' ), count( $allCats['normal'] ) );
			$s .= '<div id="mw-normal-catlinks">' .
				Linker::link( Title::newFromText( wfMsgForContent( 'pagecategorieslink' ) ), $msg )
				. $colon . '<ul>' . $t . '</ul>' . '</div>';
		}

		# optional 'dmoz-like' category browser. Will be shown under the list
		# of categories an article belong to
		if ( $wgUseCategoryBrowser ) {
			$s .= '<br /><hr />';

			# get a big array of the parents tree
			$parenttree = $this->getTitle()->getParentCategoryTree();
			# Skin object passed by reference cause it can not be
			# accessed under the method subfunction drawCategoryBrowser
			$tempout = explode( "\n", $this->drawCategoryBrowser( $parenttree ) );
			# Clean out bogus first entry and sort them
			unset( $tempout[0] );
			asort( $tempout );
			# Output one per line
			$s .= implode( "<br />\n", $tempout );
		}

		return $s;
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
	function getCategoryLinks() {
		global $wgUseCategoryBrowser;

		$out = $this->getOutput();

		if ( count( $out->mCategoryLinks ) == 0 ) {
			return '';
		}

		$embed = "<li>";
		$pop = "</li>";

		$allCats = $out->getCategoryLinks();
		$s = '';
		$colon = wfMsgExt( 'colon-separator', 'escapenoentities' );

		if ( !empty( $allCats['normal'] ) ) {
			$t = $embed . implode( "{$pop}{$embed}" , $allCats['normal'] ) . $pop;

			$msg = wfMsgExt( 'pagecategories', array( 'parsemag', 'escapenoentities' ), count( $allCats['normal'] ) );
			$s .= '<div id="mw-normal-catlinks">' .
				Linker::link( Title::newFromText( wfMsgForContent( 'pagecategorieslink' ) ), $msg )
				. $colon . '<ul>' . $t . '</ul>' . '</div>';
		}

		# Hidden categories
		if ( isset( $allCats['hidden'] ) ) {
			if ( $this->getUser()->getBoolOption( 'showhiddencats' ) ) {
				$class = 'mw-hidden-cats-user-shown';
			} elseif ( $this->getTitle()->getNamespace() == NS_CATEGORY ) {
				$class = 'mw-hidden-cats-ns-shown';
			} else {
				$class = 'mw-hidden-cats-hidden';
			}

			$s .= "<div id=\"mw-hidden-catlinks\" class=\"$class\">" .
				wfMsgExt( 'hidden-categories', array( 'parsemag', 'escapenoentities' ), count( $allCats['hidden'] ) ) .
				$colon . '<ul>' . $embed . implode( "{$pop}{$embed}" , $allCats['hidden'] ) . $pop . '</ul>' .
				'</div>';
		}

		# optional 'dmoz-like' category browser. Will be shown under the list
		# of categories an article belong to
		if ( $wgUseCategoryBrowser ) {
			$s .= '<br /><hr />';

			# get a big array of the parents tree
			$parenttree = $this->getTitle()->getParentCategoryTree();
			# Skin object passed by reference cause it can not be
			# accessed under the method subfunction drawCategoryBrowser
			$tempout = explode( "\n", $this->drawCategoryBrowser( $parenttree ) );
			# Clean out bogus first entry and sort them
			unset( $tempout[0] );
			asort( $tempout );
			# Output one per line
			$s .= implode( "<br />\n", $tempout );
		}

		return $s;
	}
	
	
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
<script src="<?php $this->text('stylepath') ?>/<?php $this->text('stylename') ?>/html5/css3-mediaqueries.js"></script>
<![endif]-->        
        <meta http-equiv="Content-Type" 
              content="<?php $this->text('mimetype') ?>; 
              charset=<?php $this->text('charset') ?>" />
        <?php $this->html('headlinks') ?>
		<meta name="google-site-verification" content="sHlNK3kKz6h9lOtR8ftJdOpRpBXQmDp-uTzED1bQIJc" />		
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
  <div id="global-wrapper">
  <div id="block-side">
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
<?php $this->html('bottomscripts'); /* JS call to runBodyOnloadHook */ ?>
  </body>
</html>
<?php
	wfRestoreWarnings();
	}
}

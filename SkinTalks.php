<?php
/**
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

/** */
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

	function setupSkinUserCss( OutputPage $out ) {
		parent::setupSkinUserCss( $out );

		$out->addModuleStyles( array(
			'mediawiki.skinning.interface',
			'skins.talks.styles',
			'mediawiki.legacy.shared'
		) );
	}


	function getCategoryLinks() {
		global $wgUseCategoryBrowser, $wgScript;

		$out = $this->getOutput();
		$allCats = $out->getCategoryLinks();

		if ( count( $allCats  ) == 0 ) {
			return '';
		}

		$embed = "<li>";
		$pop = "</li>";
		
		$s = '';
		$colon = wfMsgExt( 'colon-separator', 'escapenoentities' );

		$t = '';
		if ( !empty( $allCats['normal'] ) ) {
			$t = $embed . implode( "{$pop}{$embed}" , $allCats['normal'] ) . $pop;
		}	
		$s .= //'<div id="mw-normal-catlinks">' .
              '<ul>' 
			. "<li>«<a href=" . $wgScript . ">"
			#htmlspecialchars( $this->data['nav_urls']['mainpage']['href'] )
				. wfMessage( 'sitetitle' )->escaped() . "</a>»</li>"
				.  $t . '</ul>'
				//.'</div>'
				;

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


<?php
/**
 */

if( !defined( 'MEDIAWIKI' ) )
	die();

/**
 * @todo document
 * @package MediaWiki
 * @subpackage Skins
 */
class TalksTemplate extends BaseTemplate {
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

		$this->html( 'headelement' );
		?>
  <div id="block-background">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/trianglify/0.4.0/trianglify.min.js"></script>
	<script>
	 	//debugger;
	//	var globaldiv = document.getElementById('global-wrapper');
	//    var dimensions = globaldiv.getClientRects()[0];
        var article_id = <?php echo $this->getSkin()->getTitle()->getArticleID(); ?>;
        var cell_size = 16 + (2^article_id % 84);
        var variance = (2^article_id % 128)*1.0 / 128;
        var stroke_width = (2^article_id % 128)*12.0 / 128;


		var colorbrewer_names = ['YlGn', 'YlGnBu', 'GnBu', 'BuGn', 'PuBuGn', 'PuBu',
								 //'BuPu',
								 'RdPu',
								 'PuRd', 'OrRd', 'YlOrRd', 'YlOrBr', 'Purples', 'Blues', 'Greens',
                                 'Oranges', 'Reds', 'Greys', 'PuOr', 'BrBG', 'PRGn', 'PiYG',
								 'RdBu', 'RdGy', 'RdYlBu', 'Spectral', 'RdYlGn', 'Accent', 'Dark2',
								 'Paired', 'Pastel1', 'Pastel2', 'Set1', 'Set2', 'Set3'];

        var color_name = colorbrewer_names[2^article_id % colorbrewer_names.length];

		var pattern = Trianglify({
			cell_size: cell_size,
			variance: variance,
			x_colors: color_name,
			y_colors: 'match_x',
			palette: Trianglify.colorbrewer,
			stroke_width: stroke_width,
			width: 2*window.innerWidth,
			height: window.innerHeight*12
		});
		var svg_pattern = new XMLSerializer().serializeToString(pattern.svg());
		var base64_pattern = window.btoa(svg_pattern);
		document.body.style.backgroundImage = 'url("data:image/svg+xml;base64,' + base64_pattern  + '")';
	</script>
  <div>
  <div id="global-wrapper">
  <div id="block-side">
      <?php if($this->data['catlinks']) { ?><div id="block-catlinks">
			<?php       $this->html('catlinks') ?>
	      	        <!-- <span style='font-size:200%;padding-right:20px'><a href="<?php $this->text('wgScript') ?>">&#x2302;</a></span> -->	
			</div><?php } ?>

      <div id="block-search">
        <div id="p-search" class="portlet">
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
        	    <?php if($this->data['catlinks']) { ?><?php       $this->html('catlinks') ?><?php } ?>
        	    <!-- end content -->
        	    <div class="visualClear"></div>
        	  </div>
      	</div>
      </div>

<?php
	if ($this->getSkin()->getTitle()->getNamespace() == NS_MAIN) {
?>
		<div id="block-disqus" style="background-color: white; padding: 16px;">
        <div data-user="2032391604" class="pluso" data-options="big,square,line,horizontal,counter,theme=04" data-services="facebook,twitter,vkontakte,google,email" data-background="#ebebeb"></div>			


				<div id="disqus_thread"></div>
				<script type="text/javascript">
					/* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
					var disqus_shortname = 'rosatalks'; // required: replace example with your forum shortname
					var disqus_url = 'http://talks.rosalab.com/Special:ArticleByID/<?php echo $this->getSkin()->getTitle()->getArticleID(); ?>';
				
					/* * * DON'T EDIT BELOW THIS LINE * * */
					(function() {
						var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
						dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
//						dsq.src = '//localhost/projects/sites/talks/skins/talks/discus-embed.js';
						(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
					})();
				</script>
		</div>
<?php } ?>

      <div class="visualClear"></div>
      </div>
    </div>

		<?php
		$this->printTrail();
		echo Html::closeElement( 'body' );
		echo Html::closeElement( 'html' );
		echo "\n";
		wfRestoreWarnings();
	} // end of execute() method
	
}

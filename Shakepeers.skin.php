<?php
/**
 * Bootstrap - A basic MediaWiki skin based on Twitter's excellent Bootstrap CSS framework
 *
 * @Version 1.0.0
 * @Author Matthew Batchelder <borkweb@gmail.com>
 * @Copyright Matthew Batchelder 2012 - http://borkweb.com/
 * @License: GPLv2 (http://www.gnu.org/copyleft/gpl.html)
 */

if ( ! defined( 'MEDIAWIKI' ) ) {
	die( -1 );
}//end if

require_once('includes/skins/SkinTemplate.php');

/**
 * Inherit main code from SkinTemplate, set the CSS and template filter.
 * @package MediaWiki
 * @subpackage Skins
 */
class SkinShakepeers extends SkinTemplate {
	/** Using Bootstrap */
	public $skinname = 'shakepeers';
	public $stylename = 'shakepeers';
	public $template = 'ShakepeersTemplate';
	public $useHeadElement = true;

	/**
	 * initialize the page
	 */
	public function initPage( OutputPage $out ) {
		global $wgSiteJS;
		parent::initPage( $out );
		$out->addModuleScripts( 'skins.shakepeers' );
		$out->addMeta( 'viewport', 'width=device-width, initial-scale=1, maximum-scale=1' );
	}//end initPage

	/**
	 * prepares the skin's CSS
	 */
	public function setupSkinUserCss( OutputPage $out ) {
		global $wgSiteCSS;

		parent::setupSkinUserCss( $out );

		$out->addModuleStyles( 'skins.shakepeers' );

		// we need to include this here so the file pathing is right
		$out->addStyle( 'shakepeers/fonts/font-awesome/css/font-awesome.min.css' );
        
        //Include Google Fonts
        $out->addStyle( 'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic' );
        $out->addStyle( 'https://fonts.googleapis.com/css?family=Quicksand:300,400,600,700' );
        
	}//end setupSkinUserCss
}

/**
 * @package MediaWiki
 * @subpackage Skins
 */
class ShakepeersTemplate extends QuickTemplate {
	/**
	 * @var Cached skin object
	 */
	public $skin;

	/**
	 * Template filter callback for Bootstrap skin.
	 * Takes an associative array of data set from a SkinTemplate-based
	 * class, and a wrapper for MediaWiki's localization database, and
	 * outputs a formatted page.
	 *
	 * @access private
	 */
	public function execute() {
		global $wgRequest, $wgUser, $wgSitename, $wgSitenameshort, $wgCopyrightLink, $wgCopyright, $wgBootstrap, $wgArticlePath, $wgGoogleAnalyticsID, $wgSiteCSS, $wgLang, $wgTitle;
		global $wgEnableUploads;
		global $wgLogo;
		global $wgTOCLocation;
		global $wgNavBarClasses;
		global $wgSubnavBarClasses;

		$this->skin = $this->data['skin'];
		$action = $wgRequest->getText( 'action' );
		$url_prefix = str_replace( '$1', '', $wgArticlePath );

		// Suppress warnings to prevent notices about missing indexes in $this->data
		wfSuppressWarnings();

		$this->html('headelement');
		?>
        <div class="background_container">
            
        </div>
        <div class="container" id="container">
            <div class="top_block">
                <div class="navbar_secondary navbar navbar-default navbar-shakepeers-secondary" role="navigation">
                    <div class="container">
                        <div class="collapse navbar-collapse">
    					<?php
    					if ( $wgUser->isLoggedIn() ) {
    						if ( count( $this->data['personal_urls'] ) > 0 ) {
    							$user_icon = '<i class="fa fa-user"></i>&nbsp; ';
    							$name = wfMessage( 'shakepeers-welcome' )->inContentLanguage() . ' ' .strtolower( $wgUser->getName() );
    							$user_nav = $this->get_array_links( $this->data['personal_urls'], $user_icon . $name, 'user' );
    							?>
    							<ul<?php $this->html('userlangattributes') ?> class="nav navbar-nav navbar-right navbar-nav-user">
    								<?php echo $user_nav; ?>
    							</ul>
    							<?php
    						}
                        } else {  // else if is not logged in
        						?>
        						<ul class="nav navbar-nav navbar-right">
        							<li>
        							<?php echo Linker::linkKnown( SpecialPage::getTitleFor( 'Userlogin' ), wfMsg( 'login' ) ); ?>
        							</li>
        						</ul>
        						<?php
        					}//end if ?>
                        </div>
                    </div>
                </div>
        		<div class="navbar <?php echo $wgNavBarClasses; ?> navbar-primary yamm" role="navigation">
        				<div>
        					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
        					<div class="navbar-header">
        						<button class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
        							<span class="sr-only">Toggle navigation</span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        							<span class="icon-bar"></span>
        						</button>
        						<a class="navbar-brand" href="<?php echo $this->data['nav_urls']['mainpage']['href'] ?>" title="<?php echo $wgSitename ?>"><?php echo isset( $wgLogo ) && $wgLogo ? "<img src='{$wgLogo}' alt='{$wgSitename}'/> " : $wgSitename ; ?></a>
        					</div>
                            <!--Search -->
        					<form class="search_form navbar-search navbar-form navbar-right" action="<?php $this->text( 'wgScript' ) ?>" id="searchform" role="search">
        						<div>
        							<input class="form-control" type="search" name="search" placeholder="Search" title="Search <?php echo $wgSitename; ?> [ctrl-option-f]" accesskey="f" id="searchInput" autocomplete="off">
        							<input type="hidden" name="title" value="Special:Search">
        						</div>
        					</form>
                            
                            <!-- Nav Bar -->
        					<div class="collapse navbar-collapse">
        						<ul class="nav navbar-nav navbar-right">
        							<li>
        							<a href="<?php echo $this->data['nav_urls']['mainpage']['href'] ?>"><?php echo wfMessage( 'home' ) ;?></a>
        							</li>
        							<li class="dropdown yamm-fw">
        							    <?php echo Linker::link( Title::newFromText('Thématiques'), wfMsg( 'themes' ), array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role'=> 'button', 'aria-expanded' => 'false') ); ?>
        							    <ul class="dropdown-menu">
                                            <li>
                                                <div class="yamm-content">
                                                    <div class="row">
                                                        
                                                        <?php // get themes
                                                        $themes = $this->getThemeCategories();
                                                        
                                                        //Split into two columns
                                                        $len = count($themes);
                                                        $half = round($len / 2);
                                                        $themes = array_chunk($themes, $half);?>
                                                        
                                                        
                                                        
                                                        <?php // Loop through columns
                                                        foreach ($themes as $themeColumn) :?>
                                                            <div class="col-md-6">
                                                                <ul class="themes_list">
                                                                <?php // Loop through themes and build list
                                                                    foreach ($themeColumn as $theme) :?>
                                                                        <li class="themes_list_item">
                                                                            <a href="<?php echo $theme['url'];?>"><?php echo $theme['title']?></a>
                                                                        </li>
                                                                    <?php endforeach;?>
                                                                </ul>
                                                            </div>
                                                        <?php endforeach;?>
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                    
                                    <li class="dropdown">
                                        <?php echo Linker::linkKnown( SpecialPage::getTitleFor('AllPages') , wfMsg('articles'), array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role'=> 'button', 'aria-expanded' => 'false'));?>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <?php echo Linker::linkKnown( Title::newFromText('Brouillon') , wfMsg('link-draft'));?>
                                            </li>
                                            <li>
                                                <?php echo Linker::linkKnown( Title::newFromText('Révision') , wfMsg('link-revision'));?>
                                            </li>
                                            <li>
                                                <?php echo Linker::linkKnown( SpecialPage::getTitleFor('Publication') , wfMsg('link-published'));?>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="dropdown">
                                        <a href="#" class="dropdown-toggle info_menu_button" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-info-circle"></i></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li> <?php echo Linker::linkKnown( Title::newFromText('ShakePeers') , wfMsg('shakepeers'));?></li>
                                            <li> <?php echo Linker::linkKnown( Title::newFromText('Contribuer') , wfMsg('contribuer'));?></li>
                                            <li> <?php echo Linker::linkKnown( Title::newFromText('Communauté') , wfMsg('communauté'));?></li>
                                            <li> <?php echo Linker::linkKnown( Title::newFromText('Aide') , wfMsg('aide'));?></li>
                                            <li> <?php echo Linker::linkKnown( Title::newFromText('Contact') , wfMsg('contact'));?></li>
                                        </ul>
                                    </li>
        							
        						</ul>
                            <!-- End nav bar -->
        					
                            
                            
        					</div>
        				</div>
        		</div><!-- topbar -->
            </div><!-- top_block -->
			
            <!--
                Add mainpage central quote block
            -->
    		<?php if ($wgTitle->isMainPage() ) echo "<h2 class='homepage_quote'>".wfMsg("slogan")."</h2>";?>
            <!--
                End mainpage block
            -->
                
                
            <!--Begin main content holders -->
            <div class="content_holder">
        		<div id="wiki-outer-body">
                    <div class="row">
                        <!--Wiki Body -->
            			<div id="wiki-body" class="<?php if ($wgTitle->isMainPage() ) echo 'col-md-8'?>">                            
                            
            				<?php
            					if ( 'sidebar' == $wgTOCLocation ) {
            						?>
            						<div class="row">
            							<section class="col-md-3 toc-sidebar"></section>
            							<section class="col-md-9 wiki-body-section">
            						<?php
            					}//end if
            				?>
            				<?php if( $this->data['sitenotice'] ) { ?><div id="siteNotice" class="alert-message warning"><?php $this->html('sitenotice') ?></div><?php } ?>
            				<?php if ( $this->data['undelete'] ): ?>
            				<!-- undelete -->
            				<div id="contentSub2"><?php $this->html( 'undelete' ) ?></div>
            				<!-- /undelete -->
            				<?php endif; ?>
            				<?php if($this->data['newtalk'] ): ?>
            				<!-- newtalk -->
            				<div class="usermessage"><?php $this->html( 'newtalk' )  ?></div>
            				<!-- /newtalk -->
            				<?php endif; ?>

            				<div class="pagetitle page-header">
            					<h1><?php $this->html( 'title' ) ?> <small><?php $this->html('subtitle') ?></small></h1>
            				</div>	
                        
                            <!-- Page editing -->
        					<?php 
                            if ( $wgUser->isLoggedIn() ) {
                                if ( count( $this->data['content_actions']) > 0 ) {
            						$content_nav = $this->get_array_links( $this->data['content_actions'], 'Page', 'page' );
            						?>
            						<ul class="nav navbar-nav navbar-right content-actions"><?php echo $content_nav; ?></ul>
            						<?php
            					}
                            }//end if ?>
                            <!--/page editing -->

            				<div class="body">
            				<?php $this->html( 'bodytext' ) ?>
            				</div>

            				<?php if ( $this->data['catlinks'] ): ?>
            				<div class="category-links">
            				<!-- catlinks -->
            				<?php $this->html( 'catlinks' ); ?>
            				<!-- /catlinks -->
            				</div>
            				<?php endif; ?>
            				<?php if ( $this->data['dataAfterContent'] ): ?>
            				<div class="data-after-content">
            				<!-- dataAfterContent -->
            				<?php $this->html( 'dataAfterContent' ); ?>
            				<!-- /dataAfterContent -->
            				</div>
            				<?php endif; ?>
            				<?php
            					if ( 'sidebar' == $wgTOCLocation ) {
            						?>
            						</section></section>
            						<?php
            					}//end if
            				?>
            			</div><!-- wikibody -->
                        
                        <!-- Display Article boxes on Homepage -->
                        
                        
                        <?php if ( $wgTitle->isMainPage() ) : ?>
                            
                            <?php
                            
                            // Build boxes via associative arrays (because DRY)
                            $categories = [];
                            array_push($categories,
                            
                                // Add publication box
                                array(
                                    "namespace" => "Publication",
                                    "slug"      => "published",
                                    "pageTitle" => "Publication",
                                    "icon"      => "icon-ok-sign",
                                    "feedUrl"   => "https://shakepeers.org/api.php?hidebots=1&action=feedrecentchanges&namespace=5000" 
                                ),
                                // Add Revision box
                                array(
                                    "namespace" => "Revision",
                                    "slug"      => "revision",
                                    "pageTitle" => "Révision",
                                    "icon"      => "icon-pencil",
                                    "feedUrl"   => "https://shakepeers.org/api.php?hidebots=1&action=feedrecentchanges&namespace=4000" 
                                ),
                                // Add drafts box
                                array(
                                    "namespace" => "Brouillon",
                                    "slug"      => "draft",
                                    "pageTitle" => "Brouillon",
                                    "icon"      => "icon-file",
                                    "feedUrl"   => "https://shakepeers.org/api.php?hidebots=1&action=feedrecentchanges&namespace=3000"
                                )
                            
                            );
                            
                            // Debug
                            //echo "<pre>".print_r($categories, true)."</pre>";
                            
                            
                            // Start sidebar
                            echo "<!-- widget sidebar --><div class='col-md-4 widget_sidebar'>";
                            
                            // Build content box
                            foreach ($categories as $category) : ?>
                                <!-- <?php echo $category['slug'] ?> articles -->
                                    <div class="articles_widget articles_widget-<?php echo $category['slug'];?>">
                                        <h3>
                                            <span class="icon <?php echo $category['icon'] ?>"></span>
                                            <?php echo Linker::linkKnown( Title::newFromText($category['pageTitle']) , wfMsg("articles-{$category['slug']}-title"));?> 
                                            <a class="rss_button" href="<?php echo $category['feedUrl']; ?>"><i class="icon fa fa-rss"></i></a>
                                        </h3>
                                        <?php 
                                        // Build Wikicode Tag
                                        $text = "{{#tag:DynamicPageList|
                                            namespace = {$category['namespace']}
                                            shownamespace = false
                                            count         = 4
                                            }}";
                                            
                                        //  Parse
                                        $title = $wgTitle;
                                        $parser = new Parser;
                                        
                                        // Output
                                        $parsed = $parser->parse($text, $wgTitle, new ParserOptions()); echo $parsed->getText();
                                        
                                        // Add link
                                        echo '<p class="see_more_link_holder">'.Linker::linkKnown( Title::newFromText($category['pageTitle']) , wfMsg("see-{$category['slug']}-articles").' <span class="icon icon-chevron-right"></span>').'</p>';
                                        ?>
                                    </div>
                                    
                            <?php endforeach; ?>
                            
                            </div><!-- /widget sidebar -->
                            
                            
                        <?php endif; ?>
                    </div>
        		</div>
        		<div class="bottom">
        			<div class="container">
        				<?php $this->includePage('Bootstrap:Footer'); ?>
        				<footer>
        					<p>&copy; <?php echo date('Y'); ?> by <a href="<?php echo (isset($wgCopyrightLink) ? $wgCopyrightLink : 'http://borkweb.com'); ?>"><?php echo (isset($wgCopyright) ? $wgCopyright : 'BorkWeb'); ?></a> 
        						&bull; Powered by <a href="http://mediawiki.org">MediaWiki</a> 
                    			<li class="dropdown">
                    				<a href="#" class="dropdown-toggle" data-toggle="dropdown">Tools <span class="caret"></span></a>
                    				<ul class="dropdown-menu">
                    					<li><a href="<?php echo $url_prefix; ?>Special:RecentChanges" class="recent-changes"><i class="fa fa-edit"></i> Recent Changes</a></li>
                    					<li><a href="<?php echo $url_prefix; ?>Special:SpecialPages" class="special-pages"><i class="fa fa-star-o"></i> Special Pages</a></li>
                    					<?php if ( $wgEnableUploads ) { ?>
                    					<li><a href="<?php echo $url_prefix; ?>Special:Upload" class="upload-a-file"><i class="fa fa-upload"></i> Upload a File</a></li>
                    					<?php } ?>
                    				</ul>
                    			</li>
        					</p>
        				</footer>
        			</div><!-- container -->
        		</div><!-- bottom -->
            </div>
            
        </div><!-- container -->
		<?php
		$this->html('bottomscripts'); /* JS call to runBodyOnloadHook */
		$this->html('reporttime');

		if ( $this->data['debug'] ) {
			?>
			<!-- Debug output:
			<?php $this->text( 'debug' ); ?>
			-->
			<?php
		}//end if
		?>
		</body>
		</html>
		<?php
	}//end execute

	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 */
	private function nav( $nav ) {
		$output = '';
		foreach ( $nav as $topItem ) {
			$pageTitle = Title::newFromText( $topItem['link'] ?: $topItem['title'] );
			if ( array_key_exists( 'sublinks', $topItem ) ) {
				$output .= '<li class="dropdown">';
				$output .= '<a href="#" class="dropdown-toggle" data-toggle="dropdown">' . $topItem['title'] . ' <b class="caret"></b></a>';
				$output .= '<ul class="dropdown-menu">';

				foreach ( $topItem['sublinks'] as $subLink ) {
					if ( 'divider' == $subLink ) {
						$output .= "<li class='divider'></li>\n";
					} elseif ( $subLink['textonly'] ) {
						$output .= "<li class='nav-header'>{$subLink['title']}</li>\n";
					} else {
						if( $subLink['local'] && $pageTitle = Title::newFromText( $subLink['link'] ) ) {
							$href = $pageTitle->getLocalURL();
						} else {
							$href = $subLink['link'];
						}//end else

						$slug = strtolower( str_replace(' ', '-', preg_replace( '/[^a-zA-Z0-9 ]/', '', trim( strip_tags( $subLink['title'] ) ) ) ) );
						$output .= "<li {$subLink['attributes']}><a href='{$href}' class='{$subLink['class']} {$slug}'>{$subLink['title']}</a>";
					}//end else
				}
				$output .= '</ul>';
				$output .= '</li>';
			} else {
				if( $pageTitle ) {
					$output .= '<li' . ($this->data['title'] == $topItem['title'] ? ' class="active"' : '') . '><a href="' . ( $topItem['external'] ? $topItem['link'] : $pageTitle->getLocalURL() ) . '">' . $topItem['title'] . '</a></li>';
				}//end if
			}//end else
		}//end foreach
		return $output;
	}//end nav
    
    
    private function page_nav( $nav ) {
        global $wgTitle;
                
        // Build nav with 4 items : edit, discuss, options, information. Options and Information have subitems. 
        $page_nav = array();
        
        // Add the edit and discuss if present, and remove from nav array
        foreach ($nav as $key => $nav_item) {
            if ('edit' == $nav_item['id']) {
                $page_nav[] = $nav_item;
                unset($nav[$key]);
            }
            if ('talk' == $nav_item['id']) {
                $page_nav[] = $nav_item;
                unset($nav[$key]);
            }
            
            
        }
        
        // Add the tool button
        $page_nav[] = array(
            'id' => 'tools',
            'link' => 'javascript:void(0)',
            'class' => 'collabspible dropdown',
            'title' => '<i class="icon icon-wrench"></i> ' .wfMsg('Tools')
        );
        
        // Add the information button
        $page_nav[] = array(
            'id' => 'information',
            'link' => 'javascript:void(0)',
            'class' => 'collabspible dropdown',
            'title' => '<i class="icon icon-info-sign"></i> ' .wfMsg('Informations')
        );
        
        // Build the array
        foreach ($page_nav as $key => $pageNavItem) {
            if ($pageNavItem['id'] == 'tools') {
                       
                // Add the print button into 'Tools'
                $page_nav[$key]['sublinks'][] = array(
                    'id' => 'print',
                    'linkTag' => Linker::link( $wgTitle,'<i class="icon icon-print"></i> '. wfMsg('print-version'), array(), array( 'printable' => 'yes' ) ),
                );
                
                // Add the watch, unwatch and simple edit buttons
                foreach ($nav as $navKey => $navItem) {
                    if ( $navItem['id'] == 'watch' ||
                         $navItem['id'] == 'unwatch' || 
                         $navItem['id'] == 've-edit' 
                    ) {
                        $page_nav[$key]['sublinks'][] = $navItem;
                        unset($nav[$navKey]);
                    }
                }
            } 
            
            elseif ($pageNavItem['id'] == 'information') {
                // Add everything elses
                foreach ($nav as $navKey => $navItem) {

                    $page_nav[$key]['sublinks'][] = $navItem;
                    unset($nav[$navKey]);
                }
            }

        }
        
        //echo '<pre>'; print_r($page_nav); echo "</pre>";
        
        
        
        
        $output = '';
        for ($i=1;$i<count($page_nav);$i++) {
            
            if ($page_nav[$i]['id'] == 'information' || $page_nav[$i]['id'] == 'tools') {
                $liAtts = 'class="dropdown"';
                $linkAtts = 'class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"';
            } else {
                $liAtts = '';
                $linkAtts = '';
            }
            $output .= "<li $liAtts ><a href='{$page_nav[$i]['link']}' $linkAtts >";
            $output .= $page_nav[$i]['title'];
            $output .= "</a>";
            
            if (isset($page_nav[$i]['sublinks'])) {
                $output .= '<ul class="dropdown-menu">';
                foreach ($page_nav[$i]['sublinks'] as $item) {
                    
                    $output .= "<li>";
                    if (isset($item['linkTag'])){
                        $output .=  $item['linkTag'];
                    } else {
                        $output .=  "<a href='".$item['link']."' >".$item['title'].'</a>';
                    }
                    $output .=  "</li>";
                }
                $output .= '</ul>';
                
            }
            $output .= "</li>";
            
        }
        
        return $output;
    }
    
    
    
	/**
	 * Render one or more navigations elements by name, automatically reveresed
	 * when UI is in RTL mode
	 */
	private function nav_select( $nav ) {
		$output = '';
		foreach ( $nav as $topItem ) {
			$pageTitle = Title::newFromText( $topItem['link'] ?: $topItem['title'] );
			$output .= '<optgroup label="'.strip_tags( $topItem['title'] ).'">';
			if ( array_key_exists( 'sublinks', $topItem ) ) {
				foreach ( $topItem['sublinks'] as $subLink ) {
					if ( 'divider' == $subLink ) {
						$output .= "<option value='' disabled='disabled' class='unclickable'>----</option>\n";
					} elseif ( $subLink['textonly'] ) {
						$output .= "<option value='' disabled='disabled' class='unclickable'>{$subLink['title']}</option>\n";
					} else {
						if( $subLink['local'] && $pageTitle = Title::newFromText( $subLink['link'] ) ) {
							$href = $pageTitle->getLocalURL();
						} else {
							$href = $subLink['link'];
						}//end else

						$output .= "<option value='{$href}'>{$subLink['title']}</option>";
					}//end else
				}//end foreach
			} elseif ( $pageTitle ) {
				$output .= '<option value="' . $pageTitle->getLocalURL() . '">' . $topItem['title'] . '</option>';
			}//end else
			$output .= '</optgroup>';
		}//end foreach

		return $output;
	}//end nav_select

	private function get_page_links( $source ) {
		$titleBar = $this->getPageRawText( $source );
		$nav = array();
		foreach(explode("\n", $titleBar) as $line) {
			if(trim($line) == '') continue;
			if( preg_match('/^\*\*\s*divider/', $line ) ) {
				$nav[ count( $nav ) - 1]['sublinks'][] = 'divider';
				continue;
			}//end if

			$sub = false;
			$link = false;
			$external = false;

			if(preg_match('/^\*\s*([^\*]*)\[\[:?(.+)\]\]/', $line, $match)) {
				$sub = false;
				$link = true;
			}elseif(preg_match('/^\*\s*([^\*\[]*)\[([^\[ ]+) (.+)\]/', $line, $match)) {
				$sub = false;
				$link = true;
				$external = true;
			}elseif(preg_match('/^\*\*\s*([^\*\[]*)\[([^\[ ]+) (.+)\]/', $line, $match)) {
				$sub = true;
				$link = true;
				$external = true;
			}elseif(preg_match('/\*\*\s*([^\*]*)\[\[:?(.+)\]\]/', $line, $match)) {
				$sub = true;
				$link = true;
			}elseif(preg_match('/\*\*\s*([^\* ]*)(.+)/', $line, $match)) {
				$sub = true;
				$link = false;
			}elseif(preg_match('/^\*\s*(.+)/', $line, $match)) {
				$sub = false;
				$link = false;
			}

			if( strpos( $match[2], '|' ) !== false ) {
				$item = explode( '|', $match[2] );
				$item = array(
					'title' => $match[1] . $item[1],
					'link' => $item[0],
					'local' => true,
				);
			} else {
				if( $external ) {
					$item = $match[2];
					$title = $match[1] . $match[3];
				} else {
					$item = $match[1] . $match[2];
					$title = $item;
				}//end else

				if( $link ) {
					$item = array('title'=> $title, 'link' => $item, 'local' => ! $external , 'external' => $external );
				} else {
					$item = array('title'=> $title, 'link' => $item, 'textonly' => true, 'external' => $external );
				}//end else
			}//end else

			if( $sub ) {
				$nav[count( $nav ) - 1]['sublinks'][] = $item;
			} else {
				$nav[] = $item;
			}//end else
		}

		return $nav;	
	}//end get_page_links

	private function get_array_links( $array, $title, $which ) {
		$nav = array();
		$nav[] = array('title' => $title );
		foreach( $array as $key => $item ) {
			$link = array(
				'id' => Sanitizer::escapeId( $key ),
				'attributes' => $item['attributes'],
				'link' => htmlspecialchars( $item['href'] ),
				'key' => $item['key'],
				'class' => htmlspecialchars( $item['class'] ),
				'title' => htmlspecialchars( $item['text'] ),
			);

			if( 'page' == $which ) {
				// switch( $link['title'] ) {
//                 case 'Page': $icon = 'file'; break;
//                 case 'Discussion': $icon = 'comment'; break;
//                 case 'Edit': $icon = 'pencil'; break;
//                 case 'History': $icon = 'clock-o'; break;
//                 case 'Delete': $icon = 'remove'; break;
//                 case 'Move': $icon = 'arrows'; break;
//                 case 'Protect': $icon = 'lock'; break;
//                 case 'Watch': $icon = 'eye-open'; break;
//                 case 'Unwatch': $icon = 'eye-slash'; break;
//                 }//end switch
                switch( $key ) {
                    case 'nstab-revision': $icon = "pencil"; break;
                    case 'talk': $icon = "comment"; break;
                    case 've-edit': $icon = "pencil-square-o"; break;
                    case 'edit': $icon = "code"; break;
                    case 'history': $icon = "history"; break;
                    case 'watch': $icon = "eye"; break;
                }// end switch

				$link['title'] = '<i class="fa fa-' . $icon . '"></i> ' . $link['title'];
			} elseif( 'user' == $which ) {
                switch( $key ) {
                    case 'userpage': $icon = 'user'; break;
                    case 'mytalk': $icon = 'comments-o'; break;
                    case 'preferences': $icon = 'cog'; break;
                    case 'betafeatures': $icon = 'asterisk'; break;
                    case 'watchlist': $icon = 'eye'; break;
                    case 'newmessages': $icon = 'envelope'; break;
                    case 'mycontris': $icon = 'list'; break;
                    case 'logout': $icon = 'power-off'; break;
                }
                
                // Deal with special cases
                if ($key == 'notifications') {
                    $link['title'] = '<i class="fa fa-exclamation"></i> &nbsp;' . wfMsg('notifications') .' &nbsp;&nbsp;<span class="badge">' . $link['title'] .'</span>';
                } else {
                    $link['title'] = '<i class="fa fa-' . $icon . '"></i> ' . $link['title'];
                }

                    

				
			}//end elseif
            if ('page' == $which) {
                $nav[] = $link;
            } else {
    			$nav[0]['sublinks'][] = $link;
                
            }
		}//end foreach
        if ('page' == $which ){
            return $this->page_nav ($nav);
        } else {
    		return $this->nav( $nav );
            
        }
	}//end get_array_links
    
    
    
    /*
        getThemeCategories
        returns : array() of theme categories
    */
    private function getThemeCategories() {
        $cat = Category::newFromName('Thématiques');
        $members = $cat->getMembers();

        $subcats = array();

        for ($i = 0; $i < $members->count(); $i++) {
            $cur = $members->current();
            $subcats[$i]['title'] = $cur->getText();
            $subcats[$i]['url'] = $cur->getFullURL();
            $members->next();
        }
        
        return $subcats;
    }

	function getPageRawText($title) {
		global $wgParser, $wgUser;
		$pageTitle = Title::newFromText($title);
		if(!$pageTitle->exists()) {
			return 'Create the page [[Bootstrap:TitleBar]]';
		} else {
			$article = new Article($pageTitle);
			$wgParserOptions = new ParserOptions($wgUser);
			// get the text as static wiki text, but with already expanded templates,
			// which also e.g. to use {{#dpl}} (DPL third party extension) for dynamic menus.
			$parserOutput = $wgParser->preprocess($article->getRawText(), $pageTitle, $wgParserOptions );
			return $parserOutput;
		}
	}

	function includePage($title) {
		global $wgParser, $wgUser;
		$pageTitle = Title::newFromText($title);
		if(!$pageTitle->exists()) {
			echo 'The page [[' . $title . ']] was not found.';
		} else {
			$article = new Article($pageTitle);
			$wgParserOptions = new ParserOptions($wgUser);
			$parserOutput = $wgParser->parse($article->getRawText(), $pageTitle, $wgParserOptions);
			echo $parserOutput->getText();
		}
	}

	public static function link() { }
}


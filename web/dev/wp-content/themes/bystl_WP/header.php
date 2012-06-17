<!DOCTYPE html>


<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php 
if(is_subpage()){
    $parent_title = get_the_title($post->post_parent);
    if($parent_title != "About"){
        $parent_title = "";
    }
} else {
    $parent_title = "";
}
?>
<!-- Title -->
<title><?php echo $parent_title . " "; ?><?php wp_title('|', true, 'right'); ?></title>

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!-- RSS, Atom & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php show_admin_bar(false); ?>
<?php wp_head(); ?>
<?php  
    // TODO: make this change a body class or something - not load an entirely separate 
    // color specfic stylesheet....
	$colorschemeInclude = TEMPLATEPATH . "/includes/colorscheme.php"; 
	include($colorschemeInclude); 
?>
<!-- make sure these is always last. -->
<script type="text/javascript" src="<?php echo get_bloginfo('template_url').'/js/modernizr-2.5.3.min.js'; ?>"></script>
<script type="text/javascript" src="<?php echo get_bloginfo('template_url').'/js/head.load.min.js'; ?>"></script>
<!-- END head -->
</head>

<!-- BEGIN body -->
<body class="<?php body_class_alt(); ?> <?php echo $colorSchemeClass; ?>" onload="prettyPrint()">

    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">

            <div class="container-fluid">

              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

            <?php if (get_option_tree('tagline') == 'Yes') { ?>

            <?php 
                // break up the tagline by words
                $bystl_tagline = get_option_tree('tagline_text');
                $bystl_wds = explode(" ", $bystl_tagline);
            ?>
              <a class="brand" href="<?php bloginfo('url'); ?>">
                <img src="<?php echo get_bloginfo('template_url') ?>/img/bystl_header-logo_symbol_navbar.png" alt="BYSTL Logo" />
                <span><strong><?php echo $bystl_wds[0] . ' ' . $bystl_wds[1]; ?></strong> <?php echo $bystl_wds[2]; ?> <?php echo $bystl_wds[3]; ?></span>
                <i> bystl</i>
              </a>
            <?php } ?>

            <!-- <div class="btn-group" data-no-collapse="true"> -->
                <?php if (get_option_tree('twitter_icon') == 'Yes') { ?>
                <a class="btn btn-navbar" href="https://twitter.com/<?php echo get_option_tree('twitter_url') ?>"><span class="icon-twitter-sign icon-only"></span></a>
                <?php } ?><?php if (get_option_tree('facebook_icon') == 'Yes') { ?>
                <a class="btn btn-navbar" href="<?php echo get_option_tree('facebook_url') ?>"><span class="icon-facebook-sign icon-only"></span></a>
                <?php } ?><?php if (get_option_tree('phone_icon') == 'Yes') { ?>
                <a class="btn btn-navbar" href="<?php echo site_url() . get_option_tree('phone_url') ?>"><span class="icon-phone icon-only"></span></a>
                <?php } ?><?php if (get_option_tree('mail_icon') == 'Yes') { ?>
                <a class="btn btn-navbar" href="<?php echo site_url() . get_option_tree('mail_url') ?>"><span class="icon-envelope icon-only"></span></a>
                <?php } ?>
            <!-- </div> -->

              <div class="nav-collapse">

                 <?php wp_nav_menu(array(
                                'container' => false, 
                                'theme_location' => 'top_menu', 
                                //'container_class' => 'nav pull-right',
                                'menu_class' => 'nav pull-right', 
                                //'items_wrap' => '%3$s',
                                //'echo' => true, 
                                //'before' => '<ul class="nav pull-right">', 
                                //'after' => '</ul>', 
                                //'link_before' => '', 
                                //'link_after' => '', 
                                'depth' => 2, 
                                'walker' => new Bootstrap_Walker_Nav_Menu()

                                )
                 ); ?>

                <!--<form class="navbar-search pull-left" action="">
                  <input type="text" class="search-query span2" placeholder="Search">
                </form>-->

                

            </div>
            <!-- END: nav-collapse -->

            </div>
            <!-- END: container -->

        </div>
        <!-- END: navbar-inner -->
    </div>
    <!-- END: navbar -->
    <div class="container-fluid" id="pageWrapper">

        <div class="header">
            <div class="container-fluid">
                <div class="row-fluid">

                <div class="logo-container span5">

                    <a class="logo" href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_bloginfo('template_url') ?>/img/bystl_header-logo_symbol.png" alt="BYSTL Logo" />
                        <?php if (get_option_tree('tagline') == 'Yes') { ?>

                        <?php 
                            // break up the tagline by words
                            $bystl_tagline = get_option_tree('tagline_text');
                            $bystl_wds = explode(" ", $bystl_tagline);
                        ?>

                            <?php if(is_home()) { echo "<h1>"; } else { echo "<span class='h1'>"; } ?><strong><?php echo $bystl_wds[0] . ' ' . $bystl_wds[1]; ?></strong> <?php echo $bystl_wds[2]; ?> <?php echo $bystl_wds[3]; ?>
                            <?php if(is_home()) { echo "</h1>"; } else { echo "</span>"; } ?>
                            <i> bystl</i>
                        <?php }  ?>
                    </a>
                    
                </div>

                <div class="menu-container span11">

                    <ul class="nav nav-pills pull-right">
                        <?php 
                            function is_subpage(){
                                global $post;
                                if(is_page() && $post->post_parent){
                                    return $post->post_parent;
                                } else {
                                    return false;
                                }
                            }
                            if(is_subpage()){
                                //wp_list_pages('post_status=publish&title_li=&include='.$post->post_parent);
                                wp_list_pages('post_status=publish&title_li=&child_of='.$post->post_parent);     
                            } else {
                                wp_list_pages('post_status=publish&title_li=&child_of='.$post->ID); 
                            }
                            
                        ?>
                        <!--<li class="testiphonelandscapelink"><a href="javascript:window.open('http://yogastlouis.com/dev/about/', '', 'width=320,height=480')">test iphone landscape</a></li>-->
                    </ul>

                 <?php wp_nav_menu(array('container' => false, 'menu_id' => 'main-nav', 'theme_location' => 'main_menu',  'menu_class' => 'sf-menu', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'fallback_cb' => 'display_home2', 'link_after' => '', 'depth' => 0 )); ?>
                </div>

                <div class="clearFix"></div>

                </div>
            </div>

        </div>
        <!-- END: header -->
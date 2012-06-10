<!DOCTYPE html>


<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1"/>
<!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Title -->
<title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<!-- RSS, Atom & Pingbacks -->
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> RSS Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="alternate" type="text/xml" title="RSS .92" href="<?php bloginfo( 'rss_url' ); ?>" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?php bloginfo( 'atom_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />


<!-- Theme Hook -->
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

            <div class="container">

              <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </a>

              <div class="nav-collapse">

                 <?php wp_nav_menu(array(
                                'container' => false, 
                                'theme_location' => 'top_menu', 
                                //'container_class' => 'nav pull-right',
                                'menu_class' => 'nav pull-right', 
                                //'items_wrap' => '%3$s',
                                'echo' => true, 
                                //'before' => '<ul class="nav pull-right">', 
                                //'after' => '</ul>', 
                                'link_before' => '', 
                                'link_after' => '', 
                                'depth' => 0 
                                )
                 ); ?>

                <!--<form class="navbar-search pull-left" action="">
                  <input type="text" class="search-query span2" placeholder="Search">
                </form>-->

                <ul class="nav pull-left social">

                    <?php if (get_option_tree('twitter_icon') == 'Yes') { ?>
                    <li><a class="twitter" href="https://twitter.com/<?php echo get_option_tree('twitter_url') ?>">twitter</a></li>
                     <?php } ?>
                    <?php if (get_option_tree('facebook_icon') == 'Yes') { ?>
                    <li><a class="facebook" href="<?php echo get_option_tree('facebook_url') ?>">facebook</a></li>
                    <?php } ?>
                    <?php if (get_option_tree('phone_icon') == 'Yes') { ?>
                    <li><a class="phone" href="<?php echo get_option_tree('phone_url') ?>">phone</a></li>
                    <?php } ?>
                    <?php if (get_option_tree('mail_icon') == 'Yes') { ?>
                    <li><a class="mail" href="<?php echo get_option_tree('mail_url') ?>">mail</a></li>
                    <?php } ?>

                </ul>

            </div>
            <!-- END: nav-collapse -->

            </div>
            <!-- END: container -->

        </div>
        <!-- END: navbar-inner -->
    </div>
    <!-- END: navbar -->

     <div class="header">

            <div class="container">

                <div class="logo-container">

                    <a class="logo" href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_option_tree('custom_logo_img') ?>" alt="BYSTL Logo" />
                        <?php if (get_option_tree('tagline') == 'Yes') { ?>

                        <?php 
                            // break up the tagline by words
                            $bystl_tagline = get_option_tree('tagline_text');
                            $bystl_wds = explode(" ", $bystl_tagline);
                        ?>

                            <?php if(is_home()) { echo "<h1>"; } else { echo "<span class='h1'>"; } ?><strong><?php echo $bystl_wds[0] . ' ' . $bystl_wds[1]; ?></strong> <?php echo $bystl_wds[2]; ?> <?php echo $bystl_wds[3]; ?>
                            <?php if(is_home()) { echo "</h1>"; } else { echo "</span>"; } ?>
                        <?php }  ?>
                    </a>

                </div>

                 <?php wp_nav_menu(array('container' => false, 'menu_id' => 'main-nav', 'theme_location' => 'main_menu',  'menu_class' => 'sf-menu', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'fallback_cb' => 'display_home2', 'link_after' => '', 'depth' => 0 )); ?>


            </div>

        </div>
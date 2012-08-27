<!DOCTYPE html>


<!-- BEGIN html -->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<!-- BEGIN head -->
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<?php

// aaronl custom stuff

// return query string value
function qsValue($query) {

    $myQryStr = $_SERVER["QUERY_STRING"];
    parse_str($myQryStr, $qs);
    return $qs[$query];

}

// Simple browser detection
$is_lynx = $is_gecko = $is_winIE = $is_macIE = $is_opera = $is_NS4 = $is_safari = $is_chrome = $is_iphone = $is_mobile = false;

if ( isset($_SERVER['HTTP_USER_AGENT']) ) {
  if ( strpos($_SERVER['HTTP_USER_AGENT'], 'Lynx') !== false ) {
    $is_lynx = true;
  } elseif ( stripos($_SERVER['HTTP_USER_AGENT'], 'chrome') !== false ) {
    if ( stripos( $_SERVER['HTTP_USER_AGENT'], 'chromeframe' ) !== false ) {
      if ( $is_chrome = apply_filters( 'use_google_chrome_frame', is_admin() ) )
        header( 'X-UA-Compatible: chrome=1' );
      $is_winIE = ! $is_chrome;
    } else {
      $is_chrome = true;
    }
  } elseif ( stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false ) {
    $is_safari = true;
  } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Gecko') !== false ) {
    $is_gecko = true;
  } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Win') !== false ) {
    $is_winIE = true;
  } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Mac') !== false ) {
    $is_macIE = true;
  } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== false ) {
    $is_opera = true;
  } elseif ( strpos($_SERVER['HTTP_USER_AGENT'], 'Nav') !== false && strpos($_SERVER['HTTP_USER_AGENT'], 'Mozilla/4.') !== false ) {
    $is_NS4 = true;
  }
}

if(stripos($_SERVER['HTTP_USER_AGENT'], 'mobile') !== false) {
  $is_mobile = true;
}

if ( $is_safari && $is_mobile ) {
  $is_iphone = true;
}

$is_IE = ( $is_macIE || $is_winIE );
// end aaronl custom stuff

?>

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

<?php if(qsValue('ui') == "") { ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<?php } else { ?>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory'); ?>/style_original.css" type="text/css" media="screen" />
<?php } ?>

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
<body class="<?php body_class_alt(); ?> <?php echo $colorSchemeClass; ?> <?php echo qsValue('logo'); ?>">
    <?php wp_reset_query(); ?>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="btn btn-navbar mainmenu" data-toggle="collapse" data-target=".nav-collapse">
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
                <img src="<?php echo get_bloginfo('template_url') ?>/img/bystl_header-logo_symbol.png" alt="BYSTL Logo" />
                <span><strong><?php echo $bystl_wds[0] . ' ' . $bystl_wds[1]; ?></strong> <?php echo $bystl_wds[2]; ?> <?php echo $bystl_wds[3]; ?></span>
                <i> bystl</i>
                </a>
            <?php } ?>

                <div id="socialNavbar" class="pull-right" data-no-collapse="true">
                    <?php if (get_option_tree('twitter_icon') == 'Yes') { ?>
                    <a class="hidden-phone btn btn-navbar" title="Follow us on Twitter" href="https://twitter.com/<?php echo get_option_tree('twitter_url') ?>"><span class="icon-twitter icon-only"></span></a>
                    <?php } ?><?php if (get_option_tree('facebook_icon') == 'Yes') { ?>
                    <a class="hidden-phone btn btn-navbar" title="Friend us on Facebook" href="<?php echo get_option_tree('facebook_url') ?>"><span class="icon-facebook icon-only"></span></a>
                    <?php } ?><?php if (get_option_tree('phone_icon') == 'Yes') { ?>
                    <a class="hidden-desktop hidden-tablet visible-phone visible-touch btn btn-navbar" title="Give us a call: 314-644-2226" href="<?php echo get_option_tree('phone_url') ?>"><span class="icon-phone icon-only"></span></a>
                    <?php } ?><?php if (get_option_tree('mail_icon') == 'Yes') { ?>
                    <a class="hidden-phone btn btn-navbar" href="<?php echo get_option_tree('mail_url') ?>"><span class="icon-envelope icon-only"></span></a>
                    <?php } ?>
                    <a class="testiphonelandscapelink btn btn-navbar" href="javascript:window.open('http://yogastlouis.com/dev/', '', 'width=320,height=480')" rel="nofollow"><span class="icon-beaker"></span></a>
                </div>

                <div class="nav-collapse">

                <?php wp_nav_menu(
                    array(
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
                 );
                ?>

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

        <div class="header <?php if($is_mobile){ echo 'mobile'; } ?>">
            <div class="container-fluid">
                <div class="row-fluid">

                    <div class="logo-container span5">

                        <a class="logo" href="<?php bloginfo('url'); ?>">
                            <?php
                                $logoBase = "bystl_header-logo_symbol";
                                if(qsValue('logo') == "") {
                                    $logoFile = $logoBase;
                                } else {
                                    $logoFile = $logoBase . "_" . qsValue('logo');
                                }
                            ?>
                            <img src="<?php echo get_bloginfo('template_url') ?>/img/<?php echo $logoFile; ?>.png" alt="BYSTL Logo" />
                            <?php if (get_option_tree('tagline') == 'Yes') { ?>

                            <?php
                                // break up the tagline by words
                                $bystl_tagline = get_option_tree('tagline_text');
                                $bystl_wds = explode(" ", $bystl_tagline);
                            ?>

                            <?php
                            if(is_home()) {
                                echo "<h1>";
                            } else {
                                echo "<span class='h1'>";
                            }
                            ?>
                            <strong><?php echo $bystl_wds[0] . ' ' . $bystl_wds[1]; ?></strong>
                            <?php echo $bystl_wds[2]; ?> <?php echo $bystl_wds[3]; ?>

                            <?php
                            if(is_home()) {
                                echo "</h1>";
                            } else {
                                echo "</span>";
                            }
                            ?>
                            <i> bystl</i>
                            <?php } ?>
                        </a>

                    </div>
                    <!-- END: .logo-container -->

                    <div class="menu-container span11">
                        <?php
                            function is_subpage(){
                                global $post;
                                if(is_page() && $post->post_parent){
                                    return $post->post_parent;
                                } else {
                                    return false;
                                }
                            }
                        ?>
                        <!-- TODO: For mobile, instead of making them all buttons... make them part of a dropdown (maybe within the breadcrumb???) basically, we wantthe H1 to be much more clear at the top on mobile - instead of having a cluster of buttons. -->
                        <?php if(!is_home() && !is_front_page()){ ?>
                        <ul class="<?php if(!$is_mobile){ echo 'nav nav-pills pull-right'; } else { echo 'hide'; }?> ">
                            <?php
                                if(is_subpage()){
                                    //wp_list_pages('post_status=publish&title_li=&include='.$post->post_parent);
                                    wp_list_pages('post_status=publish&title_li=&child_of='.$post->post_parent);
                                } else {
                                    wp_list_pages('post_status=publish&title_li=&child_of='.$post->ID);
                                }

                            ?>
                        </ul>
                        <?php } ?>

                     <!--<php wp_nav_menu(array('container' => false, 'menu_id' => 'main-nav', 'theme_location' => 'main_menu',  'menu_class' => 'sf-menu', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'fallback_cb' => 'display_home2', 'link_after' => '', 'depth' => 0 )); ?>-->
                    </div>
                    <!-- END: .menu-container -->

                    <div class="clearFix"></div>

                </div>
            </div>
        </div>
        <!-- END: header -->

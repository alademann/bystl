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


<script type="text/javascript">

<?php if (get_option_tree('auto') == 'Yes') {  $timeout = 1500; } else { $timeout = 0; } ?>


jQuery('.images').cycle({
            fx:     'fade',
            speed:    1500,
            timeout:  <?php echo $timeout; ?>,
            pager:  '.slider-nav',
            pagerAnchorBuilder: function(idx, slide) {
                // return selector string for existing anchor
                return '.slider-nav li:eq(' + idx + ') a';}
        });

          jQuery('.images-thumb').cycle({
            fx:     'fade',
            speed:    1500,
            timeout:  <?php echo $timeout; ?>,
            pager:  '.slider-nav-thumbs',
            pagerAnchorBuilder: function(idx, slide) {
                // return selector string for existing anchor
                return '.slider-nav-thumbs li:eq(' + idx + ') a';}
        });

         jQuery('.images-wide').cycle({
            fx:     'fade',
            speed:    1500,
            timeout:  <?php echo $timeout; ?>,
            pager:  '.slider-nav-wide',
            pagerAnchorBuilder: function(idx, slide) {
                // return selector string for existing anchor
                return '.slider-nav-wide li:eq(' + idx + ') a';}
        });

          jQuery('.images-wide-thumb').cycle({
            fx:     'fade',
            speed:    1500,
            timeout:  <?php echo $timeout; ?>,
            pager:  '.slider-nav-thumbs',
            pagerAnchorBuilder: function(idx, slide) {
                // return selector string for existing anchor
                return '.slider-nav-thumbs li:eq(' + idx + ') a';}
        });

    jQuery('.content-slider').cycle({
            'fx' : 'fade',
            'timeout' : <?php echo $timeout; ?>,
            'pager' : '#content-slider-pager',
            'next':   '#next-arrow',
            'pause':   1,
    'prev':   '#prev-arrow'
         });

</script>

<?php if (get_post_meta(get_the_id(), 'ddportfolioBG', true) != '') {

    $portfolioBG = ddListGet('portfolioBG', get_the_ID());
    
    ?>
                            
    <script type="text/javascript">
        
         jQuery.backstretch("<?php echo $portfolioBG[0]['img_url']; ?>");
         
     </script>
         
<?php } ?>

<?php  
    // TODO: make this change a body class or something - not load an entirely separate 
    // color specfic stylesheet....
	$colorschemeInclude = TEMPLATEPATH . "/includes/colorscheme.php"; 
	include($colorschemeInclude); 
?>
<style type="text/css">
    /* stupid admin bar... go away! */
    html { margin-top: 0 !important; }
</style>
<!-- END head -->
</head>

<!-- BEGIN body -->
<body class="<?php body_class_alt(); ?> <?php echo $colorSchemeClass; ?>" onload="prettyPrint()">

  <div class="top-bar">

            <div class="container">

                 <?php wp_nav_menu(array('container' => false, 'theme_location' => 'top_menu', 'menu_class' => 'nav sf-menu2', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0 )); ?>

                <ul class="social">

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

        </div>

     <div class="header">

            <div class="container">

                <div class="logo-container">

                    <a class="logo" href="<?php bloginfo('url'); ?>">
                        <img src="<?php echo get_option_tree('custom_logo_img') ?>" alt="BYSTL Logo" />
                        <?php if (get_option_tree('tagline') == 'Yes') { ?>
                            <?php if(is_home()) { echo "<h1>"; } else { echo "<span class='h1'>"; } ?>
                            <?php echo get_option_tree('tagline_text') ?>
                            <?php if(is_home()) { echo "</h1>"; } else { echo "</span>"; } ?>
                        <?php }  ?>
                    </a>

                </div>

                 <?php wp_nav_menu(array('container' => false, 'menu_id' => 'main-nav', 'theme_location' => 'main_menu',  'menu_class' => 'sf-menu', 'echo' => true, 'before' => '', 'after' => '', 'link_before' => '', 'fallback_cb' => 'display_home2', 'link_after' => '', 'depth' => 0 )); ?>


            </div>

        </div>
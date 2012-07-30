<?php /*
  Template Name: Home Page Two Column
 */ ?>
<?php $is_home = "true"; ?>
<?php get_header(); ?>

<?php if (get_option_tree('slider_onoff') == 'Yes') { ?>

<?php

 $slider = get_option_tree('slider_select');

 $filenames = array(
            'Small Slider (Text)' => 'slider_small.php',
            'Small Slider (Thumbs)' => 'slider_small_thumbs.php',
            'Full Width Slider (Text)' => 'slider_wide.php',
            'Full Width Slider (Thumbs)' => 'slider_wide_thumbs.php',
            'Content Slider' => 'slider_content.php'
        );

 $script1 = $filenames[$slider];

 ?>

 
<?php  
	$sliderScriptInclude = TEMPLATEPATH . "/includes/sliders/$script1";
	include($sliderScriptInclude); 

?>

<?php } ?>

        <div class="page-container row-fluid clearfix" id="homeContent">

            <?php if (function_exists('dynamic_sidebar')) { ?>
            <div class="page-content span11">
            <?php } else { ?>
            <div class="page-content full span16">
            <?php } ?>
                <?php
                if (have_posts ()) { 
                    while (have_posts ()) {
                        the_post();
                        the_content(); 
                    } // END while()
                } else { ?>

                <div class="post box">
                    <h3><?php _e('There is not post available.', 'localization'); ?></h3>
                </div>

                <?php 
                } // END if()
                ?>

            </div>
            <!-- END: .page-content (left column) -->
            <?php if (function_exists('dynamic_sidebar')) { ?>
            <div class="span5 sidebar">
                <ul class="widgets">
                    <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Home Page")); ?>
                </ul>
            </div>
            <!-- END: .sidebar (right column) -->
            <?php } ?>
        </div>
        <!-- END: .page-container -->

<?php if (get_option_tree('cta_onoff') == 'Yes') { ?>

<?php  
	$ctaInclude = TEMPLATEPATH . "/includes/cta.php";
	include($ctaInclude); 
?>

<?php } ?>

<?php if (get_option_tree('portfolio_onoff') == 'Yes') { ?>

<?php	
	$ctaInclude = TEMPLATEPATH . "/includes/portfolio.php";
	include($ctaInclude); 
?>

<?php } ?>

<?php get_footer(); ?>
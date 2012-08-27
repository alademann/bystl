<?php /*
  Template Name: Home Page
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
            'Content Slider' => 'slider_content.php',
            'Content Slider Images Only' => 'slider_content_images.php'
        );

 $script1 = $filenames[$slider];

 ?>

<div class="homeSlider">
<?php
	$sliderScriptInclude = TEMPLATEPATH . "/includes/sliders/$script1";
	include($sliderScriptInclude);

?>
</div>

<?php } ?>

        <div class="page-container row-fluid clearfix" id="homeContent">

            <div class="page-content full span16">
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
            <!-- END: .page-content -->
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
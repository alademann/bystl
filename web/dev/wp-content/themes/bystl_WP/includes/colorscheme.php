<?php

$custom_bg = explode(",",get_option_tree('custom_bg'));  
 $buttons = get_option_tree('buttons_color');

 $filenames = array(
            'Black' => 'black',
            'Blue' => 'blue',
            'Red' => 'red',
            'Orange' => 'orange',
            'Pink' => 'pink',
          
        );

 $script3 = $filenames[$buttons];

 ?>

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/css/buttons/<?php echo $script3; ?>.css" rel="stylesheet" type="text/css" />

<?php if (get_option_tree('background_pattern') == 'Yes') { ?>

<style type="text/css">
    
    body {
      background: url(<?php echo $custom_bg[4] ?>) <?php echo $custom_bg[1] ?> <?php echo $custom_bg[2] ?> <?php echo $custom_bg[3] ?> <?php echo $custom_bg[0] ?> !important;
}

</style>


<?php } else { ?>

<style type="text/css">
    
		/* stupid admin bar... go away! */
		html { margin-top: 0 !important; }
    body {
				 background: url(<?php bloginfo('template_directory'); ?>/img/patterns/<?php echo get_option_tree('choose_pattern') ?>.png) repeat #fff;
		}

</style>

<?php } ?>

<style type="text/css">
    
<?php

 $topbar = get_option_tree('topbar_color');

 $filenames = array(
            'Black' => '000000',
            'Blue' => '2c6bc3',
            'Red' => 'c81414',
            'Orange' => 'e97700',
            'Pink' => 'd2386a',
          
        );

 $script2 = $filenames[$topbar];

 ?>



.top-bar {
    background: #<?php echo $script2; ?>;
}

</style>

 <?php if (get_option_tree('topbar_color') == 'Blue') { ?>

<style type="text/css">
    
.top-bar a {
    color: #e8e8e8;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}

.top-bar {
  border-bottom: 1px solid #2a68bd;
    border-top: 1px solid #2a68bd;
}

</style>

<?php } ?>

 <?php if (get_option_tree('topbar_color') == 'Red') { ?>

<style type="text/css">
    
.top-bar a {
    color: #e8e8e8;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}

.top-bar {
  
    border-bottom: 1px solid #b71d1d;
    border-top: 1px solid #b71d1d;
}

</style>

<?php } ?>

 <?php if (get_option_tree('topbar_color') == 'Orange') { ?>

<style type="text/css">
    
.top-bar a {
    color: #e8e8e8;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}

.top-bar {
  border-bottom: 1px solid #e0801c;
    border-top: 1px solid #e0801c;
}

</style>

<?php } ?>

 <?php if (get_option_tree('topbar_color') == 'Pink') { ?>

<style type="text/css">
    
.top-bar a {
    color: #e8e8e8;
    text-shadow: 1px 1px 1px rgba(0, 0, 0, 0.4);
}

.top-bar {
  border-bottom: 1px solid #d2386a;
    border-top: 1px solid #d2386a;
}

</style>

<?php } ?>


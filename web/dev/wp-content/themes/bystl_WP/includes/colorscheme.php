<?php if (get_option_tree('background_pattern') == 'Yes') { 
    $custom_bg = explode(",",get_option_tree('custom_bg')); 
?>
<style type="text/css">
    body {
      background: url(<?php echo $custom_bg[4] ?>) <?php echo $custom_bg[1] ?> <?php echo $custom_bg[2] ?> <?php echo $custom_bg[3] ?> <?php echo $custom_bg[0] ?> !important;
    }
    /* stupid admin bar... go away! */
    html { margin-top: 0 !important; }
</style>
<?php } ?>
<?php 
    $bgPattern = get_option_tree('choose_pattern'); 
    $btnColor = get_option_tree('buttons_color');
    $topBarColor = get_option_tree('topbar_color');

// FINAL OUTPUT VARS

    $bgClass = 'bg_' . $bgPattern;
    $btnClass = 'btnTheme_' . $btnColor;
    $topBarClass = 'topBarTheme_' . $topBarColor;

    $colorSchemeClass = $bgClass . ' ' . $btnClass . ' ' . $topBarClass;

?> 
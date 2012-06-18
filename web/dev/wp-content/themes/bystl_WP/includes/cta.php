<div class="container-fluid">
  
  
    <div class="callout row-fluid clearfix">

      <div class="callout-info">

          <?php echo get_option_tree('cta_content') ?>

      </div>

    <?php if (get_option_tree('cta_btn') == 'Yes') { ?>
      

        <a class="big-btn blue rounded-1" href="<?php echo get_option_tree('cta_btn_url') ?>"><?php echo get_option_tree('cta_btn_text') ?></a>


    <?php } ?>
    </div>

  
</div>
<div class="container-fluid">


    <div class="callout row-fluid clearfix">

      <div class="callout-info">

          <?php echo get_option_tree('cta_content') ?>

      </div>

    <?php if (get_option_tree('cta_btn') == 'Yes') { ?>


        <a class="btn btn-large btn-primary" data-toggle="modal" data-target="#mbolModal" href="<?php echo get_option_tree('cta_btn_url') ?>" style="float: right; margin-top: 12px;"><?php echo get_option_tree('cta_btn_text') ?></a>


    <?php } ?>
    </div>


</div>
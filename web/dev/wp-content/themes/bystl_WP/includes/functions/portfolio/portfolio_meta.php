<?php

$portfolioImg = get_post_meta($post->ID, 'portfolioImg', true);

?>

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/includes/css/iPhoneCheckbox.css" media="screen" />

<script src="<?php bloginfo('template_url'); ?>/includes/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_url'); ?>/includes/js/jquery.iphone.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

	jQuery(document).ready(function() {

jQuery('#prettyPhoto').iphoneStyle();

                jQuery('#portfolio_prettyPhoto').iphoneStyle();
				jQuery('#portfolioArticle').iphoneStyle();

		jQuery('#uploadPortfolio_1').each(function(){

			var the_button = jQuery(this);
			var image_input = jQuery('#portfolioImg');
			var image_id = jQuery(this).attr('id');

			new AjaxUpload(image_id, {

				  action: ajaxurl,
				  name: image_id,

				  // Additional data
				  data: {
					action: 'ddpanel_ajax_upload',
					data: image_id
				  },

				  autoSubmit: true,
				  responseType: false,
				  onChange: function(file, extension){},
				  onSubmit: function(file, extension) {

						the_button.attr('disabled', 'disabled').val("Uploading...");

				  },

				  onComplete: function(file, response) {

						the_button.removeAttr('disabled').val("Upload Image");

						if(response.search("Error") > -1){

							alert("There was an error uploading:\n"+response);

						}

						else{

							image_input.val(response);

						}

					}
			});
		});

	});

</script>



<p>

    <label for="portfolioImg"><strong>Portfolio Image<span style="color:#f00;">*</span>:</strong></label>
	<input type="text" class="widefat" name="portfolioImg" id="portfolioImg" value="<?php echo $portfolioImg; ?>" />

</p>
    <p style="text-align: right;">

    	<input type="button" name="" class="button-primary autowidth" id="uploadPortfolio_1" value="Upload Image" />

    </p>

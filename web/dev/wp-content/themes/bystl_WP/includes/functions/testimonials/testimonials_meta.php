

<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url'); ?>/includes/css/iPhoneCheckbox.css" media="screen" />

<script src="<?php bloginfo('template_url'); ?>/includes/js/ajaxupload.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php bloginfo('template_url'); ?>/includes/js/jquery.iphone.min.js" type="text/javascript" charset="utf-8"></script>

<script type="text/javascript">

	head.ready(function(){

$('#prettyPhoto').iphoneStyle();

                $('#testimonials_prettyPhoto').iphoneStyle();
				$('#testimonialsArticle').iphoneStyle();

		$('#uploadtestimonials_1').each(function(){

			var the_button = $(this);
			var image_input = $('#testimonialsImg');
			var image_id = $(this).attr('id');

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




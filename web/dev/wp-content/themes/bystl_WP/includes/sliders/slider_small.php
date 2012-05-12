<div class="slider clearfix">

            <div class="container">

                <div class="row">

                    <div class="span-one-third slider-intro">

                        <h1><?php echo get_option_tree('slider_title') ?></h1>

                        <p><?php echo get_option_tree('slider_text') ?></p>
                        
                         <?php if (get_option_tree('button_text') == 'Yes') { ?>
                        
                        <a class="small-btn blue rounded-1" href="<?php echo get_option_tree('button_url') ?>"><?php echo get_option_tree('button_text_text') ?></a>

                            <?php } ?>
                    </div>

                    <div class="span-two-thirds">

                        <div id="slider">

                            <ul class="images">

                              <?php

	if(function_exists('get_option_tree')) {

		$slides = get_option_tree('slides', $option_tree, false, true, -1);
		$i = 1;
		foreach($slides as $slide) {

			if($i <= 8) {

				echo '<li><a href="'.$slide['link'].'"><img src="'.get_bloginfo('template_url').'/includes/timthumb.php?q=100&amp;w=620&amp;h=330&amp;zc=1&amp;src='.$slide['image'].'" alt="'.$slide['title'].'" /></a></li>';

			} else { break; }

			// increase $i by 1
			$i++;

		}

	}

?>
                            </ul>

                            <ul class="slider-nav clearfix">

                              <?php

	if(function_exists('get_option_tree')) {

		$slides = get_option_tree('slides', $option_tree, false, true, -1);
		$i = 1;
		foreach($slides as $slide) {

			if($i <= 8) {

				echo '<li><a href="#">'.$slide['title'].'</a></li>';

			} else { break; }

			// increase $i by 1
			$i++;

		}

	}

?>
                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>
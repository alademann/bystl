 <div class="slider clearfix">

            <div class="container-fluid">

                <div class="row-fluid">

                        <div class="span-one-third slider-intro">

                        <p><strong class="h1"><?php echo get_option_tree('slider_title') ?></strong></h1>

                        <p><?php echo get_option_tree('slider_text') ?></p>

                      <?php if (get_option_tree('button_text') == 'Yes') { ?>
                        
                        <a class="small-btn blue rounded-1" href="<?php echo get_option_tree('button_url') ?>"><?php echo get_option_tree('button_text_text') ?></a>

                            <?php } ?>

                    </div>

                    <div class="span-two-thirds">

                        <div id="slider-thumbs">

                            <ul class="images-thumb">


                                <?php
                                
if(function_exists('get_option_tree')) {

		$slides = get_option_tree('slides', $option_tree, false, true, -1);
		$i = 1;
		foreach($slides as $slide) {

			if($i <= 8) {

				echo '<li><a href="'.$slide['link'].'"><img width="620" height="330" src="'.$slide['image'].'" alt="'.$slide['title'].'" /></a></li>';

			} else { break; }

			// increase $i by 1
			$i++;

		}

	}
?>

                            </ul>

                            <ul class="slider-nav-thumbs clearfix">


                                <?php
if(function_exists('get_option_tree')) {

		$slides = get_option_tree('slides', $option_tree, false, true, -1);
		$i = 1;
		foreach($slides as $slide) {

			if($i <= 8) {

				echo '<li><a href="#"><img width="45" height="45" src="'.$slide['image'].'" alt="'.$slide['title'].'" /></a></li>';

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
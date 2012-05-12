 <div id="alternate">

            <div class="container clearfix">

                <ul class="row">

               

                      <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Dark Footer")); ?>

                    

                </ul>

            </div>

        </div>


        <div class="footer">

            <div class="container">

                <div class="row">

 <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar("Light Footer")); ?>

                </div>

            </div>

        </div>

        <div class="small-footer container">

            <div class="footer-left"><p><?php echo get_option_tree('footer_left_content') ?></p></div>

            <div class="footer-right"><p><?php echo get_option_tree('footer_right_content') ?></p></div>

        </div>

  </body>

</html>


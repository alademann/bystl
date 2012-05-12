<?php

function rm_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>



    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
        <div id="comment-<?php comment_ID(); ?>" class="clearfix">


            <!-- Comment -->

            <div class="comment-info">

    <?php echo get_avatar($comment, $size = '70'); ?>

            </div>

            <div class="comment-content">

                <div class="comment-meta clearfix">

                    <div class="comment-author">
                        
                         <span><?php comment_author_link() ?></span>
    <?php printf(__('%s'), get_comment_date()) ?> at <?php printf(__('%s'), get_comment_time()) ?>
    
                        
                    </div>
                    
       <div class="comment-reply">
						<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						</div>

                </div>

                <p><?php comment_text(); ?></p>
                
                
            <?php if ($comment->comment_approved == '0') : ?>
                <em><?php _e('Your comment is awaiting moderation.', 'localization'); ?></em>
                <br />
    <?php endif; ?>

            </div>

        </div>
        <?php
    }
    ?>
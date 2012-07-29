<?php

/**

 * @package WordPress

 * @subpackage Default_Theme

 */



// Do not delete these lines

	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))

		die ('Please do not load this page directly. Thanks!');



	if (post_password_required()) {
    ?>

    <p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'localization'); ?></p>

    <?php
    return;
}



global $id;

$id = $post->ID;
?>



<!-- You can start editing here. -->


<?php if (have_comments()) : ?>
<div class="clearfix"></div>
<span class="h3 comment-h3" style="margin-top:30px; line-height: 27px;" id="n_comments"><?php comments_number(__('No Comments', 'localization'), __('One Comment', 'localization'), __('% Comments', 'localization') );?> <?php _e('to', 'localization'); ?> "<?php the_title(); ?>"</span>

<ol id="comments" class="commentlist page-content">

    <?php wp_list_comments('avatar_size=80&style=ol&callback=rm_comments'); ?>

</ol>




<?php else : // this is displayed if there are no comments so far ?>



    <?php if (comments_open()) : ?>

        <!-- If comments are open, but there are no comments. -->



    <?php else : // comments are closed ?>

        <!-- If comments are closed. -->

        <p class="nocomments"><?php _e('Comments are closed.', 'localization'); ?></p>

    <?php endif; ?>

<?php endif; ?>





<?php if (comments_open()) : ?>

    <div class="page-content clearfix comments-wrapper">
       
        <div class="leave-reply" id="respond">
            
            <span class="h3"><?php comment_form_title(__('Leave a Reply', 'localization'), __('Leave a Reply to %s', 'localization') ); ?></span>
            
        </div>

    <?php if (get_option('comment_registration') && !is_user_logged_in()) : ?>

        <p><?php _e('You must be', 'localization'); ?> <a href="<?php echo wp_login_url(get_permalink()); ?>"><?php _e('logged in', 'localization'); ?></a> <?php _e('to post a comment.', 'localization'); ?></p>

    <?php else : ?>

        <form class="form-horizontal" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

        <?php if (is_user_logged_in()) : ?>

            <p><?php _e('Logged in as', 'localization'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account"><?php _e('Log out', 'localization'); ?> &raquo;</a></p>

        <?php else : ?>
                
            <fieldset class="comment-form author-info">

                <label for="author"><?php _e('Name', 'localization'); ?> <?php if ($req) echo "*"; ?>: </label>
                <input class="short" type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="40" tabindex="1" <?php if ($req) echo "aria-required='true'"; ?> />

                <label for="email"><?php _e('Mail', 'localization'); ?> <?php if ($req) echo "*"; ?>: <em><?php _e('won&acute;t be published', 'localization'); ?></em></label>
                <input class="short" type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="40" tabindex="2" <?php if ($req) echo "aria-required='true'"; ?> />

                <label for="url"><?php _e('Website', 'localization'); ?></label>
                <input class="short" type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="40" tabindex="3" />

            </fieldset>

        <?php endif; ?>

        <!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

            <fieldset class="comment-form comment-content">
              
                <label for="comment"><?php _e('Comment', 'localization'); ?>*:</label>

                <textarea name="comment" id="comment" rows="10" tabindex="4"></textarea>

                <div class="btn-group pull-right">
                    <a class="btn pull-left" rel="nofollow" id="cancel-comment-reply-link" href="#respond">Cancel</a>

                    <input name="submit" type="submit" class="pull-left btn btn-primary" id="submit" tabindex="5" value="<?php _e('Submit', 'localization'); ?>" />
                </div>

                <?php
                comment_id_fields();
                ?>     

                <?php do_action('comment_form', $post->ID); ?>

            </fieldset>

        </form>

    <?php endif; // If registration required and not logged in  ?>

    </div>

<?php endif; // if you delete this the sky will fall on your head  ?>
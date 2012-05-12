<div class="home-portfolio container clearfix">

        <?php
        global $paged;

        $arguments = array(
            'post_type' => 'portfolio_posts',
            'post_status' => 'publish',
            'paged' => $paged
        );

        $portfolio_query = new WP_Query($arguments);

        dd_set_query($portfolio_query);
		$i = 0;
        ?>

        <?php if ($portfolio_query->have_posts()) : while ($portfolio_query->have_posts()) : $portfolio_query->the_post(); ?>

        		<?php if($i == 0 || ($i % 3 == 0)) { echo '<ul class="row">'; } //// IN THE BEGINNING OF THE FIRST OR EVERY OTHER 4TH, 7TH ETC SHOWS THE UL ?>

                <li class="home-portfolio-item span-one-third">

                    <a href="<?php the_permalink(); ?>"><img src="<?php bloginfo('template_url'); ?>/includes/timthumb.php?q=100&amp;w=300&amp;h=182&amp;zc=1&amp;src=<?php echo get_post_meta($post->ID, 'portfolioImg', true) ?>" alt="" /></a>

                    <span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span>

                </li>

        		<?php if((($i+1) % 3 == 0) || (($i+1) == $portfolio_query->found_posts)) { echo '</ul>'; } //// CLOSES THE UL IF IT's THE LAST OF A SET OF LIs OR THE LAST ITEMS OF ALL (AVOIDS HAVING A FLOATING LI WITHOUT A CLOSE UL) ?>

                <?php $i++; ?>

<?php endwhile; ?>

        <?php endif; ?>

</div>

<?php if($i >= 4) { ?>

<div class="container portfolio-pager">


    <div id="portfolio-pager"></div>
    
        <?php } else { ?>

    <div style="height: 20px;" class="spacer"></div>

    <?php } ?>

</div>

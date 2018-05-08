<?php 
  get_header(); 
?>
<div class="blocktainer col-md-12 col-lg-12" >
 
<?php

      $colorcounter = 0;
      if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>



          <div class="block-item">
          <div class="text-side col-md-6 col-lg-6">
                <h1 title="<?php the_title_attribute(); ?>" class="main-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <p><?php the_excerpt(); ?></p>
            </div>            
            <div class="image-side col-md-6 col-lg-6 hidden-sm-down ">
                     <span class="postmeta"><p class="postdate">
                        <i class="far fa-clock"></i><time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time>
                    </span>
            </div>
          </div>
        <?php endwhile;
        
        else: ?>
          <div class="post-content">
              <p><?php _e('Sorry, it seems there are no posts available.', 'chaukor'); ?></p>
              <?php get_search_form(); ?>
          </div><!-- post-content END! -->
                
      <?php endif; ?>

  <!-- navigation?-->
  <?php chaukor_pagination_numeric_posts_nav(); ?>

</div> <!-- close content main -->

</div> <!-- row main -->
<!-- start of footer -->
<?php get_footer(); ?>

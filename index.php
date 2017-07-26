<?php 
  get_header(); 
?>
<div class="blocktainer col-md-12 col-lg-12" >
 
<?php if ( !get_theme_mod( 'display_featured_content', 'showslider' ) == 'showslider') : ?>
 <div class="image-side hidden-sm-up col-sm-12">
<?php  if ( has_post_thumbnail() ) {?>

 <?php the_post_thumbnail('full', ['class' => 'img-fluid', 'title' => 'Feature image']);?>
          
 <?php } else { ?>		
              <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-pic-available.jpg" alt="<?php the_title_attribute(); ?>" width="3840" class="d-block img-fluid wp-post-image" />		
              <?php }  ?>
 </div>  
  <?php  endif;  ?>
 
<?php
      $colorcounter = 0;
      if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
          <div class="block-item <?php if($colorcounter == 1) { echo 'even-color'; } else { echo 'uneven-color'; } ?>">
            <div class="text-side col-sm-12 col-md-5 col-lg-6">
                <h1 title="<?php the_title_attribute(); ?>" class="main-title"><?php the_title(); ?></h1>
                <p><?php the_excerpt(); ?></p>
                 <a class="btn btn-primary readmore-btn" href="<?php the_permalink(); ?>?bg=<?php echo $colorcounter ?>" role="button" title="<?php the_title_attribute(); ?>" ><?php _e('Read more', 'chaukor'); ?></a>
                <p class="postdate"><i class="fa fa-clock-o" aria-hidden="true"></i><time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time></p>         
</div>            
            <div class="image-side col-md-7 col-lg-6 hidden-sm-down ">
              <?php
              if ( has_post_thumbnail() ) {
                  the_post_thumbnail('full', ['class' => 'img-fluid', 'title' => 'Feature image']);
              }
              else { ?>		
              <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-pic-available.jpg" alt="<?php the_title_attribute(); ?>" width="3840" class="d-block img-fluid wp-post-image" />		
              <?php }  ?>
            </div>
          </div>
          <?php $colorcounter++; 
          if ($colorcounter == 3) {
            $colorcounter = 1;
          }

?>
          <?php endwhile; else: ?>
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

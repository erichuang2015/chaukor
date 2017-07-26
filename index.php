<?php 
  get_header(); 
?>
<div class="blocktainer col-md-12 col-lg-12" >
<div class="image-side hidden-sm-up col-sm-12">
<?php
              if ( has_post_thumbnail() ) {
                  the_post_thumbnail('full', ['class' => 'img-fluid', 'title' => 'Feature image']);
              }

?>
</div>
<?php
      $colorcounter = 0;
      if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
          <div class="block-item <?php if($colorcounter == 1) { echo 'even-color'; } else { echo 'uneven-color'; } ?>">
            <div class="text-side col-sm-12 col-md-5 col-lg-5">
                  <a href="<?php the_permalink(); ?>">
                      <h1 title="<?php the_title_attribute(); ?>" class="main-title"><?php the_title(); ?></h1>
                  </a>
                <p><?php the_excerpt(); ?></p>
                <i class="fa fa-clock-o" aria-hidden="true"></i><time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time>
 
         
            </div>            
            <div class="image-side hidden-sm-down col-md-7 col-lg-7">
              <?php
              if ( has_post_thumbnail() ) {
                  the_post_thumbnail('full', ['class' => 'img-fluid', 'title' => 'Feature image']);
              }?>
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

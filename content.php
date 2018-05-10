
<?php
      if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>



          <div class="block-item">
          <div class="text-side col-md-6 col-lg-6">
                <h1 title="<?php the_title_attribute(); ?>" class="main-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                <p><?php the_excerpt(); ?></p>
            </div>            
            <div class="image-side col-md-6 col-lg-6 d-none d-sm-none d-md-block">
                     <div class="postmeta"><p class="postdate">
                        <i class="far fa-clock"></i><time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time>
                        <br />
                        <i class="far fa-user"></i><?php the_author_meta('user_nicename');?>
                        <?php if ( get_theme_mod( 'show_tags' ) == 'showtags' ) : ?>
                        <p class="tagslist">
                            <?php the_tags( '<i class="fas fa-tags" aria-hidden="true"></i>', ' ', ' ' ); ?> 
                            <?php endif; ?>
                        </p>
                      </div>
            </div>
          </div>
        <?php endwhile;
               
 endif; ?>


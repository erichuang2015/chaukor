<?php 
  get_header(); 
?>

  <div class="blocktainer col-md-12 col-lg-12" >
<?php      if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?>
     <div <?php post_class(); ?>>
        <article>
        <div class="block-item block-item-single">
     
            <div class="text-side text-side-single col-sm-12 col-md-6 col-lg-6">
            <span class="postmeta postmeta-single">
                <p class="postdate"><i class="far fa-clock"></i><time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time></p>
                <div class="post-info">
                     <?php if ( get_theme_mod( 'show_author_section' ) == 'hideauthor' ) :?>
                    <p class="postdate"><i class="fa fa-user" aria-hidden="true"></i><?php the_author_posts_link();?></p>
                    <?php endif; ?>
                    <?php if(has_tag()) { ?>
                        <?php if ( get_theme_mod( 'show_tags' ) == 'showtags' ) : ?>
                        <p class="tagslist">
                            <?php the_tags( '<i class="fas fa-tags" aria-hidden="true"></i>', ' ', ' ' ); ?> 
                            <?php endif; ?>
                        </p>
                        <?php } ?>
                    <?php if (get_theme_mod( 'show_categories' ) == 'showcategories' ) { ?>
                    <?php if(has_category()) { ?>
                    <p>
                            <i class="fas fa-list" aria-hidden="true"></i></span>
                            <?php $categories = get_the_category();
                                $separator = ', ';
                                $output = '';
                                if ( ! empty( $categories ) ) {
                                    foreach( $categories as $category ) {
                                        $output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' 
                                        . esc_html( $category->name ) . '</a>' . $separator;
                                    }
                                    echo trim( $output, $separator );
                            } ?>
                     </p>
                            <?php 
                                }
                    } ?>
                 </div><!-- close post-info -->            
            </span>
            <h1 title="<?php the_title_attribute(); ?>" class="main-title main-title-post"><?php the_title(); ?></h1>
            <p><?php the_content(); ?></p>
                 <?php wp_link_pages('before=<ul class="pagination pagination-within center-align" role="navigation">&link_before=<li>&link_after=</li>&after=</ul>'); ?>
                     <?php if ( get_theme_mod( 'show_author_section' ) == 'showauthor' ) :
                        get_template_part( 'partials/authorsection' ); 
                    endif; ?>

                <?php if( comments_open() ) { ?>
                <!-- let user enter a comment -->
                <?php comments_template(); ?>
                <?php }
                        ?>
            </div>            
            <div class="image-side col-sm-12 col-md-6 col-lg-6">
              <?php
                          if ( has_post_thumbnail() ) {
                              the_post_thumbnail('full', ['class' => 'img-fluid', 'title' => 'Feature image']);
                          }
                          else { ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/no-pic-available.jpg" class="img-fluid wp-post-image" />
                        <?php  }
              ?>
              </div>

            </div><!-- close block item -->
       </article><!-- close article -->
 
            </div><!-- close block item -->
         </article>
         </div><!-- close post class-->   
          </div><!-- close blocktainer -->
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
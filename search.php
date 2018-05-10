<?php
/*
Template Name: Search Page
*/
?>

<?php get_header(); ?>

<div class="row">

  <?php if ( get_theme_mod( 'sidebar_position' ) == 'left' ) : ?>
  <!-- second column (widget bar) -->
  <?php get_sidebar( 'primary' ); ?>
  <?php endif; ?>

<div class="main-content <?php if ( is_active_sidebar('primary')) { echo 'col-md-8 col-lg-8'; } else { echo 'col-md-12 col-lg-12';};?>">

    <div class="blocktainer col-md-12 col-lg-12" id="blocktainer">

    <?php
    $s=get_search_query();
    $args = array(
      's' =>$s
    );
    // The Query
    $the_query = new WP_Query( $args );
    if ( $the_query->have_posts() ) {
            while ( $the_query->have_posts() ) {
            $the_query->the_post();
                    ?>
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

   <?php    }
    } else {?>

        <p><?php _e('Sorry, it seems this search query has no posts.', 'chaukor'); ?></p>


        <?php get_search_form(); ?>
    <?php } ?>
 </div>
</div><!-- end main-content -->

  <?php if ( get_theme_mod( 'sidebar_position' ) == 'right' ) : ?>
  <!-- second column (widget bar) -->
  <?php get_sidebar( 'primary' ); ?>
  <?php endif; ?>
</div><!-- end row -->

<!-- start of footer -->
<?php get_footer(); ?>

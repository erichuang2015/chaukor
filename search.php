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
 
    <h1 class="text-left-title-featured-sidebar truncate"><?php _e('Results for ', 'chaukor'); echo '<strong class="strong-search">' . get_query_var("s") . '</strong>'; ?> </h1>
    <div class="collection">

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
                <div class="collection-item">
                    <a href="<?php the_permalink(); ?>">
                    <p title="<?php the_title_attribute(); ?>" class="truncate"><?php if ( is_sticky() ) {?><i class="fa fa-star <?php echo 'sticky';?>" aria-hidden="true"></i><?php } else {?><i class="fa fa-circle" aria-hidden="true"></i><?php }; the_title(); ?>
                        <span class="badge">
                            <time datetime="<?php echo get_the_date('c'); ?>"><?php echo human_time_diff( get_the_time('U'), current_time('timestamp')); echo '&nbsp;'; _e('ago', 'chaukor'); ?></time>
                        </span> 
                    </p>
                    </a>
                </div>

   <?php    }
    } else {?>

        <div class="collection-item">
            <p><i class="fa fa-circle" aria-hidden="true"></i><?php _e('Sorry, it seems this search query has no posts.', 'chaukor'); ?></p>
        </div>


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

<?php
/*
// Template Name: Privacy Policy Template
*/
get_header();
?>

<!--page-title-area start-->
<section class="page-title-area page-title-blog-details grey-bg pt-220 pb-100 pt-lg-200 pt-md-160 pt-xs-160 pb-xs-90">
    <img aria-hidden="true" class="page-shape shape_01 blog-shape-3 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-11.png" alt="">
    <img aria-hidden="true" class="page-shape shape_04 d-none d-md-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/orange-1.svg" alt="">
    <img aria-hidden="true" class="page-shape shape_05 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/round-line-a.svg" alt="">
    <img aria-hidden="true" class="page-shape shape_06 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/berry-1.svg" alt="">
    <img aria-hidden="true" class="page-shape-02 shape_08 d-none d-lg-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/shape/dot-a.svg" alt="">
    <img aria-hidden="true" class="page-shape blog-shape-4 d-none d-xxl-inline-block" src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/line/line-12.png" alt="">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12">
                <div class="page-title-wrapper text-center">
                    <h1 class="h1 page-title mb-25"><?php echo get_the_title(); ?></h1>
                    <div class="blog-meta mb-25">
                        <a href="javascript:void(0)" class="meta-links">Last Updated: <?php echo get_the_modified_date('F j, Y'); ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--page-title-area end-->

<!--comic-blog start-->
<section class="comic-blog position-relative pt-120 pb-120 pt-lg-80 pb-lg-80 pt-md-60 pb-md-60 pt-xs-60 pb-xs-60">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-8">
                <?php the_content(); ?>
                <div class="row px-0 align-items-center mt-65 mb-40">
                    <div class="col-lg-6 col-md-6">
                        <div class="tag_cloud mb-25">
                            <?php 
                            $post_tags = get_the_tags();
                            if ( ! empty( $post_tags ) ) {
                                foreach ( $post_tags as $tag ) {
                                    echo '<a class="tag" href="' . esc_attr( get_tag_link( $tag->term_id ) ) . '">' . __( $tag->name ) . '</a>';
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="single-widget-area sticky-top">
                    <?php if (is_active_sidebar('single-post-sidebar')) : ?>
                        <?php dynamic_sidebar('single-post-sidebar'); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div><!--/.row-->
    </div><!--/.container-->
</section>
<!--comic-blog end-->

<?php
get_footer();

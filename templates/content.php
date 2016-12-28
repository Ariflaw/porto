<?php

$grid = '';
$thumb_class = '';
if ( has_post_thumbnail() ) {
    $grid = 'col-md-6';
} else {
    $grid = 'col-md-12';
    $thumb_class = 'no_thumbnail';
}

?>
<article <?php post_class( "row  $thumb_class" ); ?>>
    <?php if ( has_post_thumbnail() ): ?>
        <div class="post_thumbnail col-md-6">
            <?php porto_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
    <div class="post_content <?php echo $grid; ?>">
        <?php Roots\Sage\Extras\porto_categories(); ?>
        <header>
            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php get_template_part('templates/entry-meta'); ?>
        </header>
        <div class="entry-summary">
            <?php the_excerpt(); ?>
        </div>
    </div>
</article>

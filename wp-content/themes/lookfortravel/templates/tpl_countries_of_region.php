<?php
/*
Template Name: Шаблон стран региона
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
    $region_this = get_field('region_this');
    $image = get_field('rating_img'); 
?>
<main class="section-main uk-section">
	<div class="uk-container uk-container-small">
        <?php 
            $args = array(
                'taxonomy' => 'location',
                // 'meta_key' => 'position_rating',
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'hide_empty'    => false, 
                'parent'      => $region_this,
                'hierarchical'  => true, 
            ); 

        $categories = get_terms($args);
        ?>
		<ul class="tm-list-divider uk-list uk-list-divider uk-text-large">
        <?php if( $categories ):
            foreach( $categories as $cat ) {
                $position_rating = (int) get_field('position_rating', $cat->taxonomy . '_' . $cat->term_id);
            ?>
            <li><a href="<?php echo get_term_link($cat->term_id); ?>"><span class="<?php 
            get_color_of_position_rating($position_rating);
            ?> star uk-margin-right"><?php echo $position_rating; ?></span><?php echo $cat->name; ?></a></li>
            <?php } ?>
        <?php else: ?>
            <li><a href="#">Не найдено.</a></li>
        <?php endif; ?>
        </ul>
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <?php get_template_part( 'templates/show-rate', 'more' ); ?>
        <?php endif; ?>
		<?php wp_reset_query();?>
	</div>
</main>

<header class="section-header section-header-small uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/header-cat-aircraft.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
    <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<h1 itemprop="name"><?php the_title(); ?></h1>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
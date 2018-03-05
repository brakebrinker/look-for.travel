<?php get_header(); ?>
<?php 
$blog_descr = get_field('blog_page_descr', get_queried_object_id());
$blog_img = get_field('blog_page_img', get_queried_object_id());

?>
<header class="section-header uk-light" style="background-image: url(<?php if( !empty($blog_img) ) echo $blog_img['url']; else echo get_template_directory_uri() . '/images/sample/header-blog.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
		<?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
        <?php if ( have_posts() ) : ?>
			<h1 itemprop="name"><?php single_post_title(); ?></h1>
			<div class="desc uk-container uk-container-small" itemprop="description">
				<?php echo $blog_descr; ?>
			</div>
        <?php endif; ?>
		</div>
	</div>
</header>

<main class="section-main">
	<div class="uk-container uk-margin-small-top">
	<?php 
	$args = array(
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => 'blog'
			)
		)
	);
	query_posts( $args );
	?>
		<?php if ( have_posts() ) : ?>
		<div class="section-cards uk-section">
			<div id="posts-results" class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
            <?php while ( have_posts() ) : the_post(); 
				get_template_part( 'templates/post', 'preview' );
            ?>
			<?php endwhile; ?>
			</div>
		</div>
		<?php if (  $wp_query->max_num_pages > 1 ) : ?>
			<?php get_template_part( 'templates/show', 'more' ); ?>
		<?php endif; ?>
		<?php else: ?>
        <div class="section-cards uk-section">
			<div class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
                Публикаций не найдено.
			</div>
		</div>
        <?php endif; ?>
	</div>
</main>

<?php get_footer(); ?>
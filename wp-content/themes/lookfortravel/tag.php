<?php get_header(); ?>
<?php
$queried_object = get_queried_object();
$taxonomy = $queried_object->taxonomy;

$blog_descr = get_field('blog_page_descr', get_queried_object_id());
$tag_img = get_field('taxonomy_term_img', $taxonomy . '_' . get_queried_object_id());
?>

<main class="section-main">
	<div class="uk-container uk-margin-small-top">
        
		<form id="posts-filter" class="section-filters uk-clearfix" method="get">
			<input type="text" name="s" class="uk-input uk-form-width-medium" placeholder="Уточнить место" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>">
			<span class="status-query"></span>
		</form>
		<?php if ( have_posts() ) : ?>
		<div id="search-posts-results">
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
		</div>
        <?php endif; ?>
	</div>
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($tag_img) ) echo $tag_img['url']; else echo get_template_directory_uri() . '/images/sample/header-cafe.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
        <?php if ( have_posts() ) : ?>
			<h1 itemprop="name"><?php echo sprintf( __( 'Публикации с меткой "%s"' ), single_term_title( '', false ) ); ?></h1>
			<div class="desc uk-container uk-container-small" itemprop="description">
            <?php echo term_description(); ?>
            </div>
        <?php endif; ?>
		</div>
	</div>
</header>
<?php get_footer(); ?>
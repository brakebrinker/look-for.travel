<?php get_header(); ?>
<main class="section-main uk-margin-small-top uk-margin-large-bottom">
	<div class="uk-container uk-container-small">
		<form action="<?php bloginfo( 'url' ); ?>" class="section-filters" method="get">
			<div class="uk-inline uk-width-1-1">
                <button class="uk-form-icon uk-form-icon-flip fa fa-search"></button>
			    <input class="uk-input" type="search" name="s" value="<?php if(!empty($_GET['s'])){echo $_GET['s'];}?>" placeholder="Поиск">
			</div>
        </form>

        <?php $args = array_merge( $wp_query->query, array( 'post_type' => "post") );
        query_posts($args); ?>
        <?php if ( have_posts() ) : ?>
		<div id="posts-results" class="uk-margin-large" uk-margin="margin: uk-margin-top">
            <?php while ( have_posts() ) : the_post(); 
            $image = get_field('blog_img'); 
            ?>
			<article class="search-result uk-clearfix">
                <img src="<?php echo $image['sizes']['medium']; ?>" srcset="<?php echo $image['sizes']['medium_large']; ?> 2x" alt="<?php if ($image['alt']) echo $image['alt']; else the_title(); ?>" width="200" height="200" class="uk-float-right uk-visible@m">
				<div class="uk-text-small uk-margin-remove-bottom"><?php echo get_the_date(); ?></div>
				<h3 class="uk-margin-remove-top"><?php the_title(); ?></h3>
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>" class="uk-button uk-button-link" itemprop="url">Подробнее</a>
            </article>
            <?php endwhile; ?>
		</div>

        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
        <script>
        var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
        </script>
        <div id="true_loadmore_search" class="uk-margin-large-bottom uk-text-center"><button class="uk-button uk-button-default">Еще</button></div>
        <?php endif; ?>
        <?php else :
			echo '<p>Поиск не дал результатов.</p>';
		endif;
		?>
	</div>
</main>

<header class="section-header section-header-small uk-light" style="background-image: url(<?php echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<h1 class="regular" itemprop="name">Результаты по запросу "<?php if (!empty($_GET["s"])) echo $_GET["s"]; ?>"</h1>
		</div>
	</div>
</header>
<?php get_footer(); ?>
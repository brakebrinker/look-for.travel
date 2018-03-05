<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 

$related_tags = wp_get_object_terms( get_the_ID(), 'theme_tag', array( 'fields' => 'ids' ) );
$related_cats = array();
$relatedd_cats = get_the_terms( get_the_ID(), 'theme_category' );
foreach ($relatedd_cats as $rd_cat) {
    array_push($related_cats, $rd_cat->term_id);
}

$image = get_field('theme_img');
$theme_status_recomendation = get_field('theme_status_recomendation');
$theme_object_type = 'theme_object_type';

?>
<main class="section-main uk-section">
    <div class="uk-container uk-container-small uk-margin-large" itemprop="description">
        <?php the_content(); ?>
	</div>

	<div class="uk-container">
		<div class="rate-step" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
			<h2>Оцените статью</h2>
		    <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
		</div>

		<div class="section-comments uk-margin-large-top">
			<header class="uk-text-large" uk-toggle="target: .comments-widget; animation: uk-animation-fade">Комментарии <div class="uk-badge uk-margin-small-left">88</div></header>
			<main class="comments-widget" hidden>
				Виджет
			</main>
		</div>

		<h2>Метки</h2>
		<div class="uk-flex-center uk-grid uk-grid-small" itemprop="keywords">
            <?php echo get_the_term_list( get_the_ID(), 'theme_tag', '', '', '' ); ?>
		</div>
        <?php 

        $args = array(
            'posts_per_page' => 3,
            'post_type' => 'themes',
            'orderby' => 'rand',
            'tax_query' => array(
                'relation' => 'OR',
                array(
                    'taxonomy' => 'theme_tag',
                    'field' => 'id',
                    'include_children' => false,
                    'terms' => $related_tags,
                    'operator' => 'IN'
                ),
                array(
                    'taxonomy' => 'theme_category',
                    'field' => 'id',
                    'include_children' => false,
                    'terms' => $related_cats,
                    'operator' => 'IN'
                )
            )

        );
        $related_query = new WP_Query( $args );

        if( $related_query->have_posts() ) : ?>
        
            <h2>Еще по теме</h2>
            <div class="section-cards">
                <div id="posts-results" class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
                <?php 
                while( $related_query->have_posts() ) : $related_query->the_post();
                    get_template_part( 'templates/post', 'preview' );
                endwhile;
                ?>
                </div>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>
        <?php if ( $related_query->max_num_pages > 1 ) : ?>
        <script>
            var true_posts = '<?php echo serialize($related_query->query_vars); ?>';
            var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
            var max_pages = '<?php echo $related_query->max_num_pages; ?>';
        </script>
        <div id="true_loadmore" class="uk-margin-top uk-text-center"><button class="uk-button uk-button-default">Еще</button></div>
        <?php endif; ?>
		
	</div>
	
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<div class="badge">
                <?php foreach($relatedd_cats as $r_cat) { ?>
                <a class="uk-badge" href="<?php echo get_term_link( $r_cat->term_id ); ?>"><?php echo $r_cat->name; ?></a>
                <?php } ?>
			</div>
			<h1 class="regular" itemprop="name"><?php the_title(); ?></h1>
		</div>
		<div class="bottom uk-position-relative">
			<div class="meta uk-text-center"><span itemprop="author"><?php the_author(); ?></span>, <?php echo get_the_date(); ?></span></div>
			<meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
			<div class="geo-tags uk-position-bottom-left uk-visible@m" itemprop="contentLocation">
				<div>
					<a class="uk-badge" href="">Вьетнам</a>
					<a class="uk-badge" href="">Аюттхая</a>
					<a class="uk-badge geo-tags-more" uk-toggle="target: .geo-tags-more; animation: uk-animation-fade">еще 2</a>
				</div>
				<div hidden class="geo-tags-more uk-margin-small-top">
					<a class="uk-badge" href="">Вьетнам</a>
					<a class="uk-badge" href="">Аюттхая</a>
				</div>
			</div>
			<div class="addons uk-width-1-3 uk-child-width-expand uk-text-small uk-text-center uk-position-bottom-right uk-visible@m" uk-grid>
                <div>
                    <?php get_post_object_type($theme_object_type); ?>
                </div>
                <div>
                    <?php get_post_recommendet($theme_status_recomendation); ?>
                </div>
			</div>
		</div>
	</div>
</header>

<div class="section-header-bottom uk-hidden@m">
	<div class="uk-container">
		<div class="addons uk-child-width-expand uk-text-small uk-text-center" uk-grid>
            <div>
                <?php get_post_object_type($theme_object_type); ?>
            </div>
			<div>
				<?php get_post_recommendet($item_recommendet); ?>
			</div>
		</div>
		<div class="geo-tags">
			<div>
				<a class="uk-badge" href="">Вьетнам</a>
				<a class="uk-badge" href="">Аюттхая</a>
				<a class="uk-badge geo-tags-more2" uk-toggle="target: .geo-tags-more2; animation: uk-animation-fade">еще 2</a>
			</div>
			<div hidden class="geo-tags-more2 uk-margin-small-top">
				<a class="uk-badge" href="">Вьетнам</a>
				<a class="uk-badge" href="">Аюттхая</a>
			</div>
		</div>
	</div>
</div>
<?php endwhile; ?>
<?php get_footer(); ?>

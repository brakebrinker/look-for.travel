<?php
/*
Template Name: Шаблон рейтинга самолетов
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
	$image = get_field('rating_img'); 
	
	$p_args = array(
		'post_type'   => 'plane',
	); 

	$plane_items = get_posts($p_args);

	$p_habarite = array();
	$p_range_flight = array();
	$p_manufacturer = array();
	$p_feature = array();

	foreach ($plane_items as $plane) {
		$dimensions = get_field('plane_dimensions', $plane->ID);
		$range_flight = get_field('plane_range_flight', $plane->ID);
		$manufacturer = get_field('plane_manufacturer', $plane->ID);
		$feature = get_field('plane_feature', $plane->ID);

		if (array_search($dimensions, $p_habarite) === false) {
			array_push($p_habarite, $dimensions);
		}

		if (array_search($range_flight, $p_range_flight) === false) {
			array_push($p_range_flight, $range_flight);
		}
		
		if (array_search($manufacturer, $p_manufacturer) === false) {
			array_push($p_manufacturer, $manufacturer);
		}
		
		if (array_search($feature, $p_feature) === false) {
			array_push($p_feature, $feature);
		}
	}
	wp_reset_postdata();
?>
<main class="section-main">
	<pre><?php// print_r($plane_items) ?></pre>
	<div class="uk-container uk-margin-small-top uk-margin-large-bottom">
		<form id="planes-filter">
			<div class="section-filters uk-clearfix uk-flex uk-flex-center">
				<div class="uk-inline uk-visible@l">
					<input id="plane-name" name="plane-name" type="text" class="uk-input uk-form-width-small" placeholder="Название">
					<ul id="plane-name-results" class="form-results uk-list" hidden>
						<li><a href="">Таиланд</a></li>
						<li><a href="">Аюттхая — самый крупный город мира в XVIII столетии</a></li>
						<li><a href="">Таиланд</a></li>
					</ul>
				</div>
				<select name="habarite" class="uk-select uk-form-width-small uk-visible@l">
					<option value="none">Габариты</option>
					<?php get_options_in_select_text($p_habarite); ?>
				</select>
				<select name="range_flight" class="uk-select uk-form-width-small uk-visible@l">
					<option value="none">Дальность полета</option>
					<?php get_options_in_select_text($p_range_flight); ?>
				</select>
				<select name="manufacturer" class="uk-select uk-form-width-small uk-visible@l">
					<option value="none">Производитель</option>
					<?php get_options_in_select_text($p_manufacturer); ?>
				</select>
				<select name="feature" class="uk-select uk-form-width-small uk-visible@l">
					<option value="none">Особенности</option>
					<?php get_options_in_select_text($p_feature); ?>
				</select>
				<div class="uk-text-center uk-hidden@l">
					<button class="uk-button uk-button-small" uk-toggle="target: .mobile-filters; animation: uk-animation-fade">Фильтр</button>
				</div>
				<select class="uk-float-right uk-select uk-form-width-medium uk-visible@l">
					<option>Сортировка: по рейтингу</option>
					<option>Сортировка: по алфавиту</option>
				</select>
				<div class="uk-hidden@l" uk-form-custom>
		            <select>
						<option>Сортировка: по рейтингу</option>
						<option>Сортировка: по алфавиту</option>
		            </select>
		           <div class="mobile-sort"><i class="fa fa-sort-alpha-asc"></i></div>
		        </div>
			</div>
			<div class="mobile-filters uk-margin-top uk-hidden@l" hidden>
				<div class="uk-margin-small uk-text-center">
					<div class="uk-inline uk-width-1-1">
						<input type="text" class="uk-input" placeholder="Название">
						<ul class="form-results uk-list" hidden>
							<li><a href="">Таиланд</a></li>
							<li><a href="">Аюттхая — самый крупный город мира в XVIII столетии</a></li>
							<li><a href="">Таиланд</a></li>
						</ul>
					</div>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Габариты</option>
					</select>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Дальность полета</option>
					</select>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Производитель</option>
					</select>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Особенности</option>
					</select>
				</div>
			</div>
		</form>
    </div>

	<div class="uk-container uk-container-small">
        <?php $args = array(
                'post_type' => 'plane',
                'publish' => true,
                'paged' => get_query_var('paged'),
                'posts_per_page' => 2,
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_key' => 'position_rating'
            );

            query_posts($args);
        ?>
		<div id="filter-posts-results">
			<ul id="posts-rate-results" class="tm-list-divider uk-list uk-list-divider uk-text-large uk-margin-large-bottom">
			<?php if ( have_posts() ) : ?>
				<?php while ( have_posts() ) :
					the_post();
				?>
					<?php get_template_part( 'templates/rate-post', 'preview' ); ?>
				<?php endwhile; ?>
			<?php else: ?>
				<li><span>Самолетов не найдено.</span></li>
			<?php endif; ?>
			</ul>
			<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				<?php get_template_part( 'templates/show-rate', 'more' ); ?>
			<?php endif; ?>
			<?php wp_reset_query();?>
		</div>
	</div>
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/header-cat-aircraft.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
    <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<h1 itemprop="name"><?php the_title(); ?></h1>
			<div class="desc uk-container uk-container-small" itemprop="description">
				<?php echo get_field('rating_description'); ?>
			</div>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
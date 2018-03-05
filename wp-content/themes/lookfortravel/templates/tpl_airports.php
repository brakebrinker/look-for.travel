<?php
/*
Template Name: Шаблон рейтинга аэропортов
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
    $image = get_field('rating_img'); 
?>
<main class="section-main">
	<div class="uk-container uk-margin-small-top uk-margin-large-bottom">
		<form>
			<div class="section-filters uk-clearfix uk-flex uk-flex-center">
				<div class="uk-inline uk-visible@l">
					<input type="text" class="uk-input uk-form-width-small" placeholder="Название или код">
					<ul class="form-results uk-list" hidden>
						<li><a href="">Таиланд</a></li>
						<li><a href="">Аюттхая — самый крупный город мира в XVIII столетии</a></li>
						<li><a href="">Таиланд</a></li>
					</ul>
				</div>
				<select class="uk-select uk-form-width-small uk-visible@l">
					<option>Класс</option>
				</select>
				<select class="uk-select uk-form-width-small uk-visible@l">
					<option>Страна</option>
				</select>
				<div class="uk-text-center uk-hidden@l">
					<button class="uk-button uk-button-small" uk-toggle="target: .mobile-filters; animation: uk-animation-fade">Фильтр</button>
				</div>
				<select class="uk-float-right uk-select uk-form-width-medium uk-visible@l">
					<option>Сортировка: по рейтингу</option>
					<option>Сортировка: по дате</option>
					<option>Сортировка: по алфавиту</option>
				</select>
				<div class="uk-hidden@l" uk-form-custom>
		            <select>
						<option>Сортировка: по рейтингу</option>
		                <option>Сортировка: по дате</option>
						<option>Сортировка: по алфавиту</option>
		            </select>
		           <div class="mobile-sort"><i class="fa fa-sort-alpha-asc"></i></div>
		        </div>
			</div>
			<div class="mobile-filters uk-margin-top uk-hidden@l" hidden>
				<div class="uk-margin-small uk-text-center">
					<div class="uk-inline uk-width-1-1">
						<input type="text" class="uk-input" placeholder="Название или код">
						<ul class="form-results uk-list" hidden>
							<li><a href="">Таиланд</a></li>
							<li><a href="">Аюттхая — самый крупный город мира в XVIII столетии</a></li>
							<li><a href="">Таиланд</a></li>
						</ul>
					</div>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Класс</option>
					</select>
				</div>
				<div class="uk-margin-small uk-text-center">
					<select class="uk-select uk-form-width-1-1">
						<option>Страна</option>
					</select>
				</div>
			</div>
		</form>
	</div>

	<div class="uk-container uk-container-small">
        <?php $args = array(
                'post_type' => 'airport',
                'publish' => true,
                'paged' => get_query_var('paged'),
                'posts_per_page' => 4,
                'orderby' => 'meta_value_num',
                'order' => 'ASC',
                'meta_key' => 'position_rating'
            );

            query_posts($args);
        ?>
		<ul class="tm-list-divider uk-list uk-list-divider uk-text-large uk-margin-large-bottom">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) :
                the_post();
            ?>
                <?php get_template_part( 'templates/rate-post-airport', 'preview' ); ?>
            <?php endwhile; ?>
        <?php else: ?>
            <li><a href="#">Самолетов не найдено.</a></li>
        <?php endif; ?>
        </ul>
        <?php if (  $wp_query->max_num_pages > 1 ) : ?>
            <?php get_template_part( 'templates/show-rate', 'more' ); ?>
        <?php endif; ?>
		<?php wp_reset_query();?>
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
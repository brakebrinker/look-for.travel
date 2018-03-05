<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
$image = get_field('plane_img');
$plane_images = get_field('plane_gallery');
$advertising_block = get_field('advertising_block');

$plane_count_of_passenger = get_field('plane_count_of_passenger');
$plane_type_fuselage = get_field('plane_type_fuselage');
$plane_type_range_flight = get_field('plane_type_range_flight');
$plane_range_flight = get_field('plane_range_flight');
$plane_length = get_field('plane_length');
$plane_height = get_field('plane_height');
$plane_first_flight = get_field('plane_first_flight');
$plane_wingspan = get_field('plane_wingspan');
$plane_wing_area = get_field('plane_wing_area');
$plane_takeoff_weight = get_field('plane_takeoff_weight');
$plane_landing_weight = get_field('plane_landing_weight');
$plane_empty_weight = get_field('plane_empty_weight');
$plane_max_weight_fuel = get_field('plane_max_weight_fuel');
$plane_max_commercial_load = get_field('plane_max_commercial_load');
$plane_fuel_tank_capacity = get_field('plane_fuel_tank_capacity');
$plane_flight_range_with_max_loading = get_field('plane_flight_range_with_max_loading');
$plane_max_cruising_speed = get_field('plane_max_cruising_speed');
$plane_length_run = get_field('plane_length_run');
$plane_engines = get_field('plane_engines');
$plane_number_seats = get_field('plane_number_seats');
$plane_number_seats_busines = get_field('plane_number_seats_busines');
$plane_width_salon = get_field('plane_width_salon');
$plane_number_seats = get_field('plane_number_seats');

$points_rating = get_field('points_rating');
$position_rating = get_field('position_rating');


$post_type = get_post_type();
?>
<main class="section-main uk-section">
	<div class="uk-container uk-margin-large-bottom">
		<div class="uk-child-width-expand@m uk-text-center" uk-grid>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php get_type_fuselage($plane_type_fuselage); ?></div>
				<div class="uk-text-large">Максимальная пассажировместимость — <?php echo $plane_count_of_passenger; ?></div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php get_type_range_fuselage($plane_type_range_flight); ?></div>
				<div class="uk-text-large">Максимальная дальность полета - <?php echo $plane_range_flight; ?></div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $plane_first_flight; ?></div>
				<div class="uk-text-large">Первый полет</div>
			</div>
		</div>
	</div>
	<div class="uk-container uk-container-small" itemprop="description">
		<?php the_content(); ?>
	</div>
</main>
<div class="uk-section uk-section-muted">
	<div class="uk-container uk-margin-large">
		<h2>Основные характеристики</h2>
		<div class="chars-table" uk-grid>
			<div class="uk-width-1-2@m">
				<h3>Размеры</h3>
				<div class="uk-child-width-1-2" uk-grid>
					<div>
						<div>Длина</div>
						<div class="uk-text-large"><?php echo $plane_length; ?></div>
					</div>
					<div>
						<div>Высота</div>
						<div class="uk-text-large"><?php echo $plane_height; ?></div>
					</div>
					<div>
						<div>Размах крыльев</div>
						<div class="uk-text-large"><?php echo $plane_wingspan; ?></div>
					</div>
					<div>
						<div>Площадь крыла</div>
						<div class="uk-text-large"><?php echo $plane_wing_area; ?></div>
					</div>
				</div>
				<h3>Летные данные</h3>
				<div class="uk-child-width-1-2" uk-grid>
					<div>
						<div>Дальность полета с макс. загрузкой</div>
						<div class="uk-text-large"><?php echo $plane_flight_range_with_max_loading; ?></div>
					</div>
					<div>
						<div>Макс. крейсерская скорость</div>
						<div class="uk-text-large"><?php echo $plane_max_cruising_speed; ?></div>
					</div>
					<div>
						<div>Длина пробега</div>
						<div class="uk-text-large"><?php echo $plane_length_run; ?></div>
					</div>
					<div>
						<div>Двигатели</div>
						<div class="uk-text-large"><?php echo $plane_engines; ?></div>
					</div>
				</div>
			</div>
			<div class="uk-width-1-2@m">
				<h3>Вес</h3>
				<div class="uk-child-width-1-2" uk-grid>
					<div>
						<div>Макс. взлетный вес</div>
						<div class="uk-text-large"><?php echo $plane_takeoff_weight; ?></div>
					</div>
					<div>
						<div>Макс. посадочный вес</div>
						<div class="uk-text-large"><?php echo $plane_landing_weight; ?></div>
					</div>
					<div>
						<div>Вес пустого</div>
						<div class="uk-text-large"><?php echo $plane_empty_weight; ?></div>
					</div>
					<div>
						<div>Макс. вес без топлива</div>
						<div class="uk-text-large"><?php echo $plane_max_weight_fuel; ?></div>
					</div>
				</div>
				<h3>Пассажирский салон</h3>
				<div class="uk-child-width-1-2" uk-grid>
					<div>
						<div>Кол-во кресел (эконом)</div>
						<div class="uk-text-large"><?php echo $plane_number_seats; ?></div>
					</div>
					<div>
						<div>Кол-во кресел (эконом/бизнес)</div>
						<div class="uk-text-large"><?php echo $plane_number_seats_busines; ?></div>
					</div>
					<div>
						<div>Ширина салона</div>
						<div class="uk-text-large"><?php echo $plane_width_salon; ?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="uk-section">

	<h2>Фото самолета</h2>
	<?php if( $plane_images ): ?>
	<div class="gallery" uk-lightbox>
		<?php foreach( $plane_images as $plane_image ): ?>
			<a href="<?php echo $plane_image['url']; ?>" data-caption="<?php if ($plane_image['caption']) echo $plane_image['caption']; else echo "Caption"; ?>">
				<img src="<?php echo $plane_image['sizes']['medium_large']; ?>" alt="<?php if ($plane_image['alt']) echo $plane_image['alt']; else the_title(); ?>">
			</a>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<div class="uk-container uk-container-small uk-margin-large">
		<div class="uk-margin-large uk-placeholder"><?php echo $advertising_block; ?></div>
	</div>


	<div class="uk-container uk-margin-large">
		<div class="section-comments">
			<header class="uk-text-large" uk-toggle="target: .comments-widget; animation: uk-animation-fade">Комментарии <div class="uk-badge uk-margin-small-left">88</div></header>
			<main class="comments-widget" hidden>
				Виджет
			</main>
		</div>
	</div>
	
</div>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<div class="badge">
				<a class="uk-badge" href="<?php echo get_post_type_archive_link( $post_type ); ?>">Рейтинг самолетов</a>
			</div>
			<h1 class="regular" itemprop="name"><?php the_title(); ?></h1>
		</div>
		<div class="bottom uk-flex uk-flex-center">
			<div class="rating uk-flex uk-flex-center uk-flex-middle uk-text-center" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<span class="star <?php get_color_of_position_rating($position_rating); ?>"><?php echo $position_rating; ?></span>
				<div class="uk-margin-right">место в рейтинге <br>самолетов</div>
				<button class="uk-button uk-button-link" uk-toggle="target: #modal-vote">Голосовать</button>

				<meta itemprop="ratingValue" content="4.5">
				<meta itemprop="reviewCount" content="11">
			</div>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
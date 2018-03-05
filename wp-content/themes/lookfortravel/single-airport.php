<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
$image = get_field('airport_img');
$airport_gallery = get_field('airport_gallery');
$advertising_block = get_field('advertising_block');

$airport_international_name = get_field('airport_international_name');
$airport_class_descr = get_field('airport_class_descr');
$airport_class = get_field('airport_class');
$airport_code_iata = get_field('airport_code_iata');
$airport_facilities = 'airport_facilities';
$airport_city = get_field('airport_city');
$airport_country = get_field('airport_country');

$points_rating = get_field('points_rating');
$position_rating = get_field('position_rating');

$post_type = get_post_type();
?>
<main class="section-main uk-section">
	<div class="uk-container uk-margin-large-bottom">
		<div class="uk-child-width-expand@m uk-text-center" uk-grid>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airport_international_name ?></div>
				<div class="uk-text-large">Международное название</div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airport_class; ?></div>
				<div class="uk-text-large"><?php echo $airport_class_descr; ?></div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airport_code_iata; ?></div>
				<div class="uk-text-large">Международный код ИАТА</div>
			</div>
		</div>
	</div>
	<div class="uk-container uk-container-small" itemprop="description">
		<?php the_content(); ?>
		<?php if( have_rows($airport_facilities) ): ?>
		<h2>Удобства</h2>
		<div class="uk-child-width-1-2@s uk-text-large" uk-grid>
			<?php while( have_rows($airport_facilities) ): the_row(); 
				$name = get_sub_field('name');
			?>
			<div>
				<i class="fa fa-lg fa-check-square-o uk-margin-small-right"></i> <?php echo $name; ?>
			</div>
			<?php endwhile; ?>
		</div>
		<?php endif; ?>
	</div>
	<div class="uk-margin-large">
		<h2>Фото аэропорта</h2>
		<?php if( $airport_gallery ): ?>
		<div class="gallery" uk-lightbox>
			<?php foreach( $airport_gallery as $airport_gallery ): ?>
				<a href="<?php echo $airport_gallery['url']; ?>" data-caption="<?php if ($airport_gallery['caption']) echo $airport_gallery['caption']; else echo "Caption"; ?>">
					<img src="<?php echo $airport_gallery['sizes']['medium_large']; ?>" alt="<?php if ($airport_gallery['alt']) echo $airport_gallery['alt']; else the_title(); ?>">
				</a>
			<?php endforeach; ?>
		</div>
		<?php endif; ?>
	</div>

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
	
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
    <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<div class="badge">
				<a class="uk-badge" href="#">Рейтинг аэропортов</a>
			</div>
			<h1 class="regular" itemprop="name"><?php echo 'Аэропорт ' . get_the_title(); ?></h1>
			<p><?php echo $airport_city . ', ' . $airport_country; ?></p>
		</div>
		<div class="bottom uk-flex uk-flex-center">
			<div class="rating uk-flex uk-flex-center uk-flex-middle uk-text-center" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<span class="star <?php get_color_of_position_rating($position_rating); ?>"><?php echo $position_rating; ?></span>
				<div class="uk-margin-right">место в рейтинге <br>аэропортов</div>
				<button class="uk-button uk-button-link" uk-toggle="target: #modal-vote">Голосовать</button>

				<meta itemprop="ratingValue" content="4.5">
				<meta itemprop="reviewCount" content="11">
			</div>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
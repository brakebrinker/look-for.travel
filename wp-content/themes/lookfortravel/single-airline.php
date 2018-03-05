<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
$image = get_field('airline_img');
$airline_images = get_field('airline_galler');
$advertising_block = get_field('advertising_block');

$airline_international_name = get_field('airline_international_name');
$airline_character = get_field('airline_character');
$airline_character_descr = get_field('airline_character_descr');
$airline_type_of_flights = get_field('airline_type_of_flights');
$airline_type_of_flights_descr = get_field('airline_type_of_flights_descr');
$airline_alliance = get_field('airline_alliance');
$airline_alliance_descr = get_field('airline_alliance_descr');
$airline_country = get_field('airline_country');
$airline_fleet = 'airline_fleet';

$points_rating = get_field('points_rating');
$position_rating = get_field('position_rating');

$post_type = get_post_type();
?>
<main class="section-main uk-section">
	<div class="uk-container uk-margin-large-bottom">
		<div class="uk-child-width-expand@m uk-text-center" uk-grid>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airline_international_name; ?></div>
				<div class="uk-text-large">Международное название</div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airline_character; ?></div>
				<div class="uk-text-large"><?php echo $airline_character_descr; ?></div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airline_type_of_flights; ?></div>
				<div class="uk-text-large"><?php echo $airline_type_of_flights_descr; ?></div>
			</div>
			<div>
				<div class="uk-h1 uk-margin-remove-bottom uk-text-primary"><?php echo $airline_alliance; ?></div>
				<div class="uk-text-large"><?php echo $airline_alliance_descr; ?></div>
			</div>
		</div>
	</div>
	<div class="uk-container uk-container-small" itemprop="description">
		<?php the_content(); ?>
	</div>
	<div class="uk-container uk-margin-large">
        <h2>Парк</h2>
        <?php if( have_rows($airline_fleet) ): ?>
		<div class="uk-child-width-1-3@s" uk-grid>
            <?php while( have_rows($airline_fleet) ): the_row(); 
                $planes = get_sub_field('plane');
                $count = get_sub_field('count');
                $average_age = get_sub_field('average_age');
            ?>
            <div>
                <?php foreach($planes as $post){ setup_postdata($post); 
                    $img_plane = get_field('plane_img', $post->ID);
                ?>
                <div class="vertical-scheme-block">
                    <h3 class="uk-margin-small-bottom"><?php the_title(); ?></h3>
                    <?php if ($img_plane) { ?>
                    <a href="<?php the_permalink(); ?>"><img src="<?php echo $img_plane['sizes']['medium']; ?>" srcset="<?php echo $img_plane['sizes']['medium_large']; ?> 2x" alt="<?php if ($img_plane['alt']) echo $img_plane['alt']; else the_title(); ?>"></a>
                    <?php } ?>
                </div>
                <?php } wp_reset_postdata();?>
                <div class="uk-margin-small-top uk-clearfix uk-text-center">
                    <div class="uk-float-left uk-margin-small-left"><?php echo $count; ?></div>
                    <div class="uk-float-right uk-margin-small-right"><?php echo $average_age ?><br> средний возраст</div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
	</div>

    <h2>Фото авиакомпании</h2>
    <?php if( $airline_images ): ?>
	<div class="gallery" uk-lightbox>
		<?php foreach( $airline_images as $airline_images ): ?>
			<a href="<?php echo $airline_images['url']; ?>" data-caption="<?php if ($airline_images['caption']) echo $airline_images['caption']; else echo "Caption"; ?>">
				<img src="<?php echo $airline_images['sizes']['medium_large']; ?>" alt="<?php if ($airline_images['alt']) echo $airline_images['alt']; else the_title(); ?>">
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
	
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<div class="badge">
				<a class="uk-badge" href="#">Рейтинг авиакомпаний</a>
			</div>
			<h1 class="regular" itemprop="name"><?php the_title(); ?></h1>
			<p><?php echo $airline_country; ?></p>
		</div>
		<div class="bottom uk-flex uk-flex-center">
			<div class="rating uk-flex uk-flex-center uk-flex-middle uk-text-center" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<span class="star <?php get_color_of_position_rating($position_rating); ?>"><?php echo $position_rating; ?></span>
				<div class="uk-margin-right">место в рейтинге <br>авиакомпаний</div>
				<button class="uk-button uk-button-link" uk-toggle="target: #modal-vote">Голосовать</button>

				<meta itemprop="ratingValue" content="4.5">
				<meta itemprop="reviewCount" content="11">
			</div>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
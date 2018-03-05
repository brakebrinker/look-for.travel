<?php
/*
Template Name: Шаблон о редакции
*/
?>
<?php get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
<?php 
    $image = get_field('about_img'); 
    $about_employers = 'about_employers'; 
?>
<main class="section-main uk-section">
	<div class="uk-container uk-container-small" itemprop="description">
		<?php the_content(); ?>
        <?php if( have_rows($about_employers) ): ?>
		<div class="uk-child-width-expand@s" uk-grid>
            <?php while( have_rows($about_employers) ): the_row(); 
                $photo = get_sub_field('photo');
                $name = get_sub_field('name');
                $email = get_sub_field('email');
                $vk = get_sub_field('vk');
                $fb = get_sub_field('fb');
            ?>
            <div class="uk-text-center">
                <img class="uk-border-circle tm-bordered" src="<?php echo $photo['sizes']['medium']; ?>" srcset="<?php echo $photo['sizes']['medium_large']; ?> 2x" width="200" height="200" alt="<?php if ($photo['alt']) echo $photo['alt']; else echo $name; ?>">
                <p class="uk-text-large uk-margin-small"><?php echo $name ?></p>
                <p class="uk-margin-small uk-flex-center uk-grid">
                    <span><a href="mailto:<?php echo $email; ?>"><i class="uk-icon-button uk-button-default fa fa-envelope-o"></i></a></span>
                    <span><a href="<?php echo $vk; ?>"><i class="uk-icon-button uk-button-default fa fa-vk"></i></a></span>
                    <span><a href="<?php echo $fb; ?>"><i class="uk-icon-button uk-button-default fa fa-facebook"></i></a></span>
                </p>
            </div>
            <?php endwhile; ?>
        </div>
		<?php endif; ?>
		</div>
	</div>
</main>

<header class="section-header section-header-small uk-light" style="background-image: url(<?php if( !empty($image) ) echo $image['url']; else echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
    <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
			<h1 itemprop="name"><?php the_title(); ?></h1>
		</div>
	</div>
</header>
<?php endwhile; ?>
<?php get_footer(); ?>
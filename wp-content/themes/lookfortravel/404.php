<?php get_header(); ?>

<div class="error-page" style="background-image: url(<?php echo get_template_directory_uri() . '/images/headers/regular.jpg'; ?>)">
	<div class="uk-padding-large uk-height-1-1 uk-flex uk-flex-column uk-flex-center uk-flex-between">
        <?php
        if( has_custom_logo() ){
            $logo_img = '';
            if( $custom_logo_id = get_theme_mod('custom_logo') ){
                $logo_img = wp_get_attachment_image( $custom_logo_id, 'full', false, array(
                    'itemprop' => 'logo',
                    'alt' => 'Look for Travel'
                ) );
            }
            echo '<a class="uk-text-center" href="' . home_url() . '" title="Вернуться на главную">' . $logo_img . '</a>';
        }
        ?>
		<h1>Страница не найдена :(</h1>
		<div class="uk-text-center"><a href="<?php echo home_url(); ?>" class="uk-button uk-button-primary">Перейти на главную</a></div>
	</div>
</div>

</body>
</html>
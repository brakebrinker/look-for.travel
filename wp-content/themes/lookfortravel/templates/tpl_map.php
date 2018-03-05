<?php
/*
Template Name: Шаблон карты мира
*/
?>
<?php get_header(); ?>
<main class="page-map uk-position-relative">
	<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319" frameborder="0" style="border:0;width:100%;height: 100vh"></iframe>
	<div class="map-marker uk-position-absolute" style="top:40%;left:50%"></div>
	<div class="map-marker uk-position-absolute" style="top:50%;left:50%">4</div>
	<div class="map-marker uk-position-absolute" style="top:60%;left:50%"><img src="assets/images/geo-types/gora.svg" alt="название"></div>
	<div class="map-drop uk-position-absolute" style="top:40%;left:60%">
		<a class="map-article">
			<span class="image"><img src="assets/images/geo-types/dost.svg" alt="название"></span>
			<span class="title">Разноцветный Бангкок</span>
			<i class="type fa fa-file-text-o"></i>
		</a>
		<a class="map-article">
			<span class="image"><img src="assets/images/geo-types/gora.svg" alt="название"></span>
			<span class="title">Аюттхая — самый крупный город мира в XVIII столетии</span>
			<i class="type fa fa-video-camera"></i>
		</a>
		<div class="map-article-section">Блог</div>
		<a class="map-article">
			<span class="none"></span>
			<span class="title">Нячанг-Винперл-Далат-Муйне</span>
			<i class="type fa fa-file-text-o"></i>
		</a>
	</div>
</main>

<header class="section-header section-header-map uk-light uk-position-top">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>
	</div>
</header>
<?php get_footer(); ?>
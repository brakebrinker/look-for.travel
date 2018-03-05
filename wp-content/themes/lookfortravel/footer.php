<div class="uk-section uk-section-muted uk-text-center">
	<div class="uk-container">
		<h2>Станьте нашим читателем и получайте новые записи на почту</h2>
		<p><button class="uk-button uk-button-primary" uk-toggle="target: #modal-subscribe">Выбрать темы</button></p>
		<p class="uk-text-large">или подпишитесь через любимый сервис:</p>
		<?php if (!dynamic_sidebar("foot-widget-area") ) : ?> 
		<?php endif; ?>
	</div>
</div>
<div class="uk-section uk-section-primary uk-section-xsmall uk-light">
	<div class="uk-container">
		<div class="uk-child-width-expand" uk-grid>
			<div class="uk-text-left">
				<a href="#"><img src="assets/images/flags/ru.png" alt="название"> Russian edition <i class="fa fa-angle-down"></i></a>
				<div class="submenu-lang" uk-drop="offset: 14; mode: click; pos: top-left">
					<ul class="uk-list">
						<li class="uk-active"><a href="#"><img src="assets/images/flags/ru.png" alt="название"> Russian</a></li>
						<li><a href="#"><img src="assets/images/flags/en.png" alt="название"> English</a></li>
						<li><a href="#"><img src="assets/images/flags/es.png" alt="название"> Spanish</a></li>
						<li><a href="#"><img src="assets/images/flags/de.png" alt="название"> German</a></li>
						<li><a href="#"><img src="assets/images/flags/cn.png" alt="название"> Chinese</a></li>
						<li><a href="#"><img src="assets/images/flags/fr.png" alt="название"> French</a></li>
						<li><a href="#"><img src="assets/images/flags/in.png" alt="название"> Hindi</a></li>
					</ul>
				</div>
			</div>
			<div class="uk-text-right">
				<a href="#" uk-scroll>Наверх <i class="fa fa-md fa-angle-up"></i></a>
			</div>
		</div>
	</div>
</div>
	<?php wp_footer(); ?>
</body>
</html>
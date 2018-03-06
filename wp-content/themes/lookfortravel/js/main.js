jQuery(function($){
	$('.uk-container').on('click', '#true_loadmore button', function(){
		$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'loadmore',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				if( data ) { 
					$('#true_loadmore button').text('Еще');
					$('#posts-results').append(data); // вставляем новые посты
					current_page++; // увеличиваем номер страницы на единицу
					if (current_page == max_pages) $("#true_loadmore").remove(); // если последняя страница, удаляем кнопку
				} else {
					$('#true_loadmore').remove(); // если мы дошли до последней страницы постов, скроем кнопку
				}
			}
		});
	});

	$('.uk-container').on('click', '#true_loadmore_rate button', function(){
		$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'loadmore-rate',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				if( data ) { 
					$('#true_loadmore_rate button').text('Еще');
					$('#posts-rate-results').append(data);
					current_page++;
					if (current_page == max_pages) $("#true_loadmore_rate").remove();
				} else {
					$('#true_loadmore_rate').remove();
				}
			}
		});
	});

	$('.uk-container').on('click', '#true_loadmore_rate_airports button', function(){
		$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'loadmore-rate-airports',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				if( data ) { 
					$('#true_loadmore_rate button').text('Еще');
					$('#posts-rate-results').append(data);
					current_page++;
					if (current_page == max_pages) $("#true_loadmore_rate").remove();
				} else {
					$('#true_loadmore_rate').remove();
				}
			}
		});
	});

	$('.uk-container').on('click', '#true_loadmore_search button', function(){
		$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'loadmore-search',
			'query': true_posts,
			'page' : current_page
		};
		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:data, // данные
			type:'POST', // тип запроса
			success:function(data){
				if( data ) { 
					$('#true_loadmore_search button').text('Еще');
					$('#posts-results').append(data); // вставляем новые посты
					current_page++; // увеличиваем номер страницы на единицу
					if (current_page == max_pages) $("#true_loadmore_search").remove(); // если последняя страница, удаляем кнопку
				} else {
					$('#true_loadmore_search').remove(); // если мы дошли до последней страницы постов, скроем кнопку
				}
			}
		});
	});

	// !!!!!!!пока не используется -- поиск по публикациям 
	// $('#posts-filter input[type="text"]').on('input keyup', _.debounce(function (){
	// 	console.log('push');
	// 	var srch = $(this).val();
	// 	var data = {
	// 		'action': 'posts-search',
	// 		'search': srch
	// 	};

	// 	$('.status-query').text('Загрузка...');

	// 	$.ajax({
	// 		url:ajaxurl, // обработчик
	// 		data:data, // данные
	// 		type:'GET', // тип запроса
	// 		success:function(data){
	// 			if( data ) { 
	// 				$('.status-query').text('');
	// 				$('#search-posts-results').html(data); // вставляем новые посты
	// 			} else {
	// 				$('.status-query').text('Ошибка загрузки.');
	// 			}
	// 		}
	// 	});
	// }, 500));

	// сортировка постов
	$('#posts-filter').on('change', '.sorting', function(){
		//var url = document.location.href;
		//var prmName = 'sort';
		var val = $(this).val();
		var tax = $(this).attr('data-tax');
		var term = $(this).attr('data-term');
		//var res = '';
	
		//$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер
		var data = {
			'action': 'posts-sort',
			'sort' : val,
			'tax' : tax,
			'term' : term,
		};
		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:data, // данные
			type:'GET', // тип запроса
			success:function(data){
				$('#search-posts-results').html(data); // вставляем новые посты
			}
		});
	});

	// поиск по названию самолета 
	$('#planes-filter #plane-name').on('input keyup', _.debounce(function (){
		var searchText = $(this).val();
		
		if (searchText.length > 2) {
			var searchQuery = {
				'action': 'plane-search',
				'search': searchText,
				'query' : true_posts
			};

			$('#plane-name-results').removeAttr("hidden").html('<li><span>Загрузка...</span></li>');

			$.ajax({
				url:lookfortravel.ajaxurl, // обработчик
				data:searchQuery, // данные
				type:'GET', // тип запроса
				success:function(data){
					if (data) { 
						$('#plane-name-results').html(data); // вставляем новые посты
					} else {
						$('#plane-name-results').html('<li><span>Ошибка загрузки.</span></li>');
					}
				}
			});
		} else {
			$('#plane-name-results').prop("hidden", true).html('');
		}
	}, 500));

	// фильтр самолетов
	$('#planes-filter').on('change', 'select', function(){
		//var url = document.location.href;
		//var prmName = 'sort';
		var val;
		var typeFilter;
		var queryParams = {};

		$("#planes-filter select.uk-form-width-small").each(function() {
			val = $(this).val();
			typeFilter = $(this).attr("name");
			if (typeFilter !== undefined) {
				queryParams[typeFilter] = val;
			}
		});
		queryParams['action'] = 'plane-filter';
		queryParams['query'] = true_posts;
		//var res = '';
	
		//$(this).text('Загрузка...'); // изменяем текст кнопки, вы также можете добавить прелоадер

		$.ajax({
			url:lookfortravel.ajaxurl, // обработчик
			data:queryParams, // данные
			type:'GET', // тип запроса
			success:function(result){
				$('#filter-posts-results').html(result); // вставляем новые посты
			}
		});
	});

	// переход из фильтра в страны
	$('#posts-filter').on('change', '.countries', function() {
		var locate = $(this).val();
		if (locate !== 'none') {
			location.href = locate;
		}
	});

	// переход из фильтра в темы
	$('#posts-filter').on('change', '.themes', function() {
		var locate = $(this).val();
		if (locate !== 'none') {
			location.href = locate;
		}
	});

	// переход из фильтра в города
	$('#posts-filter').on('change', '.cities', function() {
		var locate = $(this).val();
		if (locate !== 'none') {
			location.href = locate;
		}
	});
});
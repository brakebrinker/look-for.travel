<?php 

// Recommended
function get_post_recommendet($item_recommendet) {
    if ($item_recommendet === 'recomended') {
        echo '<div class="uk-alert-success uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">Рекомендовано к посещению</div>';
    } elseif ($item_recommendet === 'beshure') {
        echo '<div class="uk-alert-danger uk-height-1-1 uk-flex uk-flex-middle uk-flex-center">Обязательно к посещению</div>';
    }
}

// Recommended blog
function get_post_blog_recommendet($item_recommendet) {
    if ($item_recommendet === 'recomended') {
        echo '<div class="uk-text-center uk-alert-success">Рекомендовано к посещению</div>';
    } elseif ($item_recommendet === 'beshure') {
        echo '<div class="uk-text-center uk-alert-danger">Обязательно к посещению</div>';
    }
}

// Get Post object type
function get_post_object_type($name_field) {
    if( have_rows($name_field) ) {
        while ( have_rows($name_field) ) { the_row();
        $image_blog_object_img = get_sub_field('icon');
        $image_blog_object_name = get_sub_field('name');
        }
    }
    if ($image_blog_object_name && $image_blog_object_img) {
        echo "
        <div class=\"uk-margin-small-bottom\">
            <img src=\"$image_blog_object_img\" alt=\"the_title()\">
        </div>
        <div>$image_blog_object_name</div>
        ";
    }
}

// Get icon for post type
function get_icon_for_posttype($blog_type) {
    if ($blog_type === 'reclama') {
        echo '<i class="type fa fa-external-link"></i>';
    }
    if ($blog_type === 'text') {
        echo '<i class="type fa fa-file-text-o"></i>';
    }
    if ($blog_type === 'video') {
        echo '<i class="type fa fa-video-camera"></i>';
    }
    if ($blog_type === 'photo') {
        echo '<i class="type fa fa-photo"></i>';
    }
}

// Get Post blog object type
function get_post_blog_object_type($name_field) {
    if( have_rows($name_field) ) {
        while ( have_rows($name_field) ) { the_row();
        $image_blog_object_img = get_sub_field('icon');
        $image_blog_object_name = get_sub_field('name');
        }
    }
    if ($image_blog_object_name && $image_blog_object_img) {
        echo "
        <div> <img class=\"uk-margin-small-left\" src=\"$image_blog_object_img\" alt=\"the_title()\"> $image_blog_object_name</div>";
    }
}
//Button loadmore posts\themes
function true_load_posts(){
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1; // следующая страница
	$args['post_status'] = 'publish';
 
	// обычно лучше использовать WP_Query, но не здесь
	query_posts( $args );
	// если посты есть
	if( have_posts() ) :
 
		// запускаем цикл
		while( have_posts() ): the_post();

			get_template_part( 'templates/post', 'preview' );

		endwhile;
 
	endif;
	die();
}
 
add_action('wp_ajax_loadmore', 'true_load_posts');
add_action('wp_ajax_nopriv_loadmore', 'true_load_posts');

//Button loadmore ratings
function true_load_rate_items(){
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );

	if( have_posts() ) :
 
		while( have_posts() ): the_post();

            get_template_part( 'templates/rate-post', 'preview' );

		endwhile;
 
	endif;
	die();
}
 
add_action('wp_ajax_loadmore-rate', 'true_load_rate_items');
add_action('wp_ajax_nopriv_loadmore-rate', 'true_load_rate_items');

//Button loadmore ratings aiports
function true_load_rate_airports_items(){
 
	$args = unserialize( stripslashes( $_POST['query'] ) );
	$args['paged'] = $_POST['page'] + 1;
	$args['post_status'] = 'publish';
 
	query_posts( $args );

	if( have_posts() ) :
 
		while( have_posts() ): the_post();

            get_template_part( 'templates/rate-post-airport', 'preview' );

		endwhile;
 
	endif;
	die();
}
 
add_action('wp_ajax_loadmore-rate-airports', 'true_load_rate_airports_items');
add_action('wp_ajax_nopriv_loadmore-rate-airports', 'true_load_rate_airports_items');

//Button loadmore search
function true_load_search_posts(){
 
    // $args = unserialize( stripslashes( $_POST['query'] ) );
	// $args['paged'] = $_POST['page'] + 1; // следующая страница
	// $args['post_status'] = 'publish';
 
    echo 'Yeeeeeeaaaaaahhhhhh';
	die();
}
 
add_action('wp_ajax_loadmore-search', 'true_load_search_posts');
add_action('wp_ajax_nopriv_loadmore-search', 'true_load_search_posts');

// фильтрация постов пока не используется
function filter_posts(){
    $s_query = trim(stripslashes( $_GET['search'] ));
    
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        's' => $s_query
    );
    $query = new WP_Query( $args );
    ob_start();

	if ( $query->have_posts() ) : ?>
    <div class="section-cards uk-section">
        <div id="posts-results" class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
        <?php while ( $query->have_posts() ) : $query->the_post(); 
            get_template_part( 'templates/post', 'preview' );
        ?>
        <?php endwhile; ?>
        </div>
    </div>
    <?php if (  $query->max_num_pages > 1 ) : ?>
    <script>
        var true_posts = '<?php echo serialize($query->query_vars); ?>';
        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages = '<?php echo $query->max_num_pages; ?>';
    </script>
    <div id="true_loadmore" class="uk-margin-large-bottom uk-text-center"><button class="uk-button uk-button-default">Еще</button></div>
    <?php endif; ?>
    <?php else: ?>
    <div class="section-cards uk-section">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
            Публикаций не найдено.
        </div>
    </div>
    <?php endif;
	die();
}
 
add_action('wp_ajax_posts-search', 'filter_posts');
add_action('wp_ajax_nopriv_posts-search', 'filter_posts');

// сортировка постов
function sort_posts(){
    $sortkey = '';
    $sortvalue = '';
    $order = 'DESC';
    $taxonomy = '';
    $termin = '';

    // $args = array();
    $argSort = array();
    // $args['meta_query'] = array('relation' => 'AND');

    // global $wp_query;

    // global $query_string;
    if (!empty($_GET['tax'])) {
        $taxonomy = $_GET['tax'];
    }

    if (!empty($_GET['term'])) {
        $termin = $_GET['term'];
    }

    if (!empty($_GET['sort'])) {
        if ($_GET['sort'] === 'date') {
            $sortkey = 'date';
        }

        if ($_GET['sort'] === 'name') {
            $sortkey = 'title';
            $order = 'ASC';
        }

        if ($_GET['sort'] === 'rate') {
            $sortkey = 'meta_value_num';
            $sortvalue = 'ratings_average';
        }
    }

    $argSort = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        $taxonomy => $termin,
        'meta_key' => $sortvalue,
        'orderby'  => $sortkey,
        'order'    => $order
    );

    $query = new WP_Query( $argSort );
    ob_start();
    // query_posts($query_string . '&orderby=title&order=DESC'); 

    if ( $query->have_posts() ) : ?>
    <div class="section-cards uk-section">
        <div id="posts-results" class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
        <?php while ( $query->have_posts() ) : $query->the_post(); 
            get_template_part( 'templates/post', 'preview' );
        ?>
        <?php endwhile; ?>
        </div>
    </div>
    <?php if ( $query->max_num_pages > 1 ) : ?>
    <script>
        var true_posts = '<?php echo serialize($query->query_vars); ?>';
        var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
        var max_pages = '<?php echo $query->max_num_pages; ?>';
    </script>
    <div id="true_loadmore" class="uk-margin-large-bottom uk-text-center"><button class="uk-button uk-button-default">Еще</button></div>
    <?php endif; ?>
    <?php else: ?>
    <div class="section-cards uk-section">
        <div class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
            Публикаций не найдено.
        </div>
    </div>
    <?php endif;

    wp_die();
}
 
add_action('wp_ajax_posts-sort', 'sort_posts');
add_action('wp_ajax_nopriv_posts-sort', 'sort_posts');

// фильтрация самолетов
function filter_planes(){
    global $wp_query;

    $sortkey = '';
    $sortvalue = '';
    $order = 'DESC';
    $taxonomy = '';
    $termin = '';

    $argSort = array();

    if (!empty($_GET)) {
        $getted_query= unserialize(stripslashes($_GET['query']));

        $meta_q = array(
            'meta_query' => array(
                'relation' => 'AND',
            )
        );

        if ($_GET['habarite'] !== 'none' && !empty($_GET['habarite'])) {
            array_push($meta_q['meta_query'], array(
                'key' => 'plane_dimensions',
                'value' => $_GET['habarite']
            ));
        }

        if ($_GET['range_flight'] !== 'none' && !empty($_GET['range_flight'])) {
            array_push($meta_q['meta_query'], array(
                'key' => 'plane_range_flight',
                'value' => $_GET['range_flight']
            ));
        }

        if ($_GET['manufacturer'] !== 'none' && !empty($_GET['manufacturer'])) {
            array_push($meta_q['meta_query'], array(
                'key' => 'plane_manufacturer',
                'value' => $_GET['manufacturer']
            ));
        }

        if ($_GET['feature'] !== 'none' && !empty($_GET['feature'])) {
            array_push($meta_q['meta_query'], array(
                'key' => 'plane_feature',
                'value' => $_GET['feature']
            ));
        }

        query_posts(array_merge($getted_query, $meta_q));

    } else {
        query_posts($getted_query);
    }

	if( have_posts() ) :
        echo '<ul id="posts-rate-results" class="tm-list-divider uk-list uk-list-divider uk-text-large uk-margin-large-bottom">';
		while( have_posts() ): the_post();

            get_template_part( 'templates/rate-post', 'preview' );

        endwhile;
        echo '</ul>';

    else:

        echo '<ul id="posts-rate-results" class="tm-list-divider uk-list uk-list-divider uk-text-large uk-margin-large-bottom"><li><span>Самолетов не найдено.</span></li></ul>';

    endif;

    if ( $wp_query->max_num_pages > 1 ) :
        get_template_part( 'templates/show-rate', 'more' );
    endif;

	wp_reset_query();

    wp_die();
}
 
add_action('wp_ajax_plane-filter', 'filter_planes');
add_action('wp_ajax_nopriv_plane-filter', 'filter_planes');

// получение типа фюзеляжа самолета
function get_type_fuselage($field) {
    if ($field === 'uzko') {
        echo "Узкофюзеляжный";
    }
    if ($field === 'shiroko') {
        echo "Широкофюзеляжный";
    }
    if ($field === 'mono') {
        echo "Однопалубный";
    }
    if ($field === 'two') {
        echo "Двухпалубный";
    }
    if ($field === 'flat') {
        echo "Плоскофюзеляжный";
    }
}

// получение типа дальности самолета
function get_type_range_fuselage($field) {
    if ($field === 'far') {
        echo "Дальнемагистральный";
    }
    if ($field === 'middlefar') {
        echo "Среднемагистральный";
    }
    if ($field === 'closefar') {
        echo "Ближнемагистральный";
    }
    if ($field === 'localfar') {
        echo "Самолёт местных воздушных линий";
    }
}

// после редактирования поста самолета
add_action( 'save_post_plane', 'when_update_post', 10, 2 );
function when_update_post( $post_id ){
    if ( $parent_id = wp_is_post_revision( $post_id ) ) 
        $post_id = $parent_id;

    // set_plane_rate_position($post_ID);
    remove_action('save_post_plane', 'when_update_post');

    // обновляем пост, когда снова вызовется хук save_post
    set_plane_rate_position($post_id);

    // снова вешаем хук
    add_action('save_post_plane', 'when_update_post');
}

// подсчет места в рейтинге самолеты
function set_plane_rate_position($post_id) {
    $args = array(
        'post_type' => 'plane',
        'publish' => true,
        'numberposts' => -1,
        'orderby' => 'meta_value_num',
        'order' => 'DESC',
        'meta_key' => 'position_rating'
    );

    $planes = get_posts($args);

    $last_position_rating = 0;
    //получаем последнее место
    $this_position_rating = (int) get_field('position_rating', $planes[0]->ID);
    $last_position_rating = $this_position_rating;
    $this_position_rating = (int) get_field('position_rating', $post_id);
    $this_points_rating = (int) get_field('points_rating', $post_id);    

    foreach($planes as $post) { setup_postdata($post);
        $position_rating = (int) get_field('position_rating', $post->ID);
        $points_rating = (int) get_field('points_rating', $post->ID);

        // update_field('position_rating', 0, $post->ID);
        if ($position_rating == 0 && $points_rating == 0) {
            update_field('position_rating', ++$last_position_rating, $post->ID);
        }
    }
        
    // } else {
    // if ($this_position_rating == 0 && $this_points_rating == 0) {
    //     if ($last_position_rating >= $this_position_rating + 2) {
    //         update_field('position_rating', $this_position_rating + 1, $post_id);
    //     } else {
    //         update_field('position_rating', $last_position_rating, $post_id);
    //     }
    // }
    // }

    wp_reset_postdata();
}

// получение класса для цвета позиции в рейтинге
function get_color_of_position_rating($position) {
    if ($position == 1) echo 'gold';
    if ($position == 2) echo 'silver';
    if ($position == 3) echo 'bronze';
    if ($position > 3 || $position < 1) echo 'default';
}

//получение элементов для списка
function get_options_in_select($elems) {
    if( $elems && ! is_wp_error($elems) ){
        foreach( $elems as $elem ){
            $link = get_term_link($elem->term_id, $elem->taxonomy);
            echo '<option value="' . $link . '">' . $elem->name . '</option>';
        }
    }
}

//получение элементов для списка
function get_options_in_select_text($elems) {
    if( $elems && ! is_wp_error($elems) ){
        foreach( $elems as $elem ){
            echo '<option value="' . $elem . '">' . $elem . '</option>';
        }
    }
}

// получение стран из регионов (пока не используется)
// function get_countries_in_regions($regions) {
//     if (!empty($regions)) {
//         $countries = array();

//         foreach ($regions as $region) {
//             $args = array(
//                 'orderby' => 'name',
//                 'hide_empty' => 0,
//                 'hierarchical' => 0,
//                 'parent' => $region,
//             );
//             $countries = array_merge(get_terms('location', $args),$countries);
//         }
//     }

//     return $countries;
// }

// получение мест из постов для списков
function get_places_from_posts_in_select($posts) {
    if (!empty($posts)) {
        $places = array();
        foreach ($posts as $post_item) {
            setup_postdata($post_item);
            array_push($places, get_field('blog_place_on_map', $post_item->ID));
        }
        wp_reset_postdata();
    }

    if (!empty($places)) {
        foreach( $places as $place ){
            echo '<option value="' . $place . '">' . $place . '</option>';
        }
    }
}
<?php get_header(); ?>
<?php
    $queried_object = get_queried_object();
    $taxonomy = $queried_object->taxonomy;
    $parent = $queried_object->parent;
    
    $blog_img = get_field('taxonomy_term_img', $taxonomy . '_' . get_queried_object_id());
    $position_rating = get_field('position_rating', $taxonomy . '_' . get_queried_object_id());
    $childrens = get_term_children( get_queried_object_id(), $taxonomy );

    $themes = get_terms('category', 'orderby=name&hide_empty=0&exclude=1&hierarchical=false');
    $regions = get_terms('location', 'orderby=name&hide_empty=0&hierarchical=0&fields=ids&parent=0');
    $args = array(
        'parent' => $queried_object->term_id,
        'orderby' => 'name',
        'order' => 'ASC',
        // 'meta_key' => 'position_rating',
        'hide_empty' => 0,
        'hierarchical' => 0,
    );
    $countries = get_terms('location', $args);

?>
<main class="section-main">
	<div class="uk-container uk-margin-small-top">
        <?php 
            global $query_string;
            query_posts($query_string . '&orderby=date&order=DESC'); 
        ?>
        <?php if ( have_posts() ) : ?>
        <?php if ($parent == 0) { 
                //  $countries = get_countries_in_regions($regions); 
            ?>
            <form id="posts-filter" class="section-filters uk-clearfix">
                <select class="uk-select uk-form-width-medium countries">
                    <option value="none">Страны</option>
                    <?php get_options_in_select($countries); ?>
                </select>
                <select class="uk-select uk-form-width-medium themes">
                    <option value="none">Темы</option>
                    <?php get_options_in_select($themes); ?>
                </select>
                <select name="sort" class="uk-float-right uk-select uk-form-width-medium uk-visible@l sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                    <option value="date">Сортировка: по дате</option>
                    <option value="name">Сортировка: по алфавиту</option>
                    <option value="rate">Сортировка: по рейтингу</option>
                </select>
                <div class="uk-hidden@l" uk-form-custom>
                    <select name="sort" class="sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                        <option>Сортировка: по дате</option>
                        <option>Сортировка: по алфавиту</option>
                        <option>Сортировка: по рейтингу</option>
                    </select>
                <div class="mobile-sort"><i class="fa fa-sort-alpha-asc"></i></div>
                </div>
            </form>
        <?php } ?>
        <?php if (!empty($childrens) && $parent != 0) { 
            $cities = get_terms('location', 'orderby=name&hide_empty=0&hierarchical=0&parent=' . $queried_object->term_id);
        ?>
            <form id="posts-filter" class="section-filters uk-clearfix">
                <select class="uk-select uk-form-width-medium cities">
                    <option value="none">Города</option>
                    <?php get_options_in_select($cities); ?>
                </select>
                <select class="uk-select uk-form-width-medium themes">
                    <option value="none">Темы</option>
                    <?php get_options_in_select($themes); ?>
                </select>
                <select class="uk-float-right uk-select uk-form-width-medium uk-visible@l sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                    <option>Сортировка: по дате</option>
                    <option>Сортировка: по алфавиту</option>
                    <option>Сортировка: по рейтингу</option>
                </select>
                <div class="uk-hidden@l" uk-form-custom>
                    <select class="sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                        <option>Сортировка: по дате</option>
                        <option>Сортировка: по алфавиту</option>
                        <option>Сортировка: по рейтингу</option>
                    </select>
                <div class="mobile-sort"><i class="fa fa-sort-alpha-asc"></i></div>
                </div>
            </form>
        <?php } ?>
        <?php if (empty($childrens)) { ?>
            <?php $post_items = get_posts(array('location' => $queried_object->slug)); 
            ?>
            <form id="posts-filter" class="section-filters uk-clearfix">
                <select class="uk-select uk-form-width-medium">
                    <option value="none">Места</option>
                    <?php get_places_from_posts_in_select($post_items); ?>
                </select>
                <select class="uk-select uk-form-width-medium themes">
                    <option value="none">Темы</option>
                    <?php get_options_in_select($themes); ?>
                </select>
                <select class="uk-float-right uk-select uk-form-width-medium uk-visible@l sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                    <option>Сортировка: по дате</option>
                    <option>Сортировка: по алфавиту</option>
                    <option>Сортировка: по рейтингу</option>
                </select>
                <div class="uk-hidden@l" uk-form-custom>
                    <select class="sorting" data-tax="<?php echo $taxonomy; ?>" data-term="<?php echo $queried_object->slug; ?>">
                        <option>Сортировка: по дате</option>
                        <option>Сортировка: по алфавиту</option>
                        <option>Сортировка: по рейтингу</option>
                    </select>
                <div class="mobile-sort"><i class="fa fa-sort-alpha-asc"></i></div>
                </div>
            </form>
        <?php } ?>
        <div id="search-posts-results">
            <div class="section-cards uk-section">
                <div id="posts-results" class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
                    <?php while ( have_posts() ) : the_post(); 
                        get_template_part( 'templates/post', 'preview' );
                    ?>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php if (  $wp_query->max_num_pages > 1 ) : ?>
                <?php get_template_part( 'templates/show', 'more' ); ?>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="section-cards uk-section">
			<div class="uk-child-width-1-2@s uk-child-width-1-3@l" uk-grid>
                Публикаций не найдено.
			</div>
		</div>
        <?php endif; ?>
	</div>
</main>

<header class="section-header uk-light" style="background-image: url(<?php if( !empty($blog_img) ) echo $blog_img['url']; else echo get_template_directory_uri() . '/images/sample/header-blog.jpg'; ?>)">
	<div class="uk-container uk-flex uk-flex-column">
        <?php get_template_part( 'templates/nav', 'top' ); ?>

		<div class="middle uk-flex-1 uk-text-center">
            <?php if ($parent != 0) { 
                $parent_term = get_term( $parent);                
            ?>
            <div class="badge">
				<a class="uk-badge" href="<?php echo get_term_link($parent); ?>"><?php echo $parent_term->name; ?></a>
            </div>
            <?php } ?>
			<h1 itemprop="name"><?php single_term_title(''); ?></h1>
			<div class="desc uk-container uk-container-small" itemprop="description">
                <?php echo term_description(); ?>
			</div>
        </div>
        
        <?php if ($parent != 0) { ?>
        <div class="bottom uk-flex uk-flex-center">
			<div class="rating uk-flex uk-flex-center uk-flex-middle uk-text-center" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
				<span class="star <?php get_color_of_position_rating($position_rating); ?>"><?php echo $position_rating; ?></span>
				<div class="uk-margin-right">место в рейтинге <br><?php echo '"' . $parent_term->name . '"'; ?></div>
				<button class="uk-button uk-button-link" uk-toggle="target: #modal-vote">Голосовать</button>

				<meta itemprop="ratingValue" content="4.5">
				<meta itemprop="reviewCount" content="11">
			</div>
        </div>
        <?php } ?>
	</div>
</header>
<?php get_footer(); ?>
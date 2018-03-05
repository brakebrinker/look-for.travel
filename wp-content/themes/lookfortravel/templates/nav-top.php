<nav class="navigation uk-flex-none">
    <div class="uk-flex-middle uk-margin-small" uk-grid>
        <div class="uk-width-1-2 uk-width-1-5@l">
            <?php 
            if( has_custom_logo( $blog_id ) ){
                echo get_custom_logo( $blog_id );
            }
            ?>
        </div>
        <div class="uk-width-1-2 uk-width-3-5@l">
            <div class="uk-hidden@l uk-text-right">
                <button class="uk-button uk-button-text" uk-toggle="target: .mobile-search; animation: uk-animation-fade">
                    <i class="fa fa-2x fa-search"></i>
                </button>
                <button class="uk-button uk-button-text uk-margin-left" uk-toggle="target: .mobile-navigation; animation: uk-animation-fade">
                    <i class="fa fa-2x fa-bars"></i>
                </button>
            </div>
        </div>
        <div class="uk-width-1-5 uk-visible@l">
            <form class="search uk-flex">
                <div class="uk-inline uk-flex-1 uk-margin-small-right">
                    <input type="search" class="uk-input uk-form-small">
                    <ul class="form-results uk-list" hidden>
                        <li>
                            <a href="">Таиланд</a>
                        </li>
                        <li>
                            <a href="">Аюттхая — самый крупный город мира в XVIII столетии</a>
                        </li>
                        <li>
                            <a href="">Таиланд</a>
                        </li>
                        <li>
                            <a href="">
                                <em>Ещё</em>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="uk-button uk-button-text uk-flex-none">
                    <i class="fa fa-search"></i>
                </button>
            </form>
        </div>
    </div>
    <ul class="uk-subnav uk-subnav-pill uk-visible@l">
        <li>
            <a href="#">Направления
                <i class="fa fa-caret-down"></i>
            </a>
            <?php 
                $regions_menu = get_terms('location', 'orderby=name&hide_empty=0&hierarchical=0&parent=0');
            ?>
            <?php if (!empty($regions_menu)) {?>
            <div uk-drop="offset: 0; mode: click">
                <ul class="submenu-directions uk-list">
                    <?php foreach($regions_menu as $region_menu) { 
                        $countries_menu = get_terms('location', 'orderby=name&hide_empty=0&hierarchical=0&parent=' . $region_menu->term_id);
                    ?>
                    <li>
                        <a href="<?php echo get_term_link($region_menu->term_id, $region_menu->taxonomy); ?>"><?php echo $region_menu->name; ?></a>
                        <?php if (!empty($countries_menu)) { ?>
                        <ul class="sub" uk-drop="offset: 0;pos: right-top; mode: hover; boundary: .submenu-directions; boundary-align: true">
                            <?php foreach ($countries_menu as $country_menu)  { 
                                $position_rating = (int) get_field('position_rating', $country_menu->taxonomy . '_' . $country_menu->term_id);    
                            ?>
                            <li>
                                <a href="<?php echo get_term_link($country_menu->term_id, $country_menu->taxonomy); ?>"><span class="star star-mini <?php 
get_color_of_position_rating($position_rating);
?>"><?php echo $position_rating; ?></span><?php echo $country_menu->name; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
            </div>
            <?php } ?>
        </li>
        <li>
            <a href="#">Темы
                <i class="fa fa-caret-down"></i>
            </a>
            <div uk-drop="offset: 0; mode: click; boundary: .uk-subnav; boundary-align: true">
                <?php 
                    $themes_menu = get_terms('category', 'orderby=name&hide_empty=0&exclude=1&hierarchical=false');
                ?>
                <ul class="submenu-topics uk-list">
                    <?php foreach ($themes_menu as $theme_menu) { 
                        $posts_menu = get_posts(array(
                            'numberposts' => 4,
                            'category'    => $theme_menu->term_id
                        ));    
                    ?>
                    <li>
                        <a href="<?php echo get_term_link($theme_menu->term_id, $theme_menu->taxonomy); ?>"><?php echo $theme_menu->name; ?></a>
                        <?php if (!empty($posts_menu)) { ?>
                            <div class="submenu-announces" uk-drop="offset: 10; mode: hover; boundary: .submenu-topics; boundary-align: true">
                                <div class="uk-child-width-1-4 uk-grid-small" uk-grid>
                                <?php foreach($posts_menu as $post) { setup_postdata($post); ?>
                                    <?php get_template_part( 'templates/menu-post', 'preview' ); ?>
                                <?php }
                                wp_reset_postdata();
                                ?>
                                </div>
                            </div>
                        <?php } ?>
                    </li>
                    <?php wp_reset_postdata(); ?>
                    <?php } ?>
                </ul>
            </div>
        </li>
        <li>
            <a href="<?php echo get_permalink(214); ?>">Карта мира</a>
        </li>
        <li>
            <a href="<?php echo get_term_link(1, 'category'); ?>">Блог авторов</a>
            <?php
                $posts_blog_menu = get_posts(array(
                    'numberposts' => 4,
                    'category'    => 1
                ));    
            ?>
            <?php if (!empty($posts_blog_menu)) { ?>
            <div uk-drop="offset: 10; mode: hover; boundary: .uk-subnav; boundary-align: true; delay-show:100">
                <div class="submenu-announces">
                    <div class="uk-child-width-1-4 uk-grid-small" uk-grid>
                        <?php foreach($posts_blog_menu as $post_blog_menu) { setup_postdata($post_blog_menu);
                        ?>
                            <?php 
                            $blog_img = get_field('blog_img');
                            ?>
                            <div>
                                <a href="<?php the_permalink(); ?>" class="announce" itemscope itemtype="http://schema.org/BlogPosting">
                                    <header class="uk-light uk-cover-container">
                                        <img src="<?php echo $blog_img['sizes']['medium']; ?>" srcset="<?php echo $blog_img['sizes']['medium_large']; ?> 2x" alt="<?php if ($blog_img['alt']) echo $blog_img['alt']; else the_title(); ?>" uk-cover itemprop="image">
                                        <div class="overlay uk-position-cover">
                                            <div class="place uk-text-small" itemprop="contentLocation">Таиланд, Аюттхая</div>
                                            <div class="title uk-h4" itemprop="name"><?php the_title(); ?></div>
                                            <time datetime="2017-11-16" class="uk-text-small"><?php echo get_the_date(); ?></time>
                                            <i class="type fa fa-file-text-o"></i>
                                        </div>
                                    </header>
                                </a>
                            </div>
                        <?php }  
                        wp_reset_postdata();
                        ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </li>
        <li>
            <a href="<?php echo get_permalink(189); ?>">О редакции</a>
        </li>
    </ul>
</nav>
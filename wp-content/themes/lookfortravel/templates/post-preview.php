<?php 
$blog_type = get_field('blog_type', get_the_ID());
$blog_recl_link = get_field('blog_reklama_link', get_the_ID());
$blog_img = get_field('blog_img', get_the_ID());
$blog_object_type = 'blog_object_type';
$blog_status_recommendation = get_field('blog_status_recomendation', get_the_ID());
?>
<div>
    <article class="announce" itemscope itemtype="http://schema.org/BlogPosting">
        <header class="uk-light uk-cover-container">
            <?php if ($blog_img) { ?>
            <img src="<?php echo $blog_img['sizes']['medium']; ?>" srcset="<?php echo $blog_img['sizes']['medium_large']; ?> 2x" alt="<?php if ($blog_img['alt']) echo $blog_img['alt']; else the_title(); ?>" uk-cover itemprop="image">
            <?php } else { ?>
            <img src="<?php bloginfo('template_url'); ?>/images/sample/announce5.jpg" srcset="<?php bloginfo('template_url'); ?>/images/sample/announce5@2x.jpg 2x" alt="<?php the_title(); ?>" uk-cover itemprop="image">
            <?php } ?>
            <div class="overlay uk-position-cover">
                <div class="place uk-text-small" itemprop="contentLocation">Таиланд, Аюттхая</div>
                <div class="title uk-h4" itemprop="name"><?php the_title(); ?></div>
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>" class="uk-text-small"><?php echo get_the_date(); ?></time>
                <meta itemprop="datePublished" content="<?php echo get_the_date('Y-m-d'); ?>">
                <?php get_icon_for_posttype($blog_type); ?>
            </div>
        </header>
        <div class="addons uk-grid-collapse uk-child-width-expand uk-text-small" uk-grid>
            <?php get_post_blog_object_type($blog_object_type); ?>
            <?php get_post_blog_recommendet($blog_status_recommendation); ?>
        </div>
        <main>
            <div itemprop="description">
                <?php the_excerpt(); ?>
            </div>
            <div>
                <?php 
                if ($blog_type === "reclama" && $blog_recl_link ) { ?>
                    <a href="<?php echo $blog_recl_link; ?>" class="uk-button uk-button-link" itemprop="url" target=_blank>Подробнее</a>
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>" class="uk-button uk-button-link" itemprop="url">Подробнее</a>
                <?php } ?>
            </div>
        </main>
    </article>
</div>
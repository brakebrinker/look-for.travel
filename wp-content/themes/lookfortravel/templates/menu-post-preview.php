<?php 
$blog_img = get_field('blog_img', get_the_ID());
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
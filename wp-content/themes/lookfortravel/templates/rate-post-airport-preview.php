<?php
    $position_rating = (int) get_field('position_rating');
    $airport_code_iata = get_field('airport_code_iata');
    $position_rating = get_field('position_rating');
?>
<li><a href="<?php the_permalink(); ?>"><span class="<?php 
get_color_of_position_rating($position_rating);
?> star uk-margin-right"><?php echo $position_rating; ?></span><?php echo '<b>' . $airport_code_iata . '</b>' . ' ' . get_the_title(); ?></a></li>
<script>
var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
</script>
<div id="true_loadmore_rate" class="uk-margin-large-bottom uk-text-center"><button class="uk-button uk-button-default">Еще</button></div>
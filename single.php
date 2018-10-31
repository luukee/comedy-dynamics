<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<?php get_template_part('template-parts/featured-image'); ?>
<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
			<?php while (have_posts()) : the_post(); ?>
				<!-- list categories function -->
				<?php

                function get_taxonomies_terms_links($args = '')
                {
                    global $post;

                    $defaults = [
        'before'            => '',
        'sep'               => '',
        'after'             => '',
        'display_tax_name'  => false,
        'taxonomy_sep'      => '&colon; &nbsp; &nbsp;',
        'multi_tax_sep'     => '</br>',
        'hierarchical'      => true
    ];
                    $args = wp_parse_args($args, $defaults);

                    $post_type = $post->post_type;
                    $taxonomies = get_object_taxonomies($post_type, 'objects');

                    $returned_list = [];
                    foreach ($taxonomies as $taxonomy_slug => $taxonomy) {
                        if ($args['hierarchical'] == $taxonomy->hierarchical && has_term('', $taxonomy_slug) && 'post_format' != $taxonomy_slug) {
                            $term_list = get_the_term_list($post->ID, $taxonomy_slug, $args['before'], $args['sep'], $args['after']);

                            if (true == $args['display_tax_name']) {
                                $returned_list[] = strtoupper($taxonomy_slug) . $args['taxonomy_sep'] . $term_list;
                            } else {
                                $returned_list[] = $term_list;
                            }
                        }
                    }

                    if ($returned_list) {
                        $count =  count($returned_list);
                        if (1 === $count) {
                            return implode('', $returned_list);
                        } else {
                            $multi_list = [];
                            foreach ($returned_list as $key=>$value) {
                                if (array_key_exists($key + 1, $returned_list)) {
                                    $multi_list[] = $value . $args['multi_tax_sep'];
                                } else {
                                    $multi_list[] = $value;
                                }
                            }
                            return implode('', $multi_list);
                        }
                    }
                }

                 ?>
				 <!-- list categories function call -->
 				<span class="cat-links">
 					<?php echo get_taxonomies_terms_links('sep=, &display_tax_name=' . false .'&taxonomy_sep=' . html_entity_decode('&raquo;&nbsp;&nbsp;')); ?>
 				</span>
				<?php get_template_part('template-parts/content', ''); ?>

				<?php the_post_navigation(); ?>
				<?php comments_template(); ?>
			<?php endwhile; ?>
		</main>
	</div>
</div>
<?php get_footer();

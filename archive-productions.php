<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

get_header(); ?>

<div class="main-container">
	<div class="main-grid">
		<main class="main-content">
		<?php if (have_posts()) : ?>

			<?php /* Start the Loop */ ?>
			<?php while (have_posts()) : the_post(); ?>

				<?php get_template_part('template-parts/content', get_post_format()); ?>
			<?php endwhile; ?>

			<?php else : ?>
				<?php get_template_part('template-parts/content', 'none'); ?>

			<?php endif; // End have_posts() check.?>

			<?php /* Display navigation to next/previous pages when applicable */ ?>
			<?php
            if (function_exists('foundationpress_pagination')) :
                foundationpress_pagination();
            elseif (is_paged()) :
            ?>
				<nav id="post-nav">
					<div class="post-previous"><?php next_posts_link(__('&larr; Older posts', 'foundationpress')); ?></div>
					<div class="post-next"><?php previous_posts_link(__('Newer posts &rarr;', 'foundationpress')); ?></div>
				</nav>
			<?php endif; ?>

		</main>
		<?php
        // // your taxonomy name
        // $tax = 'media';
        //
        // // get the terms of taxonomy
        // $terms = get_terms($tax, $args = array(
        //     'hide_empty' => true, // do not hide empty terms
        // ));
        //
        // // loop through all terms
        // foreach ($terms as $term) {
        //
        //     // Get the term link
        //     $term_link = get_term_link($term);
        //
        //     if ($term->count > 0) {
        //         // display link to term archive
        //         echo '<a href="' . esc_url($term_link) . '">' . $term->name .'</a>';
        //     } elseif ($term->count !== 0) {
        //         // display name
        //         echo '' . $term->name . ' ';
        //     }
        // }
        ?>

	</div>
</div>



<?php get_footer();

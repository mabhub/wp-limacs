<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header class="entry-header">

				<div class="event-date"><strong><?php eo_the_start('j F Y'); ?></strong></div>

				<!-- Display event title -->
				<h1 class="entry-title"><?php the_title(); ?></h1>
				<div class="entry-meta"><?php edit_post_link( __( 'Edit'), '<span class="edit-link">', '</span>' ); ?></div>

			</header><!-- .entry-header -->

			<div class="entry-content">
				<!-- The content or the description of the event-->
				<?php the_content(); ?>

				<!-- Registr button -->
				<div class="register-button">
					<?php
						$now         = new DateTime('now', eo_get_blog_timezone());
						$start       = eo_get_event_schedule()['start'];
						$register_on = ($start > $now);
						$formId      = uniqid();
						if ($register_on && !has_term('Sortie', 'event-category')):
					?>
						<a class="fancybox-inline button" href="#inscription-<?php echo $formId; ?>">S'inscrire</a>
						<div class="fancybox-hidden" style="display: none;">
						<div id="inscription-<?php echo $formId; ?>" style="max-height: 600px; overflow: auto;"><?php echo do_shortcode( LIMACS_EVENT_REGISTER_FORM ); ?></div>
						</div>
					<?php endif; ?>
				</div>

				<!-- Get event information, see template: event-meta-event-single.php -->
				<?php eo_get_template_part('event-meta','event-single'); ?>
			</div><!-- .entry-content -->

			<footer class="entry-meta">
			<?php

			/*
				//Events have their own 'event-category' taxonomy. Get list of categories this event is in.
				$categories_list = get_the_term_list( get_the_ID(), 'event-category', '', ', ','');

				if ( '' != $categories_list ) {
					$utility_text = __( 'This event was posted in %1$s by <a href="%5$s">%4$s</a>. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
				} else {
					$utility_text = __( 'This event was posted by <a href="%5$s">%4$s</a>. Bookmark the <a href="%2$s" title="Permalink to %3$s" rel="bookmark">permalink</a>.', 'eventorganiser' );
				}
				printf($utility_text,
					$categories_list,
					esc_url( get_permalink() ),
					the_title_attribute( 'echo=0' ),
					get_the_author(),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
				);

				*/
			?>


			</footer><!-- .entry-meta -->

			</article><!-- #post-<?php the_ID(); ?> -->

			<!-- If comments are enabled, show them -->
			<div class="comments-template">
				<?php comments_template(); ?>
			</div>

		<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();

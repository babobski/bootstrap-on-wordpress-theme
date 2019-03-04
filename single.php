<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 3.3.7
 * @autor 		Babobski
 */
?>
<?php BsWp::get_template_parts( array( 'parts/shared/html-header', 'parts/shared/header' ) ); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<div class="wp-post-header">
		<h2 class="wp-post-title">
			<?php the_title(); ?>
		</h2>
		<time class="wp-post-timestamp" datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
			<?php the_date(); ?> <?php the_time(); ?>
		</time> 
		<span class="wp-post-comment-popup-link">
			<?php comments_popup_link(__('Leave a Comment', 'wp_babobski'), __('1 Comment', 'wp_babobski'), __('% Comments', 'wp_babobski')); ?>
		</span>
	</div>

	<div class="content">
		<?php the_content(); ?>			
	</div>

	<div class="wp-post-footer">
		<div class="wp-post-author">
			<?php if ( get_the_author_meta( 'description' ) ) : ?>
				<?php echo get_avatar( get_the_author_meta( 'user_email' ) ); ?>
				<h3>
					<?php echo __('About', 'wp_babobski'); ?> <?php echo get_the_author() ; ?>
				</h3>
				<?php the_author_meta( 'description' ); ?>
			<?php endif; ?>
	    </div>
	    <div class="wp-post-comment">
			<?php comments_template( '', true ); ?>
		</div>
	</div>
<?php endwhile; ?>

<?php BsWp::get_template_parts( array( 'parts/shared/footer','parts/shared/html-footer' ) ); ?>

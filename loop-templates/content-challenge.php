<?php
/**
 * Partial template for content in challenge.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php the_content(); ?>
		 <a class="btn btn-primary" data-toggle="collapse" href="#submitWork" role="button" aria-expanded="false" aria-controls="collapseExample">
		   Submit Work
		  </a>		
		  <div class="collapse" id="submitWork">
  			<div class="card card-body">
				<?php echo do_shortcode('[gravityform id="1" title="false"  field_values="tag=foo" description="false"]'); ?>
			</div>
		</div>
		<?php 
			if (current_user_can('administrator')){
				get_challenges(get_the_title());
			}
			?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

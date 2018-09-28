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
		<?php echo acf_fetch_daily_challenge_description();?>
		<?php
		 $daily_tag = acf_fetch_daily_challenge_hashtag();
		 echo challenge_submission_structure($daily_tag);?>

		<?php echo acf_fetch_weekly_challenge_description();?>
		
		<?php 
		$weekly_tag = acf_fetch_weekly_challenge_hashtag();
		echo challenge_submission_structure($weekly_tag);?>
		 
		<?php 
			if (current_user_can('administrator')){
				get_challenges(get_the_title(),'foo');
			}
			?>
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>

	</div><!-- .entry-content -->

	<!--CONTACT Modal -->
	<div class="modal fade" id="submissionModal" tabindex="-1" role="dialog" aria-labelledby="submitWork" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <button type="button" class="close" data-dismiss="modal" id="closer" aria-label="Close">
	          <span aria-hidden="true">Close <span class="close-x">X</span></span>
	        </button>
	      <div class="modal-header">
	        <h2 class="modal-title" id="submitWork">Submit Work</h2>       
	      </div>
	      <div class="modal-body">
	        <div id="the-person"></div>
	        <?php echo do_shortcode('[gravityform id="1" title="false" description="false"]');?>
	      </div>
	      <div class="modal-footer">        
	      </div>
	    </div>
	  </div>
	</div>
	    <!-- END Modal -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

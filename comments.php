<?php
/**
 * comments.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
 // Do not delete these lines
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) { die ( __( 'Please do not load this page directly. Thanks!', 'tpBranches' ) ); }
?>

<div id="comments">
<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'tpBranches' ); ?></p>
</div><!-- #comments -->
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if (have_comments()): ?>
	<h4 class="numcomments">
		<?php printf( _n( 'One Response to %2$s', '%1$s Responses to %2$s', get_comments_number(), 'tpBranches' ), number_format_i18n( get_comments_number() ), '<em>' . get_the_title() . '</em>' ); ?>
	</h4>
	
	<div class="commentlist">
		<?php wp_list_comments( array( 'callback' => 'tpBranches_custom_comment', 'avatar_size' => 64 )); ?>
	</div>
	<div class="pagenav">
		<?php paginate_comments_links(); ?>
	</div>
    
    <div class="pagenav">
        <div class="alignleft">
            <?php previous_comments_link() ?>
        </div>
        <div class="alignright">
            <?php next_comments_link() ?>
        </div>
        <br/>
    </div>
    
<?php else: // this is displayed if there are no comments so far ?>

	<?php if (comments_open()): // If comments are open, but there are no comments. ?>
	
	<?php else: // comments are closed
		if ( comments_open() ) : ?>
		<p class="nocomments"><?php _e('Comments are closed.', 'tpBranches');?></p>
		<?php endif; ?>
	<?php endif; ?>
	
<?php endif; ?>
	
<?php comment_form(); ?> 


</div>

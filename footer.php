<?php
/**
 * footer.php
 *
 * @package      tpBranches
 * @author       Ed Ehrgott <ed@tekpals.com>
 * @copyright    Copyright (c) 2011, Ed Ehrgott
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
 */
?>

		    <div id="footer">
				<div id="footer-left">
				   <ul>
				   <?php
				   if ( is_active_sidebar( 'footer-left' ) ) : dynamic_sidebar( 'footer-left' );

				   endif; ?>
				   </ul>
				 </div>
			 
				<div id="footer-right">
				   <ul>
				   <?php
				   if ( is_active_sidebar( 'footer-right' ) ) : dynamic_sidebar( 'footer-right' );
				   // no default widgets for secondary
				   endif; ?>
				   </ul>
				</div>
				
				<div id="footer-center">
				   <ul>
				   <?php
				   if ( is_active_sidebar( 'footer-center' ) ) : dynamic_sidebar( 'footer-center' );
				   // no default widgets for secondary
				   endif; ?>
				   </ul>
				</div>				
							
				<div id="footer_txt">
				  Copyright &copy; <?php echo date('Y'); ?>. <?php echo esc_html( get_bloginfo('name'), 1 ); ?> All rights reserved.&nbsp;|&nbsp;Powered by <a href="http://www.wordpress.org">WordPress</a>&nbsp;|&nbsp;tpBranches theme by <a href="http://www.tekpals.com">Tekpals</a>.
				</div>

		    </div> <!-- footer -->
	  </div> <!-- wrapper2 -->  
</div> <!-- wrapper1 -->
<?php wp_footer(); ?>
</body>
</html>
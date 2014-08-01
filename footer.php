<div class="bg-footer">
    		<div class="footer">
    		
    		<?php dynamic_sidebar( 'Footer Widget Area' ); ?>
    			
    			<ul class="social">
    				<li class="fb"><a href="<?php echo get_theme_mod( 'facebook' ); ?>"></a></li>
    				<li class="tw"><a href="<?php echo get_theme_mod( 'twitter' ); ?>"></a></li>
    				<li class="sk"><a href="<?php echo get_theme_mod( 'skype' ); ?>"></a></li>
    				<li class="go"><a href="<?php echo get_theme_mod( 'google' ); ?>"></a></li>
    			</ul>
    			<p>Copyright &copy; 2009–<?php the_date('Y'); ?> <a href=""#>Cssauthor.com</a></p>
    		</div>
    	</div>
    	<?php wp_footer(); ?>
    	
</body>
</html>

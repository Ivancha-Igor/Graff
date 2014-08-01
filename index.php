<?php get_header(); ?>

<div class="content">
    		<h2>welcome to <?php bloginfo('name'); ?></h2>
    		<span class="name"><?php bloginfo('description'); ?></span>
    		
    		<?php dynamic_sidebar( 'Content Widget Area' ); ?>
    		
    		
    		<div class="block-content">
    			<ul>
    				<?php 
					if ( have_posts() ) {
					while ( have_posts() ) {
						the_post(); ?>
						<li><?php if ( has_post_thumbnail() ) {
                            					the_post_thumbnail();
                        				} ?>
                        				<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                        				<?php the_content(); ?>
                        			</li>
			
						<?php } // end while
					} // end if
				?>
    			</ul> 
    		</div>
    	</div>
    	
<?php get_footer(); ?>


<?php


function theme_name_scripts() {
	wp_enqueue_style( 'graff', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'theme_name_scripts' );


register_nav_menus( array(
	'header_menu' => 'Header Menu'
) );


function graff_customize_register( $wp_customize ) {
   //All our sections, settings, and controls will be added here
   
   $wp_customize->add_setting( 'logo_image' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_section( 'graff_logo' , array(
    'title'      => __( 'Logo', 'graff' ),
    'priority'   => 15,
   ) );
   
   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_logo', array(
	'label'        => __( 'Upload_logo', 'graff' ),
	'section'    => 'graff_logo',
	'settings'   => 'logo_image',
    ) ) );
    
    
    $wp_customize->add_setting( 'background_image' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_section( 'background' , array(
    'title'      => __( 'Background', 'graff' ),
    'priority'   => 30,
   ) );
   
   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'upload_background', array(
	'label'        => __( 'Upload_background', 'graff' ),
	'section'    => 'background',
	'settings'   => 'background_image',
    ) ) );
    
    
    $wp_customize->add_setting( 'facebook' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_section( 'social' , array(
    'title'      => __( 'Social', 'graff' ),
    'priority'   => 50,
   ) );
   
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'facebook', array(
	'label'        => __( 'Facebook', 'graff' ),
	'section'    => 'social',
	'settings'   => 'facebook',
    ) ) );
    
    
     $wp_customize->add_setting( 'twitter' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'twitter', array(
	'label'        => __( 'Twitter', 'graff' ),
	'section'    => 'social',
	'settings'   => 'twitter',
    ) ) );
    
    
     $wp_customize->add_setting( 'skype' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'skype', array(
	'label'        => __( 'Skype', 'graff' ),
	'section'    => 'social',
	'settings'   => 'skype',
    ) ) );
    
    
     $wp_customize->add_setting( 'google' , array(
    'transport'   => 'refresh',
   ) );
   
   $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'google', array(
	'label'        => __( 'Google', 'graff' ),
	'section'    => 'social',
	'settings'   => 'google',
    ) ) );
}

add_action( 'customize_register', 'graff_customize_register' );


function graff_customize_css()
{
    ?>
         <style type="text/css">
             body { background:url(<?php echo get_theme_mod('background_image'); ?>)no-repeat; background-size: 100%; }
         </style>
    <?php
}
add_action( 'wp_head', 'graff_customize_css');


function graff_widgets_init() {

	/*pimary sidebar*/
	register_sidebar( array(
		'name' => __( 'Content Widget Area' ),
		'description' => __( 'The content widget area' ),
		'before_title' => '<h3>',
    		'after_title'  => '</h3>',

	) );	
	
	/*second sidebar*/
	register_sidebar( array(
		'name' => __( 'Footer Widget Area' ),
		'description' => __( 'The footer widget area' ),
		'before_title' => '<h5>',
    		'after_title'  => '</h5>',

	) );	
}

add_action( 'widgets_init', 'graff_widgets_init' );


/**
 * Adds Foo_Widget widget.
 */
class Services_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'services_widget', // Base ID
			__('Services Widget', 'graff'), // Name
			array( 'description' => __( 'All Services', 'graff' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) ) 
			echo $args['before_title'] . $title . $args['after_title'];
		
		
		
		$args_loop = array( 'post_type' => 'services', 'posts_per_page' => -1 );
		$loop = new WP_Query( $args_loop ); ?>
		
		<ul class="services">
		<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
		
  		<li><a href="#"> <?php the_post_thumbnail(); ?> <span><?php the_title(); ?></span></a></li>
  		
		<?php endwhile; ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_service_widget() {
    register_widget( 'Services_Widget' );
}
add_action( 'widgets_init', 'register_service_widget' );


  
function post_type_init() { // создаем новый тип записи
	register_post_type( 'services', // указываем названия типа
		array( 
			'labels' => array( 
			'name' => __( 'Services' ), // даем названия разделу для панели управления
			'singular_name' => __( 'Service' ), // даем названия одной записи
			'add_new' => __('add new'),
			'add_new_item' => __('add new service'),
			'menu_name' => ('Service')
			), 
			'public' => true, 
			'menu_position' => 5, // указываем место в левой баковой панели
			'rewrite' => array('slug' => 'services'), // указываем slug для ссылок 
			'supports' => array('title', 'editor', 'thumbnail', 'revisions'), // тут мы активируем поддержку миниатюр
			'has_archive' => true 
		) 
	); 
} 

add_action( 'init', 'post_type_init' ); // инициируем добавления типа


add_theme_support( 'post-thumbnails' ); 


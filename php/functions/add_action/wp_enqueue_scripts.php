<?php
add_action( 'wp_enqueue_scripts', function(){
  wp_enqueue_style('font-awesome', get_template_directory_uri() . "/vender/fontawesome/css/all.min.css", array(), '5.15.2');
  wp_enqueue_style('swiper', get_template_directory_uri() . "/vender/swiper/css/swiper-bundle.min.css", array(), '6.0.4');
  wp_enqueue_style('tailwind', get_template_directory_uri() . "/vender/tailwind/css/tailwind.css", array());
  wp_enqueue_style('google-fonts', "//fonts.gstatic.com", array());
  wp_enqueue_style('font-roboto', "//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap", array());
  wp_enqueue_style('style', get_template_directory_uri() . '/css/styles.css', array(), '1.0.0');
  wp_enqueue_style('wp-style', get_template_directory_uri() . '/css/wp-style.css', array(), '1.0.0');
  wp_enqueue_style('editor-style', get_template_directory_uri() . '/css/editor-style.css', array(), '1.0.0');

  wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/vender/scrollreveal/js/scrollreveal.min.js', array(), '4.0.7', true);
  wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/vender/swiper/js/swiper-bundle.min.js', array(), '6.0.4', true);
  wp_enqueue_script('index', get_template_directory_uri() . '/js/index.js', array(), '1.0.0', true );
  wp_enqueue_script('scroll', get_template_directory_uri() . '/js/scroll.js', array(), '1.0.0', true );
  wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.js', array(), '1.0.0', true );
});
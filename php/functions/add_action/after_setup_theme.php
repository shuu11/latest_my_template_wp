<?php
add_action( 'after_setup_theme', function(){
  add_theme_support("editor-styles");
  add_theme_support('wp-block-styles');
  add_theme_support('align-wide');
  add_theme_support('responsive-embeds');
});

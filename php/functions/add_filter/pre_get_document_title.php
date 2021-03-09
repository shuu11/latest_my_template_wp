<?php
add_filter( 'pre_get_document_title', function($title){
  if ( is_front_page() && is_home() ) {
    $title = get_bloginfo( 'name', 'display' );
  } elseif ( is_singular()) {
    $title = single_post_title( '', false );
  }

  return $title;
});
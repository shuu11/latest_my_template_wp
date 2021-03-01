<?php

add_action('init',function(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('custom-header');
  add_theme_support('custom-background');
  add_theme_support("editor-styles");

  register_nav_menus( array(
    'categorymenu' => 'カテゴリーメニュー',
    'footermenu' => 'フッターメニュー',
    ) );
});

if ( ! isset( $content_width ) ) {
  $content_width = 1920;
}

//  editor style
function editor_style() {
  add_editor_style( get_template_directory_uri() . "/css/editor-style.css");
}
add_action( 'admin_init', 'editor_style' );

//  ウィジェット有効
// function widgets_init() {
//   register_sidebar (
//       array(
//           'name'          => 'カテゴリーウィジェット',
//           'id'            => 'category_widget',
//           'description'   => 'カテゴリー用ウィジェットです',
//           'before_widget' => '<div id="%1$s" class="widget %2$s">',
//           'after_widget'  => '</div>',
//           'before_title'  => '<h2><i class="fa fa-folder-open" aria-hidden="true"></i>',
//           'after_title'   => "</h2>\n",
//       )
//   );
// }
// add_action( 'widgets_init', 'widgets_init' );

 // タイトル出力
function my_title($title) {
  if ( is_front_page() && is_home() ) {
    $title = get_bloginfo( 'name', 'display' );
  } elseif ( is_singular()) {
    $title = single_post_title( '', false );
  }

  return $title;
}
add_filter( 'pre_get_document_title', 'my_title' );

//  サムネイル取得
function my_get_thumbnail($sts = false){
  if(has_post_thumbnail()){
    $id = get_post_thumbnail_id();
    $img = wp_get_attachment_image_src($id , 'large');
  }
  else{
    if($sts == true){
      $img = array(get_template_directory_uri() . '/image/card_archive@2x.jpg');
    }
  }

  return $img[0];
}

//  ページネーション
function my_pagenation($page_num = 3){
    global $paged;
    global $wp_query;

    $now = $paged;
    $max = $wp_query->max_num_pages;

    if(empty($now) == true){
      $now = 1;
    }

    if(!$max){
      $max = 1;
    }

    if(1 != $max){
      echo '<div class="p-pagenation">';
      echo  '<span class="p-pagenation__num">page '.$now.'/'.$max.'</span>';

      if($now > 1){
        echo '<span class="p-pagenation__pre"><a href="'.get_pagenum_link($now - 1).'">&#8810;<span>前へ</span></a></span>';
      }

      echo  '<ul class="p-pagenation__list">';

      for ($i=1; $i <= $max; $i++){
        if($now == $i){
          echo '<li><a class="c-current" href="#">'.$i.'</li>';
        }
        else{
          if( $i >= $now - $page_num && $i <= $now + $page_num){
            echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
          }
        }
      }
      echo  '</ul>';

      if($max > $now){
        echo '<span class="p-pagenation__next"><a href="'.get_pagenum_link($now + 1).'"><span>次へ</span>&#8811;</a></span>';
      }

      echo '</div>';
    }
}

//  stylesheet,script読み込み
function my_script() {
  wp_enqueue_style('font-awesome', get_template_directory_uri() . "/vender/fontawesome/css/all.min.css", array(), '5.15.2');
  wp_enqueue_style('swiper', get_template_directory_uri() . "/vender/swiper/css/swiper-bundle.min.css", array(), '6.0.4');
  wp_enqueue_style('tailwind', get_template_directory_uri() . "/vender/tailwind/css/tailwind.css", array());
  wp_enqueue_style('google-fonts', "//fonts.gstatic.com", array());
  wp_enqueue_style('font-roboto', "//fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap", array());
  wp_enqueue_style('style', get_template_directory_uri() . '/css/styles.css', array(), '1.0.0');
  wp_enqueue_style('wp-style', get_template_directory_uri() . '/css/wp-style.css', array(), '1.0.0');

  wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/vender/scrollreveal/js/scrollreveal.min.js', array(), '4.0.7', true);
  wp_enqueue_script('scrollreveal', get_template_directory_uri() . '/vender/swiper/js/swiper-bundle.min.js', array(), '6.0.4', true);
  wp_enqueue_script('index', get_template_directory_uri() . '/js/index.js', array(), '1.0.0', true );
  wp_enqueue_script('scroll', get_template_directory_uri() . '/js/scroll.js', array(), '1.0.0', true );
  wp_enqueue_script('swiper', get_template_directory_uri() . '/js/swiper.js', array(), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_script' );

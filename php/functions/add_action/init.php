<?php
add_action('init',function(){
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('automatic-feed-links');
  add_theme_support('custom-header');
  add_theme_support('custom-background');
  add_theme_support('html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));

  register_nav_menus( array(
    'categorymenu' => 'カテゴリーメニュー',
    'footermenu' => 'フッターメニュー',
  ));

  register_post_type('item',[
    'label' => '商品',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-store',
    'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
    'has_archive' => true,
    'show_in_rest' => true,
  ]);

  register_taxonomy( 'type', 'item', [
    'label' => '商品の分類',
    'hierarchical' => true,
    'show_ui' => true,
  ]);
});
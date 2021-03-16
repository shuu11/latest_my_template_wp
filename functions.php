<?php
/**
 * Add Theme Supports
 * WordPressのテーマ拡張機能の有効化
 */

get_template_part("./php/functions/add_action/init"); // アクションフック:'init'
get_template_part("./php/functions/add_action/after_setup_theme"); // アクションフック:'after_setuo_theme'
get_template_part("./php/functions/add_action/admin_init"); // アクションフック:'admin_init'
get_template_part("./php/functions/add_action/widgets_init"); // アクションフック:'widgets_init'
get_template_part("./php/functions/add_action/wp_enqueue_scripts"); // アクションフック:'wp_enqueue_scripts'

get_template_part("./php/functions/add_filetr/pre_get_document_title"); // フィルターフック:'pre_get_document_title'

get_template_part("./php/functions/my-function/my_thumbnail"); // my function:'my_get_thumbnail'
get_template_part("./php/functions/my-function/my_pagenation"); // my function:'my_pagenation'

if (!isset($content_width)) {
	$content_width = 1920;
}
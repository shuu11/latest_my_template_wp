<?php
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
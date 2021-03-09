<?php
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
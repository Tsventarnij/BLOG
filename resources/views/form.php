<?php


  foreach($aBlog as $blog)
    echo '<h1>'.$blog->title.'</h1>';
    echo '<p>Автор:  '.$blog->author.'</p>';
    echo '<p>Дата публикации: '.$blog->created_at.'</p>';
    echo '<p>'.$blog->body.'</p>';
    echo '<p><a href="/read/'.$blog->id.'">Читать далее</a></p>';
    echo '<p><a href="/change/'.$blog->id.'">Редактировать</a></p>';
    echo '<p><a href="/delete/'.$blog->id.'">Удалить</a></p>';
  endforeach
?>

@extends('template')

@section('title')
Редактирование записи
@endsection

@section('navigation')
@parent
@endsection

@section('content')
<div class="entry">
<form name="newBlog" method="post" action="/edit/{{$post->id}}"  enctype="multipart/form-data">
{{csrf_field() }}
  <p><b>Ваше имя:</b><br>
   <input name="author" size="40" required value="{{$post->author}}">
  </p>
  <p><b>Ваш заголовок:</b><br>
   <input name="title" size="40" required  value="{{$post->title}}">
  </p>
  <p><b>Ваша картинка:</b><br>
   <input type="file" name="image" accept="image/*,image/jpeg">
  </p>
  <p>Содержание<Br>
   <textarea name="body" cols="80" rows="10" required>{{$post->body}}</textarea></p>
  <p><input type="submit" value="Отправить">
   <input type="reset" value="Очистить"></p>
 </form>
</div>

@endsection

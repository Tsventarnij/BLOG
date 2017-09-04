@extends('template')

@section('title')
Добаление новой записи
@endsection

@section('navigation')
@parent
@endsection

@section('content')
<div class="entry">
@if(auth()->check())
  <form name="newBlog" method="post" action="/posts" enctype="multipart/form-data">
  {{csrf_field() }}
  <!--  <p><b>Ваше имя:</b><br>
     <input name="author" size="40" required>
   </p> -->
    <p><b>Ваш заголовок:</b><br>
     <input name="title" size="40" required>
    </p>
    <p><b>Ваша картинка:</b><br>
     <input type="file" name="image" accept="image/*,image/jpeg">

    </p>
    <p>Содержание<Br>
     <textarea name="body" cols="80" rows="10" required></textarea></p>
    <p><input type="submit" value="Отправить">
     <input type="reset" value="Очистить"></p>
   </form>
@else
<p class="text.center"> Пожалуйста пройдите процедуру <a href="{{route('login')}}">авторизации</a></p>
@endif
</div>

@endsection

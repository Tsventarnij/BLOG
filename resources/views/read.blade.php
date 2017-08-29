@extends('template')

@section('title')
{{$post->title}}
@endsection

@section('navigation')
@parent
@endsection

@section('content')
<div class="entry">
        <h1>{{$post->title}}</h1>
        <p>Автор:  {{$post->author}}</p>
        <p>Дата публикации: {{$post->created_at}}</p>
        @if($post->created_at!=$post->updated_at)
          <p>Дата обновления: {{$post->updated_at}})</p>
        @endif
        @if($post->image!=NULL)
        <img src="{{$post->image}}" width="400" height="255" >
        @endif
        <p>{{$post->body}}</p>
        <p><a href="/delete/{{$post->id}}">Удалить пост</a></p>
        <p><a href="/change/{{$post->id}}">Редактировать</a></p>
</div>
@endsection

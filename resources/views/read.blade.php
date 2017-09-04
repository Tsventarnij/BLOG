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
        <p>Автор:  {{$post->creator->name}}, 
        Дата публикации: {{$post->created_at}}<br/>
        @if($post->created_at!=$post->updated_at)
          Дата обновления: {{$post->updated_at}})<br/>
        @endif
        {{$post->isLike()}}<br/>

        <?php
        $atributs=['posts_id'=>$post->id,
                   'like'=>'1'];
        $requ=\App\Like::where($atributs)->first();
        if($requ['user_id']==auth()->id()){
        ?>
        <a href="/change/{{$post->id}}">Редактировать</a><?php } ?>
        @if(auth()->id()==$post->user_id)
        <a href="/delete/{{$post->id}}">Удалить пост</a>
        @endif
      </p>
        @if($post->image!=NULL)
        <img src="{{$post->image}}" width="400" height="255" >
        @endif
        <p>{{$post->body}}</p>
        @include('likerForm')

</div>
@endsection

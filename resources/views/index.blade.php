@extends('template')

@section('title')
Блог ни о чем
@endsection

@section('navigation')
@parent
@endsection

@section('content')

     @foreach($posts as $post)

       <p class="meta"><span class="date">{{$post->created_at}}</span> Posted by {{$post->creator->name}}
         @if($post->created_at!=$post->updated_at)
         <span class="date">(обновлен {{$post->updated_at}})</span>
         @endif
         {{$post->isLike()}}
         @include('likerForm')
       </p>
       <h2 class="title"><a href="#">{{$post->title}} </a></h2>
       <div class="entry">
         {{$post->body}}
         <p><a href="/posts/{{$post->id}}">Читать далее</a></p>
     </div>

      @endforeach

@endsection

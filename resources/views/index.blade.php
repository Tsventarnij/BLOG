@extends('template')

@section('title')
Блог ни о чем
@endsection

@section('navigation')
@parent
@endsection

@section('content')

     @foreach($posts as $blog)
     <div class="post">
       <p class="meta"><span class="date">{{$blog->created_at}}</span> Posted by {{$blog->author}}
         @if($blog->created_at!=$blog->updated_at)
         <span class="date">(обновлен {{$blog->updated_at}})</span>
         @endif
       </p>
       <h2 class="title"><a href="#">{{$blog->title}} </a></h2>
       <div class="entry">
         {{$blog->body}}
         <p><a href="/posts/{{$blog->id}}">Читать далее</a></p>
     </div></div>

      @endforeach

@endsection

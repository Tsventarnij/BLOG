<form name="like" method="post" action="/like/{{$post->id}}" enctype="multipart/form-data">
{{csrf_field() }}
<input type="hidden" value="1" name="like">
  <input type="submit" value="Понравилось{{App\Like::where('posts_id', '=', $post->id)->where('like', '=', '1')->count()}}">

 </form>
 <form name="like" method="post" action="/like/{{$post->id}}" enctype="multipart/form-data">
 {{csrf_field() }}
 <input type="hidden" value="1" name="unlike">
   <input type="submit" value="Непонравилось{{App\Like::where('posts_id', '=', $post->id)->where('unlike', '=', '1')->count()}}">

  </form>

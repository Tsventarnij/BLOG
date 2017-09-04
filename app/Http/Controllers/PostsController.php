<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
use App\Like;
class PostsController extends Controller
{
     public function index() {
        $posts=Posts::latest()->where('deleted', '==', '0')->get();

        return view('index', compact('posts'));
      }
      public function censor($str){
          $arrCensor=["бублик", "ревербератор", "кастет", "хорь", "алкоголь",
          "превысокомногорассмотрительствующий", "гражданин", "паста"];

          $arrString=preg_split('//u', $str, null, PREG_SPLIT_NO_EMPTY);
          for($i=0; $i<count($arrCensor); $i++){
              $pos=mb_stripos($str,$arrCensor[$i],0);

              while($pos!==false){
                $censorLen=mb_strlen($arrCensor[$i]);
                for($j=1; $j<$censorLen-1; $j++){
                  $arrString[$pos+$j]='*';
                }
                $pos=mb_stripos($str,$arrCensor[$i],$pos+$censorLen);
              }
            }

        return implode($arrString);
      }

      public function new() {

         return view('new');
       }

       public function posts(Request $request) {
        // $this->validate($request, [
        //  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        //  ]);

          $image = $request->file('image');
          if($image!=NULL){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/'), $input['imagename']);
            $image='/'.$input['imagename'];
          }
          Posts::create([
            "user_id" => auth()->id(),
            "title" => $this->censor(request('title')),
            "body" => $this->censor(request('body')),
            "image" => $image,
          ]);

          return redirect('/');

        }
        public function edit($id, Request $request) {
          $atributs=['posts_id'=>$id,
                     'like'=>'1'];
          $requ=Like::where($atributs)->first();
          if($requ['user_id']==auth()->id()){
              $image = $request->file('image');
              if($image!=NULL){
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('/'), $input['imagename']);
                $image='/'.$input['imagename'];
              }
              Posts::find($id)->update([
                "title" => $this->censor(request('title')),
                "body" => $this->censor(request('body')),
                "image" => $image,
              ]);
           }
           return redirect('/');

         }


      public function liker($id){
        $atributs=['user_id'=>auth()->id(),
                   'posts_id'=>$id];
        $like=request(["like"])['like'];
        $unLike=request(["unlike"])['unlike'];

        $requ=Like::where($atributs)->first();
        if($requ==NULL){
          Like::create([
            'user_id'=>auth()->id(),
            'posts_id'=>$id,
            'like'=>$like,
            'unlike'=>$unLike,
          ]);
        }else{
          if($like){
            if($requ['like']) $like=false;
            if($requ['unlike']) $unLike=false;
          }
          if($unLike){
            if($requ['like']) $like=false;
            if($requ['unlike']) $unLike=false;
          }
          $requ->find($requ['id'])->update([
            'like'=>$like,
            'unlike'=>$unLike,
          ]);
        }
        return redirect()->back();
      }

      public function show($id){

        $post=Posts::where('deleted', '==', '0')->find($id);
        //$post->title=request('title');
        //$post->body=request('body');
        return view('read', compact('post'));
      }
      public function delete($id) {
        //dd(Posts::find($id)->user_id);
        if(auth()->id()==Posts::find($id)->user_id){
          Posts::find($id)->update(['deleted'=>'1']);
        }
        return redirect('/');

       }
       public function change($id) {
         $post=Posts::find($id);
          return view('edit', compact('post'));
        }
}

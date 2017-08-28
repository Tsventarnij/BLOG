<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Posts;
class PostsController extends Controller
{
     public function index() {
        $posts=Posts::latest()->where('deleted', '==', '0')->get();
        return view('index', compact('posts'));
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
            $reqPost=request(['title','author','body','image']);
            $reqPost['image']=$input['imagename'];
            Posts::create($reqPost);

          }else{
            Posts::create(request(['title','author','body']));
          }

          return redirect('/');

        }
        public function edit($id, Request $request) {
          $image = $request->file('image');
          if($image!=NULL){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('/'), $input['imagename']);
            $reqPost=request(['title','author','body','image']);
            $reqPost['image']=$input['imagename'];
            Posts::find($id)->update($reqPost);

          }else{
            Posts::find($id)->update(request(['title','author','body']));
          }
           return redirect('/');

         }

      public function show($id){

        $post=Posts::where('deleted', '==', '0')->find($id);
        //$post->title=request('title');
        //$post->body=request('body');
        return view('read', compact('post'));
      }
      public function delete($id) {
          Posts::find($id)->update(['deleted'=>'1']);

         return redirect('/');

       }
       public function change($id) {
         $post=Posts::find($id);
          return view('edit', compact('post'));
        }
}

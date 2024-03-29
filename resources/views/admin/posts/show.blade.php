@extends('layouts.app')

@section('content')

    <div id="root" class="row justify-content-center">

       <div class="col-md-3">
           <div class="card">
               <div class="card-header">{{$post->title}}</div>

               <div class="card-body">
                 <div class="image">
                   <img src="{{asset($post->cover)}}" alt="">
                 </div>
                 @if ($post->category)
                  <h4>Category:{{$post->category->name}}</h4>
                 @endif
                   {{$post->content}}
               </div>

              <a href="{{route('admin.posts.edit', ['post' => $post->id])}}">Edit</a>
              <div class="elimina">
                  <button type="btn btn-primary" name="button" @click= "delete_comic({{$post->id}})">Delete</button>
                  <div class="si-no" v-if="{{$post->id}} == id">
                    <form class="" action="{{route('admin.posts.destroy',['post'=>$post->id])}}" method="post" v-if="id!=null">
                      @csrf
                      @method('DELETE')
                      <input type="submit" name="Delete" value="Si " >
                    </form>
                    <button type="button" name="button"  @click= "no_elimina()" v-if="id!=null">NO</button>
                  </div>

              </div>
           </div>

       </div>
    </div>
</div>
@endsection

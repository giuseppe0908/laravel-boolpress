@extends('layouts.app')

@section('content')
<div id="root" class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="{{route('admin.posts.create')}}">Crea post</a>
    </div>

  </div>
    <div class="row justify-content-center">
       @foreach ($posts as $post)
       <div class="col-md-3">
         <a href="{{route('admin.posts.show', ['post' => $post->id])}}">
           <div class="card">
               <div class="card-header">{{$post->title}}</div>

               <div class="card-body">
                   {{$post->content}}
               </div>
              <a class="btn btn-primary" href="{{route('admin.posts.edit', ['post' => $post->id])}}">Edit</a>
              <div class="elimina">
                  <button class="btn btn-primary" type="button" name="button" @click= "delete_comic({{$post->id}})">Delete</button>
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
          </a>
       </div>
       @endforeach

    </div>
</div>
@endsection

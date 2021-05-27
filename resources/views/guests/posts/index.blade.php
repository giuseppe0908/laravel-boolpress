@extends('layouts.app')

@section('content')
<div id="root" class="container">

    <div class="row justify-content-center">
       @foreach ($posts as $post)
       <div class="col-md-3">
         <a href="{{route('posts.show', ['slug' => $post->slug])}}">
           <div class="card">
               <div class="card-header">{{$post->title}}</div>
               <div class="card-body">
                   {{$post->content}}
               </div>
           </div>
          </a>
       </div>
       @endforeach


    </div>
</div>
@endsection

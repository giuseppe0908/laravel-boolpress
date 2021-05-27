@extends('layouts.app')

@section('content')

    <div class="row justify-content-center">

       <div class="col-md-3">
           <div class="card">
              <div class="card-header">{{$post->title}}</div>

               <div class="card-body">
                 @if ($post->category)
                 <h4>Category:<a href="{{route('categories.index',['slug'=> $post->category->slug])}}">{{$post->category->name}}</a></h4>
                 @endif
                   {{$post->content}}
               </div>
              </div>
           </div>
       </div>
    </div>
</div>
@endsection

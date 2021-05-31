@extends('layouts.app')

@section('content')
<div id="root" class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="{{route('admin.tags.create')}}">Crea tag</a>
    </div>

  </div>
    <div class="row justify-content-center">
       @foreach ($tags as $tag)
       <div class="col-md-3">
         <a href="{{route('admin.tags.show', ['tag' => $tag->id])}}">
           <div class="card">
               <div class="card-header">{{$tag->name}}</div>


              <a class="btn btn-primary" href="{{route('admin.tags.edit', ['tag' => $tag->id])}}">Edit</a>
              <div class="elimina">
                  <button class="btn btn-primary" type="button" name="button" @click= "delete_comic({{$tag->id}})">Delete</button>
                  <div class="si-no" v-if="{{$tag->id}} == id">
                    <form class="" action="{{route('admin.tags.destroy',['tag'=>$tag->id])}}" method="POST" v-if="id!=null">
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

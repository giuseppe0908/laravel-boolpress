@extends('layouts.app')

@section('content')
<div id="root" class="container">
  <div class="row">
    <div class="col-md-12">
      <a href="{{route('admin.categories.create')}}">Crea category</a>
    </div>

  </div>
    <div class="row justify-content-center">
       @foreach ($categories as $category)
       <div class="col-md-3">
         <a href="{{route('admin.categories.show', ['category' => $category->id])}}">
           <div class="card">
               <div class="card-header">{{$category->name}}</div>


              <a class="btn btn-primary" href="{{route('admin.categories.edit', ['category' => $category->id])}}">Edit</a>
              <div class="elimina">
                  <button class="btn btn-primary" type="button" name="button" @click= "delete_comic({{$category->id}})">Delete</button>
                  <div class="si-no" v-if="{{$category->id}} == id">
                    <form class="" action="{{route('admin.categories.destroy',['category'=>$category->id])}}" method="POST" v-if="id!=null">
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

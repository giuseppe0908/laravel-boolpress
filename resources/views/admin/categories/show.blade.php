@extends('layouts.app')

@section('content')

    <div id="root" class="row justify-content-center">

       <div class="col-md-3">
           <div class="card">
               <div class="card-header"></div>

               <div class="card-body">
                    <h4>Category:{{$category->name}}</h4>
                   {{$category->content}}
               </div>
              <a href="{{route('admin.categories.edit', ['category' => $category->id])}}">Edit</a>
              <div class="elimina">
                  <button type="button" name="button" @click= "delete_comic({{$category->id}})">Delete</button>
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
       </div>
    </div>
</div>
@endsection

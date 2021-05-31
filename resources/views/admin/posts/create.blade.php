



@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Inserisci un nuovo post</h1>
    </div>
  </div>
  <div class="row justify-content-center">
     <div class="col-md-8">

                 <form class="" action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
                   @csrf
                   @method('POST')
                   <div class="form-group">
                     <label for="category">Category</label>
                     <select class="form-control @error('category') is-invalid @enderror" id="category" name="category_id">
                       @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                       @endforeach
                    </select>
                       @error('category')
                        <small class="text-danger">{{ $message }}</small>
                       @enderror
                   </div>

                   <div class="form-group">
                     <label for="title">Title</label>
                     <input class="form-control @error('title') is-invalid @enderror" id="title" type="text" name="title" value="{{ old('title') }}" placeholder="title">
                     @error('title')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                   </div>

                   <div class="form-group">
                     <label for="content">Content</label>
                     <textarea class="form-control @error('content') is-invalid @enderror" id="content" type="text" name="content" placeholder="content">{{ old('content') }}</textarea>
                     @error('content')
                       <small class="text-danger">{{ $message }}</small>
                     @enderror
                   </div>

                   <div class="form-group">
                     <label for="cover">Cover</label>
                     <input class="form-control @error('content') is-invalid @enderror" id="cover" type="file" name="cover">
                     @error('cover')
                       <small class="text-danger">{{ $message }}</small>
                     @enderror
                   </div>


                  <div class="form-group">
                    <label for="tag">Tags</label>
                    <select class="form-control @error('tag_ids') is-invalid @enderror" id="tag" name="tag_ids[]" multiple>
                      @foreach($tags as $tag)
                        <option value="{{$tag->id}}">{{$tag->name}}</option>
                      @endforeach
                    </select>
                    @error('tag_ids')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                  </div>

                   <button class="btn btn-primary" type="submit" name="button">Salva</button>
                 </form>
     </div>

  </div>
</div>

@endsection

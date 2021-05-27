



@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h1>Inserisci un nuovo category</h1>
    </div>
  </div>
  <div class="row justify-content-center">
     <div class="col-md-8">

                 <form class="" action="{{route('admin.categories.store')}}" method="post">
                   @csrf
                   @method('POST')

                   <div class="form-group">
                     <label for="name">Name</label>
                     <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" value="{{ old('name') }}" placeholder="name">
                     @error('name')
                      <small class="text-danger">{{ $message }}</small>
                    @enderror
                   </div>


                   <button class="btn btn-primary" type="submit" name="button">Salva</button>
                 </form>
     </div>

  </div>
</div>

@endsection

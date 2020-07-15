@extends('layouts.admin')

@section('content')
      <div class="row">
        <div class="col-12">
          <div class="card card-info">

            <div class="card-header">
              <h2 class="card-title">Izmijeni recept</h2>
              <div class="card-tools">
              </div>
            </div>
      
            <div class="card-body p-0">
              <form role="form" method="post" action="/update-recipe" enctype="multipart/form-data">
                @csrf
                  <input type="hidden" name="id" value="{{$recipe->id}}">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Naziv*</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="{{$recipe->name}}">
                  </div>
      
                  <div class="form-group">
                    <label for="exampleInputFile">Slika*</label>
                    <img src="{{asset($recipe->image_url)}}" width="150" alt="">  
                    <hr>
                    <div class="input-group">
                      
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                    </div>
                  </div>
      
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="col-form-label" for="description">Opis recepta*</label>                    
                        <textarea class="form-control" name="description" rows="3">{{ $recipe->text }}</textarea>
                      </div>
                    </div>
                  </div>
      
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="col-form-label" for="description">Sastojci*</label>
                        <textarea id="ingredients" placeholder="max. 255 karaktera"
                                  name="ingredients" class="form-control textarea">
                                {{$recipe->ingredients}}
                        
                                </textarea>
                      </div>
                    </div>
                  </div>
      
                  <div class="row">
                    <div class="col-12">
                      <div class="form-group">
                        <label class="col-form-label" for="description">Koraci*</label>
                        <textarea id="steps" placeholder="max. 255 karaktera"
                                  name="steps" class="form-control textarea">
                                {{$recipe->steps}}
                                </textarea>
                      </div>
                    </div>
                  </div>
      
                  <div class="form-group">
                    <label for="exampleInputPassword1">Tezina*</label>
                  <input type="number" name="diff" class="form-control" id="exampleInputPassword1" placeholder="" value="{{$recipe->difficulty}}">
                  </div>
                </div>
                <!-- /.card-body -->
      
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Sacuvaj</button>
                  <a href="/my-recipes"><button type="button" class="btn btn-primary">Nazad</button></a>
                </div>
              </form>
      
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
@endsection

@section('scripts')
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>
$(document).ready(function() {
    $('.textarea').summernote();
})
</script>

@endsection
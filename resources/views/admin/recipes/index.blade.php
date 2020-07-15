@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">

      <div class="card">
        <!-- /.card-header -->

        <div class="card-header">

          <div class="float-right mr-1 mt-3">
            <button class="btn btn-primary" onclick="openModal()"><i class="fas fa-plus"></i> Dodaj recept</button>
            
          </div>
          <h2>Recepti</h2>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th >#</th>
              <th >Slika</th>
              <th >Naziv</th>
              <th >Težina</th>
              <th >Opcije</th>
            </tr>
            </thead>
            <tbody>
                @if($recipes && sizeof($recipes) > 0)
                    @foreach($recipes as $recipe)
                    <tr>
                        <td >#{{$recipe->id}}</td>
                        <td >{{$recipe->name}}</td>
                        <td ><img src="{{asset($recipe->image_url)}}" width="100" alt="Nema je za sad"></td>
                        <td >{{$recipe->difficulty}}</td>
                        <td>
                          <button class="btn btn-primary"><a href="/edit-recipe/{{$recipe->id}}" style="color: inherit;"> <i class="fas fa-edit"></i> Izmijeni </a></button>
                          <a class="btn btn-danger" href="/delete-recipe/{{$recipe->id}}"><i class="fas fa-trash"></i> Izbriši</a>
                        </td>
                      </tr>
                    @endforeach

                    @else 
                    <tr>
                        <td colspan="6">
                            <h2>Trenutno nema recepata.</h2>
                        </td>
                    </tr>
                @endif
        
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer float-right">
          {{$recipes->links()}}
      </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection
@section('scripts')

<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
     aria-hidden="true" width="40%">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Dodaj recept</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form id="articleForm" class="submitForm" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="container-fluid col-md-12">
            <div class="tab-content">
              <div class="tab-pane fade show active" id="card-recipe-1" role="tabpanel"
                   aria-labelledby="card-tab-1">

                   <div class="form-group">
                    <label for="exampleInputEmail1">Naziv*</label>
                    <input type="name" class="form-control" id="nameRecipe" placeholder="Naziv">
                  </div>
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label for="exampleInputFile">Slika*</label>
                      <div class="input-group">
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" id="imageRecipe">
                          <label class="custom-file-label" for="imageRecipe">Choose file</label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="col-form-label" for="text">Opis recepta*</label>
                      <textarea class="form-control" name="text" rows="3" id="text"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="col-form-label" for="description">Sastojci*</label>
                      <textarea id="ingredients" placeholder="max. 255 karaktera"
                                name="ingredients" class="form-control textarea"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="col-form-label" for="description">Koraci*</label>
                      <textarea id="steps" placeholder="max. 255 karaktera"
                                name="steps" class="form-control textarea"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-12">
                    <div class="form-group">
                      <label class="col-form-label" for="diff">Težina*</label>
                      <input type="number" id="diff"
                             name="diff" class="form-control">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="button" class="btn btn-danger" id="coloseVolcanoCoverBtn" data-dismiss="modal">
            Zatvori
          </button>
          <button type="button" onclick="saveRecipe()" class="btn btn-primary" name="save" id="saveVolcanoCoverBtn"
                  onclick="">Sačuvaj
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script>

    $(document).ready(function() {
      $('.textarea').summernote();
    })
</script>
<script>
    function openModal() {
      $('#nameRecipe').val('')
      $('#imageRecipe').val('')  
      $('#card-recipe-1 > div:nth-child(3) > div > div > div > div.note-editing-area > div.note-editable.card-block').html('')
      $('#card-recipe-1 > div:nth-child(4) > div > div > div > div.note-editing-area > div.note-editable.card-block').html('')
      $('#card-recipe-1 > div:nth-child(5) > div > div > div > div.note-editing-area > div.note-editable.card-block').html('')
      $('#diff').val('')
      $('#addModal').modal()
    }

function setupAjax() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

function saveRecipe() {

    var name = $('#nameRecipe').val();
    var image = $('#imageRecipe')[0].files[0];
    var text = $('#text').val();
    var ingredients = $('#ingredients').summernote('code');
    var steps = $('#steps').summernote('code');
    var diff = $('#diff').val();

    var data = new FormData
    data.append('name', name);
    if(typeof image != 'undefined') {
      data.append('image', image);
    }
    data.append('text', text);
    data.append('ingredients', ingredients);
    data.append('steps', steps);
    data.append('diff', diff);

    console.log(data);    


    setupAjax();
    $.ajax({
        url: '/add-recipe',
        method: 'post',
        data: data,
        contentType: false,
        processData: false
    })
    .done( function() {
        console.log('Uspjesno sacuvano');
        setTimeout(location.reload.bind(location), 500)
    })
    .fail(function() {
        console.log('Failovao si.');
        alert('Nije prosao zahtjev');
    })
}
  </script>
@endsection
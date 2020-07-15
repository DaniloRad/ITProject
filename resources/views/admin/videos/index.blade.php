@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">

      <div class="card">
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th>#</th>
              <th>Naziv</th>
              <th>Slika</th>
              <th>Epizoda</th>
              <th>Sezona</th>
              <th>Datum prikazivanja</th>
              <th>Kategorija</th>
              <th>Opcije</th>
            </tr>
            </thead>
            <tbody>

              @if($videos && sizeof($videos) > 0)

                    @foreach ($videos as $video)
                    <tr>
                        <td>#{{$video->id}}</td>
                        <td>{{$video->name}}</td>
                        <td><img src="{{asset($video->image)}}" width="100" alt=""></td>
                        <td>{{$video->episode}}</td>
                        <td>{{$video->season}}</td>
                        <td>
                            <input type="date" value="{{$video->broadcast_date}}" readonly>
                        </td>
                        <td>{{$video->category->name}}</td>
                        <td>
                            <button class="btn btn-primary"><a href="/edit-video/{{$video->id}}" style="color: inherit;"> <i class="fas fa-edit"></i> Izmijeni </a></button>
                            <a class="btn btn-danger" href="/delete-video/{{$video->id}}"><i class="fas fa-trash"></i> Izbriši</button>
                        </td>
                    </tr>
                    @endforeach
                @endif

            </tbody>
            
          </table>


        </div>
        <!-- /.card-body -->
        <div class="card-footer float-right">
            {{$videos->links()}}
        </div>

      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
 
  <div class="card card-info">
    <div class="card-header">
      <h2 class="card-title">Dodaj emisiju</h2>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>

    <div class="card-body p-0">
        <form role="form" action="/add-video" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Ime*</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Ime">
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Video*</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="video"class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Slika*</label>
                    <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Epizoda*</label>
                    <input type="number" name="episode" class="form-control" id="exampleInputEmail1" placeholder="Epizoda">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Sezona*</label>
                    <input type="number" name="season" class="form-control" id="exampleInputPassword1" placeholder="Sezona">
                </div>

                <div class="form-group">
                    <label>Opis*</label>
                    <textarea class="form-control" name="description" rows="3" placeholder="Unesite opis.."></textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Kategorija*</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="" selected disabled>Izaberi kategoriju</option>
                        @if($categories && sizeof($categories) > 0)
                        @foreach($categories as $c)
                            <option value="{{$c->id}}">{{$c->name}}</option>
                        @endforeach
                    @endif  
                    </select>             
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Datum prikazivanja</label>
                    <input type="date" value="" name="broadcast_date" class="form-control">
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sačuvaj</button>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
  </div>
  </div>
@endsection

@extends('layouts.admin')

@section('content')

<div class="card card-info">
    <div class="card-header">
      <h2 class="card-title">Izmijeni emisiju</h2>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>

    <div class="card-body p-0">
        <form role="form" action="/update-video" method="post" enctype="multipart/form-data">
            @csrf

            <div class="card-body">

                <input type="hidden" name="id" value="{{$video->id}}">

                <div class="form-group">
                    <label for="exampleInputEmail1">Ime*</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Ime" value="{{$video->name}}">
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
                    <input type="number" name="episode" class="form-control" id="exampleInputEmail1" placeholder="Epizoda" value="{{$video->episode}}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Sezona*</label>
                    <input type="number" name="season" class="form-control" id="exampleInputPassword1" placeholder="Sezona" value="{{$video->season}}">
                </div>

                <div class="form-group">
                    <label>Opis*</label>
                    <textarea class="form-control" name="description" rows="3">{{$video->description}}</textarea>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Kategorija*</label>
                    <select name="category_id" id="" class="form-control">
                        <option value="" disabled>Izaberi kategoriju</option>
                        @if($categories && sizeof($categories) > 0)
                        @foreach($categories as $c)
                            <option value="{{$c->id}}" @if($c->id == $video->category_id) selected @endif>{{$c->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Datum prikazivanja</label>
                    <input type="date" value="{{$video->broadcast_date}}" name="broadcast_date" class="form-control">
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Sačuvaj</button>
                <a href="javascript:history.back()"><button type="button" class="btn btn-primary">Nazad</button></a>
            </div>
        </form>

    </div>
    <!-- /.card-body -->
  </div>
@endsection
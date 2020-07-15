@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
      <div class="card card-info">
        <div class="card-header">
          <h2 class="card-title">Izmijeni korisnika</h2>
        </div>
        <div class="card-body p-0">


        <form role="form" action="/update-user" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <input type="hidden" name="id" value="{{$user->id}}">
              <div class="form-group">
                <label for="exampleInputEmail1">Ime*</label>
                <input type="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Ime" value="{{$user->name}}">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Email adresa*</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email adresa" value="{{$user->email}}">
              </div>

              <div class="form-group">
                <label for="exampleInputPassword1">Lozinka*</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
              </div>

              <div class="form-group">
                <label for="exampleInputEmail1">Uloga*</label>
                <select name="role" id="" class="form-control">
                    <option value="" disabled> Izaberi ulogu</option>
                    @if($roles && sizeof($roles) > 0)
                        @foreach($roles as $role)
                            <option value="{{$role->id}}" @if($user->role->id == $role->id) selected @endif>{{$role->name}}</option>
                        @endforeach
                    @endif
                </select>
                </div>

              <div class="form-group">
                <label for="exampleInputFile">Slika</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="image" class="custom-file-input" id="exampleInputFile">
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                </div>
              </div>
            <!-- /.card-body -->
            </div>
            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Sačuvaj</button>
            <a href="javascript:history.back()"><button type="button" class="btn btn-primary">Nazad</button></a>
            </div>  
        </form>


        </div>
        <!-- /.card-body -->
      </div>
    <!-- /.col -->
    </div>
  </div>
@endsection
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
              <th>Ime</th>
              <th>Email</th>
              <th>Slika</th>
              <th>Uloga</th>
              <th>Opcije</th>
            </tr>
            </thead>
            <tbody>
                @if($users && sizeof($users) > 0)

                    @foreach ($users as $user)
                    <tr>
                        <td>#{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td><img src="{{asset($user->image)}}" width="100" alt=""></td>
                        <td>{{$user->role->name}}</td>
                        <td>
                        <button class="btn btn-primary"><a href="/edit-user/{{$user->id}}" style="color: inherit;"> <i class="fas fa-edit"></i> Izmijeni </a></button>
                          <a class="btn btn-danger" href="/delete-user/{{$user->id}}"><i class="fas fa-trash"></i> Izbriši</button>
                        </td>
                    </tr>
                    @endforeach

                @endif
    
            </tbody>
          </table>

        </div>
        <!-- /.card-body -->
        <div class="card-footer float-right">
                {{$users->links()}}
        </div>

      </div>

      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
  <!-- /.row -->
  
  
  <div class="card card-info">
    <div class="card-header">
      <h2 class="card-title">Dodaj korisnika</h2>
      <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
          <i class="fas fa-minus"></i></button>
      </div>
    </div>

    <div class="card-body p-0">
      <form role="form" action="/add-user" method="post" enctype="multipart/form-data">
          @csrf

          <div class="card-body">
            <div class="form-group">
              <label for="exampleInputEmail1">Ime*</label>
              <input type="name" name="name" class="form-control" id="exampleInputEmail1" placeholder="Ime">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email adresa*</label>
              <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email adresa">
            </div>

            <div class="form-group">
              <label for="exampleInputPassword1">Lozinka*</label>
              <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Lozinka">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Uloga*</label>
              <select name="role" id="" class="form-control">
                  <option value="" selected disabled>Izaberite ulogu</option>
                  @if($roles && sizeof($roles) > 0)
                      @foreach($roles as $r)
                  <option value="{{$r->id}}">{{$r->name}}</option>
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

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Sačuvaj</button>
        </div>

      </form>

    </div>
    <!-- /.card-body -->
  </div>
@endsection
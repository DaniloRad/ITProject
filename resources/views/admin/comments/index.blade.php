@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">

      <div class="card">
        <!-- /.card-header -->

        <div class="card-header">
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped text-center">
            <thead>
            <tr>
              <th >#</th>
              <th >Korisnik_ime</th>
              <th >Tekst</th>
              <th >Video/Recept naziv</th>
              <th >Opcije</th>
            </tr>
            </thead>
            <tbody>
                @if($comments && sizeof($comments) > 0)

                    @foreach ($comments as $comment)
                    <tr>
                        <td>#{{$comment->id}}</td>
                        <td>{{$comment->user->name}}</td>
                        <td>{{$comment->text}}</td>
                        <td>
                          @if($comment->video_id != null || $comment->video_id != '') 

                            {{$comment->video->name}}
                  
                          @elseif($comment->recipe_id != null || $comment->recipe_id != '')

                            {{$comment->recipe->name}}
                          @endif

                        </td>
                        <td>
                            <a class="btn btn-danger" href="/delete-comment/{{$comment->id}}"><i class="fas fa-trash"></i> Izbriši</button>
                        </td>
                    </tr>
                    @endforeach

                @endif
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer float-right">
            {{$comments->links()}}
    </div>
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
  </div>
@endsection
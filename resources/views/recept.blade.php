<!DOCTYPE html>
<html>

<head>
    <meta name="csrf-token" content="{{@csrf_token()}}">
    <title>Emisija o kuvanju</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Abel" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lancelot" />
    <link rel="stylesheet" href="{{asset('bootstrap-4.min.css')}}">
</head>

<body class="bg-def ">
    <div id="modal-user-settings" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Podesavanja korisnika</h2>
            </div>
            <div class="uk-modal-body">
                <ul class="uk-nav">
                    <input type="hidden" value="{{Auth::id()}}" id="userId">
                    <li>
                        <label for="">Ime:</label>
                        <input class="uk-input" type="text" id="name">
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li>
                        <label for="">Email:</label>
                        <input class="uk-input" type="text" id="email">
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li>
                        <label for="">Password:</label>
                        <input class="uk-input" type="text" id="password">
                    </li>
                    <li>
                        <label for="">Slika:</label>
                        <input type="file" id="image" class="uk-input">
                    </li>
                </ul>
            </div>
            <div class="uk-modal-footer uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">Otkazi</button>
                <button class="uk-button uk-button-primary" onclick="updateUser()" type="button">Sacuvaj</button>
            </div>
        </div>
    </div>
    <div class="header">

        <nav class="uk-navbar-container uk-margin uk-margin-remove-vertical" uk-navbar>
            <div class="uk-navbar-left">

                <a href="/" class="brand-link">
                    <img src="{{asset('dist/img/Logo.png')}}"
                         alt="Logo"
                         style="opacity: .8; border-radius: 50%;"
                         width="50" height="50">
                </a>

                <ul class="uk-navbar-nav">
                    <li>
                        <a href="/">
                           Pocetna
                        </a>
                    </li>
                    <li>
                        <a href="/recepti">
                           Recepti
                        </a>
                    </li>
                    <li>
                        <a href="/emisije">
                           Emisije
                        </a>
                    </li>
                    <li>
                        <a href="/pretraga">Pretraga</a>
                    </li>
                </ul>
            </div>
            
            <div class="uk-navbar-right">

                <div class="uk-navbar-nav">

                    @if(Auth::check()) 
                        <li>
                            <a href="#">{{Auth::user()->name}}</a>
                        </li>

                        <li class="acc">
                            <div class="uk-inline ">
                             <span uk-icon="user"></span>
                             <div uk-dropdown="mode: click">
                                 <ul class="uk-nav uk-dropdown-nav">
                                 
                                     <li href="#modal-user-settings" uk-toggle><a href="#" onclick="openModal({{Auth::id()}})" class="light-black"><span class="light-black" uk-icon="settings"></span>Podesavanjna korisnika</a></li>
                                     <li class="uk-nav-divider"></li>
                                     <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();" class="light-black"> <span class="light-black" uk-icon="sign-out"></span> Odjavi se</a></li>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                         @csrf
                                     </form> 
                                 </ul>
                             </div>
                         </div>
                         </li>
     
                    @else
                    <li>
                        <a href="/login">
                            Prijava
                        </a>
                    </li>
                    <li>
                        
                    </li>  <li>
                        <a href="/register">
                           Registracija
                        </a>
                    </li>
                    @endif

                    
                    
                </div>
            </div>


        </nav>
    </div>


    <div class="uk-container uk-container-center">
        <div uk-grid class="uk-flex-center width-1-1 uk-padding uk-margin-auto">
            <div class="uk-panel uk-width-1-1@xs uk-width-1-1@m uk-child-width-1-1 blog-box " uk-grid>

                <div class="uk-align-left uk-margin-remove-adjacent uk-height-medium uk-width-medium uk-background-cover uk-border-rounded" data-src="{{$recipe->image_url}}" uk-img>
                </div>
                <div class="">
                    <h2>{{$recipe->name}}</h2>
                    <div class="text-small">
                        <span class="uk-badge">Težina: {{$recipe->difficulty}}</span>
                        <span uk-icon="icon: calendar"></span>
                    <span>{{\Carbon\Carbon::parse($recipe->created_at)->format('d.m.Y')}}</span>
                        <span uk-icon="icon: comment"></span>
                    <span>{{count($recipe->comments)}}</span>
                   </div>
                <p>{!! $recipe->text !!}</p>
            </div>
            
            <div>
                    <h4>Potrebno je:</h4>
                    {!! $recipe->ingredients !!}
                    <h3>Priprema</h3>
                    {!! $recipe->steps !!}
            </div>

            </div>
            
            
            @if($recipe->comments && sizeof($recipe->comments) > 0)
            @foreach($recipe->comments as $comment)
        <article class="uk-comment uk-comment-primary" style="background-color: mintcream; opacity: 0.8; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); width: 100%;">
            <header class="uk-grid-medium uk-flex-middle" uk-grid>
                <div class="uk-width-auto">
                    <img class="uk-comment-avatar uk-border-circle" src="{{asset($comment->user->image)}}" width="80" height="80" alt="">
                </div>
                <div class="uk-width-expand">
                    <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">{{$comment->user->name}}</a></h4>
                    <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                        <li><a href="#">{{\Carbon\Carbon::parse($comment->created_at)->format('d.m.Y')}}</a></li>
                    </ul>
                </div>
            </header>
            <div class="uk-comment-body" style="width: 100%;">
                <p>{{$comment->text}}   </p>
            </div>
        </article>
        @endforeach
        @endif
        @if(Auth::check())
            <div class="uk-width-1-1 uk-width-2-3@m uk-width-2-3@xl uk-">
                <article class="uk-comment uk-comment-primary uk-width-1-1">
                    <header class="uk-grid-medium uk-flex-middle " uk-grid>
                        <div class="uk-width-auto uk-margin-bottom">
                            <img class="uk-comment-avatar uk-border-circle" src="{{asset(Auth::user()->image)}}" width="80" height="80" alt="">
                        </div>
                        <div class="uk-width-expand uk-flex uk-flex-column">
                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#">{{Auth::user()->name}}</a></h4>
                        </div>
                    </header>
                    <form >
                        @csrf
                        <input type="hidden" id="idComment"name="idComment" value="{{$recipe->id}}">
                        <input type="hidden" name="type" id="typeComment" value="recipe">
                        <div class="uk-comment-body">
                            <textarea name="text" id="textComment" cols="30" rows="3" class="uk-textarea"></textarea> 
                        </div>
                        <button class="uk-button uk-button-primary uk-margin-top" onclick="commentCreate()" type="button"><span uk-icon="icon: plus-circle"></span> Add new comment</button>
                    </form>
                
                </article>
            </div>
        @endif

        </div>
    </div>


</body>
<script src="{{asset('js/uikit.min.js')}}"></script>
    <script src="{{asset('js/uikit-icons.min.js')}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script defer>
        $(window).on("resize load", function () {
        var cw = $('.dynamical-small-img').width();
        $('.dynamical-small-img').css({'height':cw+'px'});
        })
        window.onload=main
        function main () {
            $(".uk-dropdown").click(function(){
                UIkit.dropdown($(".uk-dropdown")).hide(0);
            }) 
        }
    </script>
    <script src="{{asset('sweetalert2.min.js')}}"></script>

    <script>
        function toast(type, message) {
            Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 3000
            })
            .fire({
            type: type,
            title: message
            });
}
        function openModal(id) {

            $('#name').val();
            $('#email').val();

            $.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/user-info/' + id,
                method: 'get',
                processData: false,
                contentType: false
            })
            .done(function(response) {
                $('#id').val(response.id);
                $('#name').val(response.name);
                $('#email').val(response.email);
            })
            .fail(function() {
                alert('Korisnik nije pronadjen');
            })
        }

        function updateUser() {
            console.log('aaaaa');
            var data = new FormData;
            data.append('id', $('#userId').val());
            data.append('name', $('#name').val());
            data.append('email', $('#email').val());
            if($('#password').val() != '') {
                data.append('password', $('#password').val())
            }
            if(typeof $('#image')[0].files[0] != 'undefined') {
                data.append('image', $('#image')[0].files[0]);
            }

            $.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/update-user-info',
                method: 'post',
                data: data,
                processData: false,
                contentType: false
            })
            .done(function(response) {
                toast('success', 'Uspjesno ste izmijenili podatke!');
                setTimeout(location.reload.bind(location), 2000);
            })
            .fail(function(returnData) {
                var message = JSON.parse(returnData.responseText).errors;
                toast('error', String(message[Object.keys(message)[0]]));
            }) 
        }

        function commentCreate() {

            var data = new FormData;
            data.append('id', $('#idComment').val());
            data.append('type', $('#typeComment').val());
            data.append('text', $('#textComment').val());

            $.ajaxSetup({
                 headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/add-comment',
                method: 'post',
                data: data,
                processData: false,
                contentType: false
            })
            .done(function(response) {
                toast('success', 'Uspjesno ste dodali komentar!');
                setTimeout(location.reload.bind(location), 2000);
            })
            .fail(function(returnData) {
                var message = JSON.parse(returnData.responseText).errors;
                toast('error', String(message[Object.keys(message)[0]]));
            }) 
        }
    </script>
</html>
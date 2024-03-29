<!DOCTYPE html>
<html>

<head>
    <title>Emisija o kuvanju</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{asset('css/uikit.min.css')}}" />
    <link rel="stylesheet" href="{{asset('css/main.css')}}" />

    
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Abel" />
<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lancelot" />
<link rel="stylesheet" href="{{asset('bootstrap-4.min.css')}}">

</head>
<body class="bg-def uk-height-viewport "><div id="offcanvas-nav" uk-offcanvas="overlay: true">
        <div class="uk-offcanvas-bar">

            <ul class="uk-nav uk-nav-default">
                    <li><a href="/" class="brand-link">
                        <img src="{{asset('dist/img/Logo.png')}}" alt="Logo" style="opacity: .8; border-radius: 50%;" width="50" height="50">
                    </a></li>
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
                        <li>
                            <a href="/opis">Opis</a>
                        </li>
                   

         
                        @if(Auth::check())

                        <li>
                            <div class="uk-inline">
                            <span uk-icon="user"></span>

                            <a href="#">{{Auth::user()->name}}</a>
                            </div>
                        </li>

                     

                                        <li href="#modal-user-settings" uk-toggle><a href="#" onclick="openModal({{Auth::id()}})" ><span  uk-icon="settings"></span>Podesavanjna korisnika</a></li>
                                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();"> <span  uk-icon="sign-out"></span> Odjavi se</a></li>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                   

                        @else
                        <li>
                            <a href="/login">
                                Prijava
                            </a>
                        </li>
                        <li>

                        </li>
                        <li>
                            <a href="/register">
                                Registracija
                            </a>
                        </li>
                        @endif



            </ul>

        </div>
    </div>
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

        <nav class="uk-navbar-container uk-margin  uk-margin-remove-vertical" uk-navbar>
        <button class="uk-button uk-button-default uk-hidden@m uk-margin uk-margin-top uk-margin-left uk-padding-remove" type="button" uk-toggle="target: #offcanvas-nav">
                <a class="uk-navbar-toggle" uk-navbar-toggle-icon href="#"></a>
                </button>
                <div class="uk-navbar-left uk-hidden@xs uk-visible@m">
                
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
                    <li>
                        <a href="/opis">Opis</a>
                    </li>
                </ul>
            </div>
            
            <div class="uk-navbar-right uk-hidden@xs uk-visible@m">

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
    <div class="uk-container uk-container-center uk-height-viewport">
        <div class="search-widgetc uk-padding">
           <form action="/search-by-term" method="get">
            @csrf
           <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
            <label><input class="uk-radio db-search db-filter" type="radio" name="type" value="db"checked> Pretraga u bazi</label>
            <label><input class="uk-radio web-search" type="radio" name="type" value="web"> Pretraga primjenom pretrazivaca</label>
            </div>
        
        <div class="browser-filters uk-hidden">
            <label><input class="uk-radio google-search" type="radio" name="web_type" value="google" checked> Google</label>
            <label><input class="uk-radio yahpp-search" type="radio" name="web_type" value="yahoo">Yahoo</label>
            <label><input class="uk-radio bing-search" type="radio" name="web_type" value="bing"> Bing</label>
        </div>

    <div class="db-filters">
        <label><input class="uk-radio " type="radio" name="db_type" value="video" checked> Emisija</label>
            <label><input class="uk-radio " type="radio" name="db_type" value="recipe">Recept</label>
    </div>

        <div class="uk-margin uk-inline">
            <span class="uk-form-icon" uk-icon="icon: search"></span>
            <input class="uk-input uk-form-large search-type-input" name="term" type="text" placeholder="Pretrazi...">
        </div>
        </div>
    </form>

        <div uk-grid class="uk-flex-center width-1-1 uk-padding uk-margin-auto search-widget-results">

            @if( $result ?? '' && sizeof($result) > 0)
                @foreach($result as $r)
            <div class="uk-width-1-1@xs uk-width-1-1@m uk-child-width-1-1 blog-box " uk-grid>

                <div class="uk-width-1-1@xs uk-width-2-5@s uk-height-medium uk-background-cover uk-border-rounded" data-src="{{asset($r->image)}}""  uk-img>

                </div>
                <div class="uk-width-expand">
                    <h2>{{$r->title}}</h2>
                    <div class="text-small">
                        <span class="uk-badge">{{$r->diff}}</span>
                        <span uk-icon="icon: calendar"></span>
                        <span>{{\Carbon\Carbon::parse($r->created_at)->format('d.m.Y')}}</span>
                        <span uk-icon="icon: comment"></span>
                        <span>{{$r->comments}}</span>

                    </div>
                    <p class="text-normal">{!!Str::limit($r->description, 250)!!}</p>
                    <a class="uk-button uk-button-text" href="#">Read more</a>

                </div>


            </div>
                @endforeach
            @endif
            {{-- {{$result->links()}} --}}
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
        console.log("test")
        window.onload=main
        function main () {
            $(".uk-dropdown").click(function(){
                UIkit.dropdown($(".uk-dropdown")).hide(0);
            }) 
        }
    </script>
<script>
    window.onload=main
    function main(){
    $(".db-search").click(function(){
        $(".browser-filters").addClass("uk-hidden");

    })
    $(".web-search").click(function(){
        $(".browser-filters").toggleClass("uk-hidden");
        $('.db-filters').addClass('uk-hidden');
    })
    $('.db-filter').click(function() {
        $('.db-filters').toggleClass('uk-hidden');
    })
    $(".search-type-input").keyup(function(e){
        if(this.value.length>3){

        }
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

    </script>
</html>
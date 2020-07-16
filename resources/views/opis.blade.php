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
    <div class="uk-container uk-container-center">
        <h1>OPIS</h1>
        <h3>PDF Verzija: 
            <a href='/download' class="uk-button uk-button-default"> 
                <span uk-icon="download" ></span> Preuzmi PDF verziju opisa
            </a> 
        </h3>
        <h4>Naš zadatak je bio kreiranje stranice za emisiju o kuvanju.
            Sajt se sastoji iz dijela za običnog korisnika i za admin korisnika.
            Prilikom pokretanja dat je prikaz početne strane gdje neprijavljeni korisnici mogu da vide ukratko sadržaj sajta.
            To je lista 5 najznačajnijih emisija i 3 najznačajnija recepta po kriterijumu komentarisanosti.
            Korisnik je u mogućnosti da klikom na dugme ode na strane koje izlistavaju emisije po tačno odredjenim kategorijama, sve emisije i strana na kojoj su svi recepti.
            Korisnik ima mogućnost odlaska na stranicu pretrage, gdje mu je omogučena pretraga po bazi tj samom sajtu i koristeći neke od ponudjenih pretraživača.
            Pretraga u bazi se vrši po imenima i opisima emisija i recepata.
            Prijavljani obićni korisnik može ostavljati komentare na pojedinaćnim emisijama i receptima.
            Admin korisnik ima širok dijapazon mogućnosti. Takav korisnik ima direktan uvid u emisije, recepte, komentare i korisnike.
            Admin može brisati, dodavati i izmijeniti korisnika, emisiju ili recept. Dok takodje može izbrisati komentar koji krši politiku pravilnog ponašanja.
            Neprijavljeni korisnik ima mogućnost registracije i mogućnost prijavljivanja, dok prijavljeni korisnik ima mogućnost odjavljivanja.
        </h4>
        <h2>ER Diagram</h2>
        <img src="ERdiagram.png" alt="ER Diagram" width="500" height="600">
        <h2>Spisak tabela i tipovi polja</h2>
        <ul style="font-size:30px;">
            <li>Users
                <ul style="font-size:20px;">
                    <li>id -> bigint(20) -> Auto_Increment</li>
                    <li>name -> varchar(255)</li>
                    <li>email -> varchar(255)</li>
                    <li>password -> varchar(255)</li>
                    <li>image -> varchar(255)</li>
                    <li>role_id -> bigint(20) -> FOREIGNKEY_referencira_roles(id)</li>
                    <li>active -> tinyint(1)</li>
                  </ul>
            </li>
            <li>Videos
                <ul style="font-size:20px;">
                    <li>id -> bigint(20) -> Auto_Increment</li>
                    <li>name -> varchar(255)</li>
                    <li>videoURL -> varchar(255)</li>
                    <li>active -> tinyint(1)</li>
                    <li>episode -> int(11)</li>
                    <li>seasone -> int(11)</li>
                    <li>broadcast_date -> date</li>
                    <li>description -> text</li>
                    <li>category_id -> bigint(20) -> FOREIGNKEY_referencira_categories(id)</li>
                    <li>image -> varchar(255)</li>
                  </ul>
            </li>
            <li>Recipes
                <ul style="font-size:20px;">
                    <li>id -> bigint(20) -> Auto_Increment</li>
                    <li>name -> varchar(255)</li>
                    <li>image_url -> varchar(250)</li>
                    <li>text -> text</li>
                    <li>active -> tinyint(1)</li>
                    <li>difficulty -> int(11)</li>
                    <li>ingredients -> text</li>
                    <li>steps -> text</li>
                  </ul>
            </li>
            <li>Comments
                <ul style="font-size:20px;">
                    <li>Id -> bigint(20) -> Auto_Increment</li>
                    <li>Text -> text</li>
                    <li>active -> tinyint(1)</li>
                    <li>created_at -> timestamp</li>
                    <li>user_id -> bigint(20)  -> FOREIGNKEY_referencira_users(id)</li>
                    <li>video_id -> bigint(20)  -> FOREIGNKEY_referencira_videos(id)</li>
                    <li>recipe_id -> bigint(20)  -> FOREIGNKEY_referencira_recipes(id)</li>
                  </ul>
            </li>
            <li>Categories
                <ul style="font-size:20px;">
                    <li>Id -> bigint(20) -> Auto_Increment</li>
                    <li>Name -> varchar(255)</li>
                    <li>Active -> tinyint(1)</li>
                  </ul>
            </li>
            <li>Roles
                <ul style="font-size:20px;">
                    <li>id -> bigint(20) -> Auto_Increment</li>
                    <li>name -> varchar(255)</li>
                  </ul>
            </li>
        </ul>
        <h2>Alati</h2>
        <p style="font-size:20px;">Za prvi dio projekta korišteni su HTML CSS JavaScript za kreiranje izgleda dok je za uvezivanje MySQL baze sa frontom korišten Laravel PHP framework. </p>
        <p style="font-size:20px;">Ovo je milenin dio</p>
        
        
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
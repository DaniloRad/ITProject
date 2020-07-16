<!DOCTYPE html>
<html>

<head>
    <title>Emisija o kuvanju</title>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{@csrf_token()}}">
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
                    <img src="{{asset('dist/img/Logo.png')}}" alt="Logo" style="opacity: .8; border-radius: 50%;" width="50" height="50">
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

                                    <li href="#modal-user-settings" uk-classList.remove><a href="#" onclick="openModal({{Auth::id()}})" class="light-black"><span class="light-black" uk-icon="settings"></span>Podesavanjna korisnika</a></li>
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

                    </li>
                    <li>
                        <a href="/register">
                            Registracija
                        </a>
                    </li>
                    @endif



                </div>
            </div>


        </nav>
    </div>

    <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Welcome back!</h3>
                            <form action="{{route('login')}}" method="post">
                                @csrf
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                        <input placeholder="Email" class="uk-input uk-form-large" type="text" name="email">
                                    </div> <span></span>

                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                        <input placeholder="Password" class="uk-input uk-form-large" type="password" name="password">

                                    </div> <span></span>

                                </div>
                                <div class="uk-margin" tabindex="0">
                                    <button class="uk-button uk-button-default-rose uk-button-large uk-width-1-1" type="submit">Login</button>
                                </div>
                                <div class="uk-text-small uk-text-center">
                                    Not registered? <a href="/register">Create an account</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
<script src="{{asset('js/uikit.min.js')}}"></script>
<script src="{{asset('js/uikit-icons.min.js')}}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script defer>
    $(window).on("resize load", function() {
        var cw = $('.dynamical-small-img').width();
        $('.dynamical-small-img').css({
            'height': cw + 'px'
        });
    })
    window.onload = main

    function main() {
        $(".uk-dropdown").click(function() {
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
        if ($('#password').val() != '') {
            data.append('password', $('#password').val())
        }
        if (typeof $('#image')[0].files[0] != 'undefined') {
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
                console.log('promijenjeno')
                setTimeout(location.reload.bind(location), 2000);
            })
            .fail(function(returnData) {
                var message = JSON.parse(returnData.responseText).errors;
                toast('error', String(message[Object.keys(message)[0]]));
            })
    }
</script>
<script>
    function validateEmail(infoMessage) {
        var temp = document.querySelectorAll('input[name="email"]')[0]
        console.log(temp.parentElement.nextElementSibling)
        if (temp.value.match("^(?!((.*\\.(@|\\.)+.*)|(.*-(-)+.*))$)[a-zA-Z0-9]([a-zA-Z0-9_\\-\\.]*)@(([a-zA-Z0-9_\\-]+)\\.([a-zA-Z])+)+$")) {
            temp.classList.remove("error");
            temp.classList.add("ok");
            temp.parentElement.nextElementSibling.innerHTML = "It's good :)"
            temp.parentElement.nextElementSibling.style.display = "block"

        } else if (temp.value.length === 0) {
            temp.parentElement.nextElementSibling.style.display = "none"
            temp.parentElement.nextElementSibling.innerHTML = infoMessage
            temp.classList.remove("ok");
            temp.classList.remove("error");

        } else {
            temp.classList.remove("ok");

            temp.classList.add("error");
            temp.parentElement.nextElementSibling.innerHTML = "Your isn't good :("
            temp.parentElement.nextElementSibling.style.display = "block"

        }
    }

    function validatePassword(infoMessage) {
        var temp = document.querySelectorAll('input[name="password"]')[0]
        console.log(temp.value)
        if (temp.value.match("^(?=.{8,})")) {
            temp.classList.remove("error");
            temp.classList.add("ok");
            temp.parentElement.nextElementSibling.innerHTML = "It's good :)"
            temp.parentElement.nextElementSibling.style.display = "block"

        } else if (temp.value.length === 0) {
            temp.parentElement.nextElementSibling.style.display = "none"
            temp.parentElement.nextElementSibling.innerHTML = infoMessage
            temp.classList.remove("ok");
            temp.classList.remove("error");

        } else {
            temp.classList.remove("ok");

            temp.classList.add("error");
            temp.parentElement.nextElementSibling.innerHTML = "Your password isn't good enough :("
            temp.parentElement.nextElementSibling.style.display = "block"

        }
    }
    window.onload = main

    function main() {
        document.querySelectorAll('input[name="password"]')[0].addEventListener("blur", () => validatePassword(""))

        document.querySelectorAll('input[name="email"]')[0].addEventListener("blur", () => validateEmail("infoMessage"))

    }
</script>

</html>
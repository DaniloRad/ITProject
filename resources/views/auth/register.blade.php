
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Document</title>
    <link rel="stylesheet" href="../css/uikit.min.css" />
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/login.css" />

    <script src="../js/uikit.min.js"></script>
    <script src="../js/uikit-icons.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body class="bg-def "><div id="offcanvas-nav" uk-offcanvas="overlay: true">
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
                        <input class="uk-input" type="text" id="name" required>
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li>
                        <label for="">Email:</label>
                        <input class="uk-input" type="text" id="email" required> 
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li>
                        <label for="">Password:</label>
                        <input class="uk-input" type="text" id="password" required>
                    </li>
                    <li>
                        <label for="">Slika:</label>
                        <input type="file" id="image" class="uk-input" required>
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

    <div class="uk-section uk-section-muted uk-flex uk-flex-middle uk-animation-fade" uk-height-viewport>
        <div class="uk-width-1-1">
            <div class="uk-container">
                <div class="uk-grid-margin uk-grid uk-grid-stack" uk-grid>
                    <div class="uk-width-1-1@m">
                        <div class="uk-margin uk-width-large uk-margin-auto uk-card uk-card-default uk-card-body uk-box-shadow-large">
                            <h3 class="uk-card-title uk-text-center">Dobro došli</h3>
                            <form method="post" action="{{route('register')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: user"></span>
                                        <input  placeholder="Ime" class="uk-input uk-form-large" type="text" name="name" required>	
                                    </div>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                        <input placeholder="Email" class="uk-input uk-form-large" type="text" name="email" required>
                                    </div>
                                    <span></span>
                                </div>
                                <div class="uk-margin">
                                    <div class="uk-inline uk-width-1-1">
                                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                        <input placeholder="Password" class="uk-input uk-form-large" name="password" type="password" required>	
                                    </div>                                    <span></span>

                                </div>
                                <div class="js-upload" uk-form-custom>
                                    <img class="uk-comment-avatar uk-border-circle" src="../imgs/noImage.jpg" id="imagePlaceholder" width="80" height="80" alt="">
                                    <input placeholder="Slika" type="file" name="image" id="image" onchange="changeImage(event)" accept=".jpg,.png,.svg,.jpeg" required>
                                    <button class="uk-button uk-button-default" type="button" tabindex="-1">Izaberi profilnu sliku</button>
                                </div>
                                <div class="uk-margin" tabindex="0">
                                    <button  class="uk-button uk-button-default-rose uk-button-large uk-width-1-1" type="submit">Registruj se</button>
                                </div>
                                <div class="uk-text-small uk-text-center">
                                    Već registrovan? <a href="/login">Uloguj se</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</body>
<script>

function changeImage(event) {
    console.log('usao u moju dragu funkciju');
    
    var input = document.getElementById("image");
            var fReader = new FileReader();
            console.log(event.target);
            if(input.length != 0) {
                fReader.readAsDataURL(event.target.files[0]);
            fReader.onloadend = function(event){
                var img = document.getElementById("imagePlaceholder");
                img.src = event.target.result;
            }
            }
            


}
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
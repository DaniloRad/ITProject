@extends('layouts.front')

@section('content')
<div>

    <div class="uk-position-relative uk-visible-toggle uk-light" tabindex="-1" uk-slider="sets: true">

        <ul class="uk-slider-items uk-child-width-1-1 uk-child-width-1-2@s uk-child-width-1-3@m" style="opacity:.9">
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/1.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/2.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/3.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/4.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/5.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/6.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/7.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/8.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
            <li>
                <div class=" overlay-darker uk-height-medium uk-background-cover" data-src="./imgs/9.jpg" uk-img></div>
                <div class="uk-position-center text-white">
                    <div uk-slider-parallax="x: 100,-100">
                        JEDITE KOD DZOA
                    </div>
                </div>
            </li>
        </ul>

        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous
            uk-slider-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next
            uk-slider-item="next"></a>

    </div>

</div>
<div class="uk-padding-small uk-padding-remove-horizontal ">

    <div class="uk-child-width-1-2@s uk-child-width-1-3@m uk-child-width-1-3@l uk-text-center uk-grid-small" uk-grid>
        <div class="uk-position-relative">
            <a href="/kategorija/predjelo" class="brand-link">
                <div class=" overlay-darker uk-height-small uk-background-cover" data-src="./imgs/predjelo.jpg" uk-img></div>
                <div class="uk-position-center text-white font-family-abel white-box">
                    <div >
                        Predjelo
                    </div>
                </div>
            </a>
        </div>
        <div class="uk-position-relative">
            <a href="/kategorija/glavno-jelo" class="brand-link">
                <div class=" overlay-darker uk-height-small uk-background-cover" data-src="./imgs/glavnoJelo.jpg" uk-img></div>
                <div class="uk-position-center text-white font-family-abel white-box">
                    <div >
                        Glavno jelo
                    </div>
                </div>
            </a>
        </div>
        <div class="uk-position-relative">
            <a href="/kategorija/dezert" class="brand-link">
                <div class=" overlay-darker uk-height-small uk-background-cover" data-src="./imgs/dezert.jpg" uk-img></div>
                <div class="uk-position-center text-white font-family-abel white-box">
                    <div>
                        Dezert
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="uk-container uk-container-center">
    <div uk-grid class="uk-flex-center width-1-1 uk-padding uk-margin-auto">
    <div class="uk-width-1-1@xs uk-width-2-3@m uk-child-width-1-1 blog-box " uk-grid>

        @if($videos && sizeof($videos) > 0)
        @foreach($videos as $key => $video)

    <div uk-grid>
        <div class="uk-width-1-1@xs uk-width-2-5@s uk-height-medium uk-background-cover uk-border-rounded" data-src="{{asset($video->image)}}"  uk-img></div>
            <div class="uk-width-expand">
            <h2>{{ $video->name }}</h2>
                <div class="text-small">
                <span class="uk-badge">{{$video->category->name}}</span>
                    <span uk-icon="icon: calendar"></span>
                <span>{{\Carbon\Carbon::parse($video->created_at)->format('d.m.Y')}}</span>
                    <span uk-icon="icon: comment"></span>
                    <span>{{$video->commentSize}}</span>

                </div>
            <p class="text-normal">{{ Str::limit($video->description, 250) }}</p>
                <a class="uk-button uk-button-text" href="/emisija/{{$video->id}}">Read more</a>

            </div>
            </div>
        @endforeach

        @endif
        </div>


        
        <div class="uk-width-expand uk-hidden@xs uk-visible@m">

            <div>
                <div class="uk-padding-small box-border-creative ">
                    <span class="text-small">TRENDING POSTS</span> 
                </div>

                @if($trending && sizeof($trending) > 0)
                    @foreach($trending as $t)
                <div class="uk-padding uk-padding-remove-horizontal" uk-grid>
                    <div class="uk-width-2-5 uk-flex">
                    <div class="uk-align-center uk-width-1-1 dynamical-small-img uk-background-cover uk-border-circle" data-src="{{asset($t->image)}}"  uk-img>
                    </div>
                    </div>
                    <div class="uk-width-expand">
                        <h4>{{$t->name}}</h4>
                        <div class="text-small">
                            <span class="uk-badge">Tezina: {{$t->difficulty}}</span>
                            <span uk-icon="icon: calendar"></span>
                            <span>{{ \Carbon\Carbon::parse($t->createdAt)->format('d.m.Y') }}</span>
                            <span uk-icon="icon: comment"></span>
                            <span>{{$t->comments}}</span>
                        </div>
                        <a class="uk-button uk-button-text" href="/recept/{{$t->id}}">Read more</a>
                    </div>
                </div>
                    @endforeach
                @endif
            </div>

        </div>

       
    </div>
</div>

@endsection
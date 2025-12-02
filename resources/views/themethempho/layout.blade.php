@extends('themes::layout')

@php
    $menu = \Vsphim\Core\Models\Menu::getTree();
@endphp

@push('header')
    <link rel="stylesheet" href="/themes/thempho/css/app.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
@endpush

@section('body')
@include('themes::themethempho.inc.header')
@if (get_theme_option('ads_header'))
    {!! get_theme_option('ads_header') !!}
@endif
<div class="relative min-h-screen lg:mt-7 lg:!mb-20 inset-0 z-0 max-lg:!mb-[100px]">
    <h1 class="hidden">{{env('APP_NAME')}}</h1>
    <h2 class="hidden">{{env('APP_NAME')}}</h2>
    @yield('content')
</div>
{!! get_theme_option('footer') !!}
@endsection

@push('scripts')
<script type="text/javascript" src="/themes/thempho/js/app.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lozad.js/1.0.8/lozad.min.js" integrity="sha512-Nt+V5JYamXCSvlHzNVleriGhTrolnfxckJ8sEXxv/BJ0tKV1HyPDXH+bIFNcUJ5hcthQ95uAeU2JClPT16mFyg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const observer = lozad();
        observer.observe();
    </script>
@endpush

@section('footer')
    @if (get_theme_option('ads_catfish'))
        {!! get_theme_option('ads_catfish') !!}
    @endif
    <script>
        $(document).ready(function() {
            $('.top-star').raty({
                readOnly: true,
                numberMax: 5,
                half: true,
                score: function() {
                    return $(this).attr('data-rating');
                },
                hints: ["bad", "poor", "regular", "good", "gorgeous"],
                space: false
            });
            $('.back-to-top').click(function() {
                $('html, body').animate({scrollTop: 0}, 800);
                return false;
            });
        })
    </script>

    {!! setting('site_scripts_google_analytics') !!}
@endsection

@extends('themes::themethempho.layout')

@php

@endphp

@section('content')
<main class="l-main pb-[calc(var(--slide-bar-bottom-height))+68px] lg:pb-[calc(var(--slide-bar-bottom-height))]">
    <div class="container-sm">
        <div class="max-lg:hidden mb-8"><div class="mt-4 flex flex-col justify-center gap-4"><h1 class="typography font-sans-text lg:text-[2.25rem] text-[2rem] leading-12 font-bold lg:leading-[40px] lg:max-w-[calc(1184/1920*100vw)]">{{ $section_name }}</h1></div></div>
    </div>
    <section class="l-section empty:hidden my-5 lg:my-10 container-sm">
        <div>
            <ul class="grid gap-y-6 gap-x-2 grid-cols-2 md:gap-4 lg:gap-x-4 lg:gap-y-8 lg:grid-cols-5">
                @foreach ($data as $key => $movie)
                    @include('themes::themethempho.inc.sections_movies_item')
                @endforeach
            </ul>
        </div>
        <div class="mt-20">
            {{ $data->appends(request()->all())->links('themes::themethempho.inc.pagination') }}
        </div>
    </section>
</main>
@endsection

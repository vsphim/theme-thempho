@extends('themes::themethempho.layout')

@php
    use Vsphim\Core\Models\Movie;

    $recommendations = Cache::remember('site.movies.recommendations', setting('site_cache_ttl', 5 * 60), function () {
        return Movie::where('is_recommended', true)
            ->limit(5)
            ->orderBy('updated_at', 'desc')
            ->get();
    });

    $data = Cache::remember('site.movies.latest', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('latest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $limit, $link, $template] = array_merge($list, ['Phim mới cập nhật', '', 'type', 'series', 8, '/', 'block_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'data' => Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->limit($limit)
                            ->orderBy('updated_at', 'desc')
                            ->get(),
                        'link' => $link ?: '#',
                        'type' => $template ?: 'block_thumb',
                    ];
                } catch (\Exception $e) {
                }
            }
        }
        return $data;
    });

    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \Vsphim\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });

@endphp

@push('header')
<style>
    .swiper-fade.swiper-free-mode .swiper-slide{transition-timing-function:ease-out}.swiper-fade .swiper-slide{pointer-events:none;transition-property:opacity}.swiper-fade .swiper-slide .swiper-slide{pointer-events:none}.swiper-fade .swiper-slide-active,.swiper-fade .swiper-slide-active .swiper-slide-active{pointer-events:auto}
</style>
@endpush

@section('content')
<main class="l-main pb-[calc(var(--slide-bar-bottom-height))+68px] lg:pb-[calc(var(--slide-bar-bottom-height))] -mt-[--home-header-height]">
    @include('themes::themethempho.inc.slider_recommended')
    @foreach ($data as $index => $item)
        @if ($item['type'] == 'block_thumb')
            @include('themes::themethempho.inc.sections_movies')
        @else
            @include('themes::themethempho.inc.section_slider')
        @endif
    @endforeach
</main>
@endsection

@push('scripts')
    <script src="/themes/thempho/js/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-recommended', {
            loop: true,
            slidesPerView: 1,
            effect: 'fade',
            fade: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
        });

        var swiperHot = new Swiper('.swiper-hot', {
            loop: true,
            slidesPerView: 7,
            spaceBetween: 16,
            freeMode: true,
            breakpoints: {
                1670: {
                    slidesPerView: 7,
                },
                1470: {
                    slidesPerView: 6.5,
                },
                1200: {
                    slidesPerView: 6,
                },
                850: {
                    slidesPerView: 5,
                },
                600: {
                    slidesPerView: 4.5,
                },
                400: {
                    slidesPerView: 3,
                },
                0: {
                    slidesPerView: 2.1,
                },
            },
            navigation: {
                nextEl: '.navigation-next-button',
                prevEl: '.navigation-prev-button',
            },
        });

        const thumbSlides = document.querySelectorAll('.thumbs-slider .item-thumb');

        thumbSlides.forEach((slide, index) => {
            slide.addEventListener('click', () => {
                swiper.slideTo(index);

                thumbSlides.forEach(s => s.querySelector('.thumb-overlay').style.borderWidth = '0px');
                slide.querySelector('.thumb-overlay').style.borderWidth = '2px';
            });
        });

        swiper.on('slideChange', function() {
            thumbSlides.forEach((slide, index) => {
                const overlay = slide.querySelector('.thumb-overlay');
                overlay.style.borderWidth = index === swiper.activeIndex ? '2px' : '0px';
            });
        });
    </script>
@endpush

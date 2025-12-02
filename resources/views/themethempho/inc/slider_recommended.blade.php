<section class="l-section empty:hidden mt-0 pt-8">
    <div class="relative">
        <div class="relative">
            <div class="swiper-recommended swiper">
                <div class="swiper-wrapper">
                    @foreach ($recommendations as $movie)
                        <div class="swiper-slide">
                            <div class="relative bg-primary-bg w-full h-full">
                                <div class="relative">
                                    <div class="absolute inset-0 blur-[40px]" style="transform:translate3d(0, 0, 0)">
                                        <img alt="{{$movie->name}}" class="object-cover" loading="lazy" style="position:absolute;height:100%;width:100%;left:0;top:0;right:0;bottom:0;color:transparent" src="{{$movie->getPosterUrl()}}">
                                    </div>
                                    <div class="absolute inset-0 max-lg:z-[calc(var(--zContent)+1)] pointer-events-none bg-[linear-gradient(0deg,black,transparent_40%)] lg:bg-[linear-gradient(0deg,black,transparent_40%)]"></div>
                                    <div class="absolute inset-0 z-[calc(var(--zContent)+1)] pointer-events-none h-[86px] bg-gradient-to-b from-[#000000FF] to-[#00000000]"></div>
                                    <div class="relative flex w-full gap-14 lg:container aspect-[4/3] lg:aspect-[1669/800] xl:aspect-[1869/740]">

                                        <div class="z-[calc(var(--zContent)+2)] max-lg:container bottom-0 max-lg:absolute lg:grow min-w-0 flex gap-6 items-center min-h-[56px]">
                                            <div class="flex flex-col justify-center h-full grow">
                                                <a class="typography font-sans-text lg:text-[2.5rem] text-[1.25rem] leading-[28px] lg:leading-[46px] font-semibold drop-shadow-placeOn line-clamp-2 lg:line-clamp-3"
                                                    href="{{$movie->getUrl()}}">
                                                    {{$movie->name}}
                                                </a>
                                                <div class="typography font-sans-text lg:text-[1rem] lg:leading-[1.5rem] text-[0.875rem] leading-[1.25rem] mt-1 lg:mt-3 line-clamp-2 lg:line-clamp-3 drop-shadow-placeOn">
                                                    {!! $movie->content !!}
                                                </div>
                                                <div class="mt-4 flex flex-wrap gap-6">
                                                    <button onclick="window.location.href='{{$movie->getUrl()}}'" class="a-button max-lg:hidden flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap leading-[100%] disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-hover rounded-full h-12 gap-2 px-6 font-bold" aria-label="Xem ngay">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M18.5402 9.00003L8.88021 3.46003C8.3575 3.15819 7.76421 3.00006 7.16061 3.00172C6.557 3.00338 5.96459 3.16476 5.44354 3.46947C4.92249 3.77417 4.49137 4.21135 4.19396 4.7366C3.89655 5.26185 3.74345 5.85646 3.75021 6.46003V17.58C3.75021 18.4871 4.11053 19.357 4.75191 19.9983C5.39328 20.6397 6.26317 21 7.17021 21C7.77065 20.999 8.3603 20.8404 8.88021 20.54L18.5402 15C19.0593 14.6996 19.4902 14.268 19.7898 13.7485C20.0894 13.2289 20.2471 12.6397 20.2471 12.04C20.2471 11.4403 20.0894 10.8511 19.7898 10.3316C19.4902 9.81206 19.0593 9.38044 18.5402 9.08003V9.00003Z" fill="currentColor"></path></svg>
                                                        <p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] uppercase">Xem ngay</p>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="lg:hidden shrink-0 flex items-center">
                                                <button onclick="window.location.href='{{$movie->getUrl()}}'" class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-10 h-10 bg-primary hover:bg-primary-hover rounded-full" aria-label="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="-mr-1"><path d="M18.5402 9.00003L8.88021 3.46003C8.3575 3.15819 7.76421 3.00006 7.16061 3.00172C6.557 3.00338 5.96459 3.16476 5.44354 3.46947C4.92249 3.77417 4.49137 4.21135 4.19396 4.7366C3.89655 5.26185 3.74345 5.85646 3.75021 6.46003V17.58C3.75021 18.4871 4.11053 19.357 4.75191 19.9983C5.39328 20.6397 6.26317 21 7.17021 21C7.77065 20.999 8.3603 20.8404 8.88021 20.54L18.5402 15C19.0593 14.6996 19.4902 14.268 19.7898 13.7485C20.0894 13.2289 20.2471 12.6397 20.2471 12.04C20.2471 11.4403 20.0894 10.8511 19.7898 10.3316C19.4902 9.81206 19.0593 9.38044 18.5402 9.08003V9.00003Z" fill="currentColor"></path></svg></button>
                                            </div>
                                        </div>
                                        <div class="w-full lg:z-zContent xl:pt-[60px] lg:w-[55%] xl:w-[65%] xl:pr-[calc(202/1434*100%)] relative shrink-0 h-full flex items-center justify-center">
                                            <div class="a-linkWrapper lg:aspect-[16/10] xl:aspect-[907/635] max-lg:h-full relative w-full lg:mb-[calc(274px*9/48)] xl:mb-0">
                                                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{$movie->name}}"
                                                    href="{{$movie->getUrl()}}">{{$movie->name}}
                                                </a>
                                                <div class="absolute z-zContent pointer-events-none inset-0">
                                                    <div class="relative w-full h-full">
                                                        <img loading="lazy" src="{{$movie->getPosterUrl()}}" alt="{{$movie->name}}" class="w-full rounded-md h-full object-cover absolute inset-0">
                                                    </div>
                                                </div>
                                                <div class="absolute hidden bottom-0 right-[calc(100%+56px)]">
                                                    <ul class="flex gap-1"><li class="shrink-0"><div class="w-1 h-1 bg-white/20 duration-300"></div></li><li class="shrink-0"><div class="h-1 duration-300 w-2 bg-white"></div></li><li class="shrink-0"><div class="w-1 h-1 bg-white/20 duration-300"></div></li><li class="shrink-0"><div class="w-1 h-1 bg-white/20 duration-300"></div></li><li class="shrink-0"><div class="w-1 h-1 bg-white/20 duration-300"></div></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="absolute lg:bottom-0 inset-x-0 xl:inset-y-0 pointer-events-none thumbs-slider">
            <div class="relative xl:w-full h-full">
                <div class="container max-lg:hidden xl:h-full">
                    <div class="relative z-zContent xl:flex xl:justify-end xl:items-center xl:w-full xl:h-full xl:pt-[60px]">
                        <div class="grid grid-cols-5 gap-5 xl:grid-cols-1 xl:flex xl:justify-between xl:flex-col xl:w-[calc(168/1434*100%)] xl:grid-items xl:h-[92%] xl:content-evenly xl:gap-0 pointer-events-auto">
                            @foreach ($recommendations as $movie)
                                <div class="cursor-pointer w-full item-thumb">
                                    <div class="relative aspect-[16/9] rounded-md overflow-hidden border-primary thumb-overlay">
                                        <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                            <img alt="{{$movie->name}}" class="hover:brightness-110 lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;" data-src="{{$movie->getPosterUrl()}}">
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


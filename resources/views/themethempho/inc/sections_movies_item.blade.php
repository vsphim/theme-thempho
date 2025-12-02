<li>
    <div class="m-longVideoCard relative">
        <div class="group/card">
            <div class="a-linkWrapper relative group/thumbnail">
                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{$movie->name}}" rel="" href="{{$movie->getUrl()}}">
                    {{$movie->name}}
                </a>
                <div class="relative aspect-[16/10] rounded-md overflow-hidden cursor-pointer">
                    <div class="relative w-full h-full">
                        <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                            <img title="{{$movie->name}}" alt="{{$movie->name}}" data-src="{{$movie->getPosterUrl()}}" class="duration-300 group-hover/card:scale-[1.05] lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                        </span>
                    </div>
                    <div class="absolute bottom-0 inset-x-0 h-[60px]" style="background-image: linear-gradient(0deg, rgba(10, 12, 15, 0.8) 0%, rgba(10, 12, 15, 0.74) 4%, rgba(10, 12, 15, 0.59) 17%, rgba(10, 12, 15, 0.4) 34%, rgba(10, 12, 15, 0.21) 55%, rgba(10, 12, 15, 0.06) 78%, rgba(10, 12, 15, 0) 100%);"></div>
                    <div class="absolute inset-0 pointer-events-none flex items-center justify-center duration-300 bg-transparent">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-0 duration-300 group-hover/card:opacity-100"><path d="M18.5402 9.00003L8.88021 3.46003C8.3575 3.15819 7.76421 3.00006 7.16061 3.00172C6.557 3.00338 5.96459 3.16476 5.44354 3.46947C4.92249 3.77417 4.49137 4.21135 4.19396 4.7366C3.89655 5.26185 3.74345 5.85646 3.75021 6.46003V17.58C3.75021 18.4871 4.11053 19.357 4.75191 19.9983C5.39328 20.6397 6.26317 21 7.17021 21C7.77065 20.999 8.3603 20.8404 8.88021 20.54L18.5402 15C19.0593 14.6996 19.4902 14.268 19.7898 13.7485C20.0894 13.2289 20.2471 12.6397 20.2471 12.04C20.2471 11.4403 20.0894 10.8511 19.7898 10.3316C19.4902 9.81206 19.0593 9.38044 18.5402 9.08003V9.00003Z" fill="currentColor"></path></svg>
                    </div>
                </div>
                <div class="cursor-pointer mt-2">
                    <h3 class="typography font-sans-text lg:text-[1rem] lg:leading-[1.5rem] text-[0.875rem] leading-[1.25rem] text-primary-text/80 line-clamp-2 pr-3 lg:pr-4 group-hover/card:text-primary break-words duration-300">
                        {{$movie->name}}
                    </h3>
                </div>
            </div>
        </div>
        <ul class="mt-1 flex items-center line-clamp-1 max-lg:[&amp;_li:nth-child(n+3)]:hidden">
            <li class="shrink-0">
                <p class="typography font-sans-text text-[0.75rem] leading-[normal] text-secondary-text/80 lowercase line-clamp-1">{{$movie->view_total}} Lượt xem </p>
            </li>
            <li class="ml-1 flex items-center gap-1">
                <p class="typography font-sans-text text-[0.75rem] leading-[normal] text-secondary-text/80 lowercase hover:text-white">•</p>
                @if ($movie->categories->count() > 0)
                    <a class="typography font-sans-text text-[0.75rem] leading-[normal] text-secondary-text/80 whitespace-nowrap hover:text-white normal-case cursor-pointer"
                        href="{{$movie->categories->first()->getUrl()}}">
                        {{$movie->categories->first()->name}}
                    </a>
                @endif
            </li>
        </ul>
    </div>
</li>

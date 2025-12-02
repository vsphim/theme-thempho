<div class="pt-4">
    <div>
        <section class="text-gray-600 body-font">
            <div class="flex flex-col w-full mb-2">
                <span class="uppercase font-medium text-gray-200 text-md border-b border-zinc-800 w-full block pb-2 mb-2">{{ $top['label'] }}</span>
            </div>
            <div class="-m-2">
                @foreach ($top['data'] as $key => $movie)
                    <div class="p-1 w-full">
                        <div class="h-full flex border-zinc-800 border p-2 rounded-sm gap-2">
                            <a class="w-2/5 h-24" href="{{$movie->getUrl()}}" title="{{$movie->name}}">
                                <img data-src="{{$movie->getThumbUrl()}}" alt="{{$movie->name}}" title="{{$movie->name}}" class="w-full lozad h-full object-cover object-center rounded-md">
                            </a>
                            <div class="w-3/5 truncate">
                                <a href="{{$movie->getUrl()}}" class="text-gray-300 text-[14px] truncate font-medium" title="{{$movie->name}}">{{$movie->name}}</a>
                                <span class="text-zinc-300 text-sm block font-medium">{{$movie->publish_year}}</span>
                                <div class="flex items-center pt-2">
                                    <svg class="w-4 h-4 text-zinc-400 me-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"><path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"></path></svg>
                                    <p class="text-sm font-medium text-zinc-400">{{($movie->getRatingStar())}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>
</div>

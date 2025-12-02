<div class="pt-4">
    <div class="flex flex-wrap">
        <div class="w-full">
            <span class="uppercase text-gray-200 text-md font-medium border-b border-zinc-800 w-full block pb-2">{{ $top['label'] }}</span>
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded">
                <div class="px-2 py-3 flex-auto">
                    <div class="tab-content tab-space">
                        <div>
                            @foreach ($top['data'] as $key => $movie)
                            <a href="{{$movie->getUrl()}}" title="{{$movie->name}}" class="grid items-center grid-cols-12 pb-2 over:shadow-xl transform group hover:opacity-80 hover:scale-105 duration-300 gapx-3">
                                <div class="col-span-2">
                                    <div class="text-white font-medium text-md hover:shadow-lg">
                                        <span style="color:#000" class="leading-7 text-xs bg-[#c58560] w-7 h-7 inline-block rounded-full text-center">{{$loop->iteration}}</span>
                                    </div>
                                </div>
                                <div class="col-span-10 ml-1">
                                    <span class="block text-gray-200 truncate capitalize">{{$movie->name}}</span>
                                    <span class="text-xs text-gray-400">{{$movie->view_total}} lượt xem</span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

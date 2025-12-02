@extends('themes::themethempho.layout')

@push('header')
@endpush

@php
    $watchUrl = '#';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watchUrl = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }

    $checkFollow = false;
    if (auth()->check()) {
        $checkFollow = DB::table('follows')->where('user_id', auth()->id())->where('movie_id', $currentMovie->id)->exists();
    }

    if(auth()->check()){
        $user = auth()->user();
        $checkHistory = DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->first();
        if($checkHistory){
            $histories = explode(',', $checkHistory->watch_at);
            if(!in_array($episode->id, $histories)){
                $histories[] = $episode->id;
                DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->update([
                    'watch_at' => implode(",", $histories),
                    'updated_at' => now()
                ]);
            }else{
                $key = array_search($episode->id, $histories);
                unset($histories[$key]);
                array_push($histories, $episode->id);
                DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->update([
                    'watch_at' => implode(",", $histories),
                    'updated_at' => now()
                ]);
            }
        }else{
            $checkCountHistory = DB::table('histories')->where('user_id', $user->id)->where('movie_id', $currentMovie->id)->count();
            if($checkCountHistory > 45){
                DB::table('histories')->where('user_id', $user->id)->orderBy('updated_at', 'asc')->limit(1)->delete();
            }
            DB::table('histories')->insert([
                'movie_id' => $currentMovie->id,
                'user_id' => $user->id,
                'watch_at' => $episode->id,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }

    use Vsphim\Core\Models\Episode;
    $continueUrl = null;
    $listHistory = [];
    if (auth()->check()) {
        $checkHistory = DB::table('histories')->where('user_id', auth()->id())->where('movie_id', $currentMovie->id)->first();
        if($checkHistory) {
            $listHistory = explode(',', $checkHistory->watch_at);
            $lastEpisode = last($listHistory);
            $continueUrl = Episode::find($lastEpisode);
        }
    }
    use App\Models\Comment;
    $comments = Comment::where('movie_id', $currentMovie->id)->where('parent_id', null)->orderBy('created_at', 'desc')->paginate(5);
    $totalComment = Comment::where('movie_id', $currentMovie->id)->count();

@endphp

@section('content')
<main class="l-main pb-[calc(var(--slide-bar-bottom-height))+68px] lg:pb-[calc(var(--slide-bar-bottom-height))]">
    <div class="lg:container-sm">
        <div class="flex gap-10">
            <div class="grow min-w-0">
                <nav aria-label="breadcrumb" class="max-lg:hidden overflow-y-hidden line-clamp-1">
                    <ol class="flex gap-2 line-clamp-1">
                        <li class="flex items-center gap-2 capitalize font-medium opacity-50 whitespace-nowrap">
                            <a href="/" class="flex items-center gap-1">
                                <svg width="24" height="24" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mb-[2px]">
                                    <path d="M23.8334 9.33383L16.8334 3.19716C16.1918 2.62321 15.361 2.30591 14.5001 2.30591C13.6392 2.30591 12.8085 2.62321 12.1668 3.19716L5.16678 9.33383C4.79621 9.66525 4.50049 10.0718 4.29933 10.5264C4.09816 10.9811 3.99616 11.4734 4.00011 11.9705V22.1672C4.00011 23.0954 4.36886 23.9857 5.02524 24.642C5.68161 25.2984 6.57185 25.6672 7.50011 25.6672H21.5001C22.4284 25.6672 23.3186 25.2984 23.975 24.642C24.6314 23.9857 25.0001 23.0954 25.0001 22.1672V11.9588C25.0024 11.4637 24.8996 10.9736 24.6985 10.5211C24.4974 10.0686 24.2025 9.66394 23.8334 9.33383ZM16.8334 23.3338H12.1668V17.5005C12.1668 17.1911 12.2897 16.8943 12.5085 16.6755C12.7273 16.4567 13.024 16.3338 13.3334 16.3338H15.6668C15.9762 16.3338 16.2729 16.4567 16.4917 16.6755C16.7105 16.8943 16.8334 17.1911 16.8334 17.5005V23.3338ZM22.6668 22.1672C22.6668 22.4766 22.5439 22.7733 22.3251 22.9921C22.1063 23.2109 21.8095 23.3338 21.5001 23.3338H19.1668V17.5005C19.1668 16.5722 18.798 15.682 18.1417 15.0256C17.4853 14.3692 16.595 14.0005 15.6668 14.0005H13.3334C12.4052 14.0005 11.5149 14.3692 10.8586 15.0256C10.2022 15.682 9.83344 16.5722 9.83344 17.5005V23.3338H7.50011C7.19069 23.3338 6.89395 23.2109 6.67515 22.9921C6.45636 22.7733 6.33344 22.4766 6.33344 22.1672V11.9588C6.33365 11.7932 6.36914 11.6295 6.43753 11.4786C6.50593 11.3277 6.60566 11.1932 6.73011 11.0838L13.7301 4.95883C13.943 4.77179 14.2167 4.66864 14.5001 4.66864C14.7835 4.66864 15.0572 4.77179 15.2701 4.95883L22.2701 11.0838C22.3946 11.1932 22.4943 11.3277 22.5627 11.4786C22.6311 11.6295 22.6666 11.7932 22.6668 11.9588V22.1672Z" fill="currentColor"></path>
                                </svg>
                                <span>Trang chủ</span>
                            </a>
                            <span class="text-gray-400 text-sm bold">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                            </span>
                        </li>
                        @if ($currentMovie->categories->count() > 0)
                        <li class="flex items-center gap-2 capitalize font-medium opacity-50 whitespace-nowrap">
                            <a href="{{$currentMovie->categories->first()->getUrl()}}" class="flex items-center gap-1"><span>{{$currentMovie->categories->first()->name}}</span></a>
                            <span class="text-gray-400 text-sm bold">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                            </span>
                        </li>
                        @endif
                        <li class="flex items-center gap-2 capitalize font-medium whitespace-nowrap opacity-100">
                            <a href="{{$currentMovie->getUrl()}}"
                                class="flex items-center gap-1">
                                <span>{{$currentMovie->name}}</span>
                            </a>
                        </li>
                    </ol>
                </nav>
                <section class="l-section empty:hidden mt-5">
                    <div class="aspect-[16/9] w-full [&_.vds-settings-menu-items.vds-menu-items]:overflow-auto">
                        <div class="group/video relative z-0 [&_.art-controls]:pointer-events-none [&:has(.art-control-show)_.art-controls]:pointer-events-auto [&:has(.art-control-show)_.mobile-seek]:flex [&_.art-mask]:!hidden [&_.art-control-progress:hover_.art-control-progress-inner]:!h-[75%] [&:has(.art-control-show)_.cs-mask]:block [&_.cs-mobile-seek]:lg:!hidden [&_.art-control-thumbnails]:!bottom-[calc(var(--art-bottom-gap)+20px)] [&:has(.artplayer-plugin-ads)_.art-controls]:hidden [&:has(.artplayer-plugin-ads)_.art-progress]:hidden [&:has(.artplayer-plugin-ads)_.art-bottom]:hidden [&_not(.art-control-show)_.art-progress]:pointer-events-none [&:not(:has(.art-control-show))_.art-bottom_*]:!pointer-events-none">
                            <div class="w-full aspect-[16/9] relative" id="player"></div>
                            <div class="absolute z-zContent top-1/2 inset-x-0 -translate-y-1/2 flex justify-around pointer-events-none text-white"></div>
                        </div>
                    </div>
                    <div class="max-lg:container-sm">
                        <div class="mt-4 lg:mt-6 flex gap-2 items-center px-[2px]">
                            <button class="a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary-btn hover:bg-primary-btn-hover rounded-full h-8 gap-2 font-normal text-[0.875rem] px-4 uppercase" aria-label="button-icon">
                                <svg width="20" height="20" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[2ch]"><path d="M7.99991 1.33337C7.12443 1.33337 6.25752 1.50581 5.44869 1.84084C4.63985 2.17588 3.90492 2.66694 3.28587 3.286C2.03562 4.53624 1.33324 6.23193 1.33324 8.00004C1.32742 9.53946 1.86044 11.0324 2.83991 12.22L1.50658 13.5534C1.41407 13.6471 1.35141 13.7662 1.32649 13.8955C1.30158 14.0248 1.31552 14.1586 1.36658 14.28C1.42195 14.4 1.51171 14.5008 1.62448 14.5696C1.73724 14.6385 1.86791 14.6723 1.99991 14.6667H7.99991C9.76802 14.6667 11.4637 13.9643 12.714 12.7141C13.9642 11.4638 14.6666 9.76815 14.6666 8.00004C14.6666 6.23193 13.9642 4.53624 12.714 3.286C11.4637 2.03575 9.76802 1.33337 7.99991 1.33337ZM7.99991 13.3334H3.60658L4.22658 12.7134C4.35074 12.5885 4.42044 12.4195 4.42044 12.2434C4.42044 12.0673 4.35074 11.8983 4.22658 11.7734C3.35363 10.9014 2.81003 9.75373 2.68837 8.5259C2.56672 7.29807 2.87454 6.06604 3.5594 5.03972C4.24425 4.0134 5.26377 3.25628 6.44425 2.89736C7.62474 2.53843 8.89315 2.59991 10.0334 3.07132C11.1736 3.54272 12.1151 4.39489 12.6975 5.48264C13.2799 6.57038 13.4672 7.8264 13.2273 9.03671C12.9875 10.247 12.3354 11.3367 11.3823 12.1202C10.4291 12.9037 9.23375 13.3324 7.99991 13.3334Z" fill="currentColor"></path></svg>
                                <p class="typography font-sans-text text-[0.75rem] leading-[1.25rem]">{{$totalComment}} Bình luận</p>
                            </button>
                            <button data-movie_id="{{$currentMovie->id}}" class="a-button btn-follow flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary-btn hover:bg-primary-btn-hover rounded-full h-8 gap-2 px-4 font-normal text-[0.875rem]" aria-label="button-icon"><svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[1.25em]"><path d="M16 2H8.00001C7.20436 2 6.4413 2.31607 5.87869 2.87868C5.31608 3.44129 5.00001 4.20435 5.00001 5V21C4.99931 21.1762 5.04518 21.3495 5.13299 21.5023C5.22079 21.655 5.3474 21.7819 5.50001 21.87C5.65203 21.9578 5.82447 22.004 6.00001 22.004C6.17554 22.004 6.34799 21.9578 6.50001 21.87L12 18.69L17.5 21.87C17.6524 21.9564 17.8248 22.0012 18 22C18.1752 22.0012 18.3476 21.9564 18.5 21.87C18.6526 21.7819 18.7792 21.655 18.867 21.5023C18.9548 21.3495 19.0007 21.1762 19 21V5C19 4.20435 18.6839 3.44129 18.1213 2.87868C17.5587 2.31607 16.7957 2 16 2ZM17 19.27L12.5 16.67C12.348 16.5822 12.1755 16.536 12 16.536C11.8245 16.536 11.652 16.5822 11.5 16.67L7.00001 19.27V5C7.00001 4.73478 7.10536 4.48043 7.2929 4.29289C7.48044 4.10536 7.73479 4 8.00001 4H16C16.2652 4 16.5196 4.10536 16.7071 4.29289C16.8947 4.48043 17 4.73478 17 5V19.27Z" fill="currentColor"></path></svg> <span class="max-lg:hidden text-[12px]">LƯU</span></button>
                            @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                                <button data-id="{{ $server->id }}"  data-link="{{ $server->link }}" data-type="{{ $server->type }}"
                                    onclick="chooseStreamingServer(this)" class="streaming-server a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary-btn hover:bg-primary-btn-hover rounded-full h-8 gap-2 font-normal text-[0.875rem] px-4 uppercase" data-variant="textOnly" type="button">
                                    <p class="typography font-sans-text text-[0.75rem] leading-[1.25rem]">#{{ $loop->index + 1 }}</p>
                                </button>
                            @endforeach
                        </div>
                        <div class="mt-4 lg:mt-6">
                            <h1 class="typography font-sans-text lg:text-[1.75rem] lg:leading-[2.5rem] text-[1.125rem] leading-[normal] font-bold text-white lg:pr-12">
                                {{$currentMovie->name}}
                            </h1>
                            <p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] text-secondary-text mt-2">{{$currentMovie->view_total}} lượt xem • {{ \Carbon\Carbon::parse($currentMovie->created_at)->format('d/m/Y') }}</p>
                        </div>
                        <div class="mt-4 mb-8">
                            <div class="a-showMoreContent relative">
                                <div class="relative overflow-hidden max-h-[80px] lg:max-h-full">
                                    <div class="typography font-sans-text lg:text-[1rem] lg:leading-[1.5rem] text-[0.875rem] leading-[1.25rem] lg:pr-12 text-primary-text/80">
                                        {!! $currentMovie->content !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="mt-4 flex gap-2 gap-y-1 items-center flex-wrap">
                            @foreach ($currentMovie->categories as $category)
                                <li>
                                    <a href="{{$category->getUrl()}}" class="a-button justify-center relative [&:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary-btn hover:bg-primary-btn-hover rounded-full h-7 px-3 text-[0.875rem] gap-1 flex items-center line-clamp-1 !font-normal">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M5.00017 4.00005C4.80239 4.00005 4.60905 4.0587 4.4446 4.16858C4.28015 4.27846 4.15198 4.43464 4.07629 4.61737C4.00061 4.80009 3.9808 5.00116 4.01939 5.19514C4.05797 5.38912 4.15321 5.56731 4.29307 5.70716C4.43292 5.84701 4.6111 5.94225 4.80508 5.98084C4.99906 6.01942 5.20013 5.99962 5.38286 5.92393C5.56558 5.84824 5.72176 5.72007 5.83164 5.55562C5.94153 5.39117 6.00017 5.19783 6.00017 5.00005C6.00017 4.73484 5.89482 4.48048 5.70728 4.29294C5.51974 4.10541 5.26539 4.00005 5.00017 4.00005ZM14.0802 7.14005L8.47351 1.52672C8.41121 1.46493 8.33734 1.41605 8.25611 1.38287C8.17489 1.34969 8.08791 1.33288 8.00017 1.33339H2.00017C1.82336 1.33339 1.65379 1.40362 1.52877 1.52865C1.40375 1.65367 1.33351 1.82324 1.33351 2.00005V8.00005C1.333 8.08779 1.34982 8.17477 1.38299 8.25599C1.41617 8.33721 1.46505 8.41109 1.52684 8.47339L7.14017 14.0801C7.51518 14.4546 8.02351 14.665 8.55351 14.665C9.08351 14.665 9.59184 14.4546 9.96684 14.0801L14.0802 10.0001C14.4547 9.62505 14.6651 9.11672 14.6651 8.58672C14.6651 8.05672 14.4547 7.54839 14.0802 7.17339V7.14005ZM13.1402 9.02005L9.02017 13.1334C8.89527 13.2576 8.7263 13.3272 8.55017 13.3272C8.37405 13.3272 8.20508 13.2576 8.08017 13.1334L2.66684 7.72672V2.66672H7.72684L13.1402 8.08005C13.202 8.14235 13.2508 8.21622 13.284 8.29745C13.3172 8.37867 13.334 8.46565 13.3335 8.55339C13.3328 8.72828 13.2633 8.89588 13.1402 9.02005Z" fill="currentColor"></path></svg>
                                        <span class="mb-[1px]">{{$category->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                            @foreach ($currentMovie->tags as $tag)
                                <li>
                                    <a href="{{$tag->getUrl()}}" class="a-button justify-center relative [&:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary-btn hover:bg-primary-btn-hover rounded-full h-7 px-3 text-[0.875rem] gap-1 flex items-center line-clamp-1 !font-normal">
                                        <svg stroke="currentColor" fill="currentColor" stroke-width="0" version="1.1" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M5.00017 4.00005C4.80239 4.00005 4.60905 4.0587 4.4446 4.16858C4.28015 4.27846 4.15198 4.43464 4.07629 4.61737C4.00061 4.80009 3.9808 5.00116 4.01939 5.19514C4.05797 5.38912 4.15321 5.56731 4.29307 5.70716C4.43292 5.84701 4.6111 5.94225 4.80508 5.98084C4.99906 6.01942 5.20013 5.99962 5.38286 5.92393C5.56558 5.84824 5.72176 5.72007 5.83164 5.55562C5.94153 5.39117 6.00017 5.19783 6.00017 5.00005C6.00017 4.73484 5.89482 4.48048 5.70728 4.29294C5.51974 4.10541 5.26539 4.00005 5.00017 4.00005ZM14.0802 7.14005L8.47351 1.52672C8.41121 1.46493 8.33734 1.41605 8.25611 1.38287C8.17489 1.34969 8.08791 1.33288 8.00017 1.33339H2.00017C1.82336 1.33339 1.65379 1.40362 1.52877 1.52865C1.40375 1.65367 1.33351 1.82324 1.33351 2.00005V8.00005C1.333 8.08779 1.34982 8.17477 1.38299 8.25599C1.41617 8.33721 1.46505 8.41109 1.52684 8.47339L7.14017 14.0801C7.51518 14.4546 8.02351 14.665 8.55351 14.665C9.08351 14.665 9.59184 14.4546 9.96684 14.0801L14.0802 10.0001C14.4547 9.62505 14.6651 9.11672 14.6651 8.58672C14.6651 8.05672 14.4547 7.54839 14.0802 7.17339V7.14005ZM13.1402 9.02005L9.02017 13.1334C8.89527 13.2576 8.7263 13.3272 8.55017 13.3272C8.37405 13.3272 8.20508 13.2576 8.08017 13.1334L2.66684 7.72672V2.66672H7.72684L13.1402 8.08005C13.202 8.14235 13.2508 8.21622 13.284 8.29745C13.3172 8.37867 13.334 8.46565 13.3335 8.55339C13.3328 8.72828 13.2633 8.89588 13.1402 9.02005Z" fill="currentColor"></path></svg>
                                        <span class="mb-[1px]">{{$tag->name}}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
                <script>
                    var movie_id = {{ $currentMovie->id }};
                </script>
                @include('themes::themethempho.inc.comment')
                <section class="l-section empty:hidden mt-8 lg:mt-[4rem] max-lg:container-sm">
                    <div>
                        <div>
                            <div class="m-sectionTitle flex items-center justify-between gap-3 pb-4 sm:pb-8">
                                <div class="a-linkWrapper relative">
                                    <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="Có thể bạn sẽ thích" rel="" href="#">Có thể bạn sẽ thích</a>
                                    <h3 class="typography font-sans-text lg:text-[1.75rem] lg:leading-[2.5rem] sm:text-[1.5rem] sm:leading-[1.75rem] text-[1.25rem] leading-[1.75rem] text-primary font-bold">Có thể bạn sẽ thích</h3>
                                </div>
                            </div>
                        </div>
                        <div>
                            <ul class="grid gap-y-6 gap-x-2 md:gap-4 lg:gap-x-4 lg:gap-y-8 grid-cols-[repeat(var(--initial-cols),minmax(0,1fr))] sm:grid-cols-[repeat(var(--sm-cols),minmax(0,1fr))] lg:grid-cols-[repeat(var(--lg-cols),minmax(0,1fr))] xl:grid-cols-[repeat(var(--xl-cols),minmax(0,1fr))]" style="--xl-cols: 3; --lg-cols: 4; --sm-cols: 3; --initial-cols: 2;">
                                @foreach ($movie_related as $movie)
                                    <li>
                                        <div class="m-longVideoCard relative">
                                            <div class="group/card">
                                                <div class="a-linkWrapper relative group/thumbnail">
                                                    <a class="absolute text-transparent inset-0 z-zContent overflow-hidden"
                                                        title="{{$movie->name}}" rel=""
                                                        href="{{$movie->getUrl()}}">
                                                        {{$movie->name}}
                                                    </a>
                                                    <div class="relative aspect-[16/10] rounded-md overflow-hidden cursor-pointer">
                                                        <div class="relative w-full h-full">
                                                            <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                                                <img title="{{$movie->name}}" alt="{{$movie->name}}" data-src="{{$movie->getPosterUrl()}}"  class="duration-300 group-hover/card:scale-[1.05] lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                                            </span>
                                                        </div>
                                                        <div class="absolute bottom-0 inset-x-0 h-[60px]" style="background-image: linear-gradient(0deg, rgba(10, 12, 15, 0.8) 0%, rgba(10, 12, 15, 0.74) 4%, rgba(10, 12, 15, 0.59) 17%, rgba(10, 12, 15, 0.4) 34%, rgba(10, 12, 15, 0.21) 55%, rgba(10, 12, 15, 0.06) 78%, rgba(10, 12, 15, 0) 100%);"></div>
                                                        <div class="absolute inset-0 pointer-events-none flex items-center justify-center duration-300 bg-transparent">
                                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 opacity-0 duration-300 group-hover/card:opacity-100"><path d="M18.5402 9.00003L8.88021 3.46003C8.3575 3.15819 7.76421 3.00006 7.16061 3.00172C6.557 3.00338 5.96459 3.16476 5.44354 3.46947C4.92249 3.77417 4.49137 4.21135 4.19396 4.7366C3.89655 5.26185 3.74345 5.85646 3.75021 6.46003V17.58C3.75021 18.4871 4.11053 19.357 4.75191 19.9983C5.39328 20.6397 6.26317 21 7.17021 21C7.77065 20.999 8.3603 20.8404 8.88021 20.54L18.5402 15C19.0593 14.6996 19.4902 14.268 19.7898 13.7485C20.0894 13.2289 20.2471 12.6397 20.2471 12.04C20.2471 11.4403 20.0894 10.8511 19.7898 10.3316C19.4902 9.81206 19.0593 9.38044 18.5402 9.08003V9.00003Z" fill="currentColor"></path></svg>
                                                        </div>
                                                        <div class="absolute bottom-0.5 right-1 lg:bottom-2 lg:right-2.5 rounded-full">
                                                            <p class="typography font-sans-text lg:text-[0.75rem] lg:leading-[1.25rem] text-[0.75rem] leading-[1.25rem] drop-shadow-placeOn">
                                                                {{ $movie->episode_time }}
                                                            </p>
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
                                                <li class="shrink-0"><p class="typography font-sans-text text-[0.75rem] leading-[normal] text-secondary-text/80 lowercase line-clamp-1">{{ $movie->view_total }} Lượt xem </p></li>
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </section>
            </div>
            <div class="shrink-0 min-w-0 w-[calc(412/1696*100%)] max-lg:hidden">
                <div class="flex flex-col gap-10 items-center justify-center">
                    <section class="l-section empty:hidden w-full">
                        <ul class="flex">
                            <li class="w-full"><div class="px-3 flex justify-center cursor-pointer items-center min-h-[36px] bg-secondary-bg text-primary" style="clip-path: polygon(0px 0px, 95% 0px, 100% 100%, 0% 100%);"><p class="typography font-sans-text text-[1rem] leading-[1.5rem]">Đề xuất</p></div></li>
                        </ul>
                        <ul class="mt-3">
                            @foreach ($tops as $movie)
                                <li class="py-2">
                                    <div class="a-linkWrapper relative flex gap-3 group/video">
                                        <a class="absolute text-transparent inset-0 z-zContent overflow-hidden"
                                            title="{{$movie->name}}" rel=""
                                            href="{{$movie->getUrl()}}">
                                            {{$movie->name}}
                                        </a>
                                        <div class="relative w-[35%] rounded-md overflow-hidden aspect-[3/2] shrink-0 cursor-pointer">
                                            <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                                <img title="{{$movie->name}}" alt="{{$movie->name}}" data-src="{{$movie->getPosterUrl()}}" class="group-hover/video:scale-[105%] duration-300 lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                            </span>
                                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover/video:opacity-100">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 drop-shadow-placeOn"><path d="M18.5402 9.00003L8.88021 3.46003C8.3575 3.15819 7.76421 3.00006 7.16061 3.00172C6.557 3.00338 5.96459 3.16476 5.44354 3.46947C4.92249 3.77417 4.49137 4.21135 4.19396 4.7366C3.89655 5.26185 3.74345 5.85646 3.75021 6.46003V17.58C3.75021 18.4871 4.11053 19.357 4.75191 19.9983C5.39328 20.6397 6.26317 21 7.17021 21C7.77065 20.999 8.3603 20.8404 8.88021 20.54L18.5402 15C19.0593 14.6996 19.4902 14.268 19.7898 13.7485C20.0894 13.2289 20.2471 12.6397 20.2471 12.04C20.2471 11.4403 20.0894 10.8511 19.7898 10.3316C19.4902 9.81206 19.0593 9.38044 18.5402 9.08003V9.00003Z" fill="currentColor"></path></svg>
                                            </div>
                                        </div>
                                        <div class="grow min-w-0">
                                            <p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] line-clamp-2 cursor-pointer group-hover/video:text-primary">
                                                {{$movie->name}}
                                            </p>
                                            <div class="flex items-center gap-2 text-secondary-text group-hover/video:text-primary-text/80">
                                                <p class="typography font-sans-text text-[0.75rem] leading-[1.25rem]">{{ $movie->created_at->format('d/m/Y') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </section>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
    <script type="text/javascript">
        const URL_POST_RATING = '{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}';
    </script>
    <script type="text/javascript" src="/themes/motchill/js/filmdetail.js?v=1.2.2"></script>
    <script>
        $(document).ready(function() {

            $('.btn-follow').click(function() {
                $.ajax({
                    url: '{{route('thempho.follow')}}',
                    type: 'POST',
                    data: {
                        movie_id: $(this).data('movie_id'),
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.status == 'follow') {
                            alert('Theo dõi phim thành công');
                        } else {
                            alert('Bỏ theo dõi phim thành công');
                        }
                    }, error: function() {
                        alert('Vui lòng đăng nhập để theo dõi phim');
                    }
                });
            });
        })
    </script>
    {!! setting('site_scripts_facebook_sdk') !!}
    <script src="/themes/thempho/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/thempho/player/js/p2p-media-loader-hlsjs.min.js"></script>
    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>
    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active');
            })
            el.classList.add('active');

            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer" style="height: 100%"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        height: "100%",
                        file: "/themes/holy/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function(event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100%; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML =
                            `<iframe src="${link}" frameborder="0" style="width:100% !important; height:100%; position: absolute; top: 0; left: 0;" scrolling="no" allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    height: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function() {
                    if (typeof(Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                        }
                        player.once('play', function() {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function() {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function() {
                    if (typeof(Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>
@endpush

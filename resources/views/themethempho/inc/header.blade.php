@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp

<style>
    .site-logo img{
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        padding: 0;
        border: none;
        display: block;
        object-fit: cover;
    }
</style>

<header class="top-0 w-full h-[--home-header-height] z-zHeader duration-500 sticky bg-transparent flex flex-col justify-center">
    <div class="flex container gap-4 justify-between">
        <div class="flex items-center gap-4">
            <span class="min-[1474px]:hidden h-[36px] max-h-[36px] overflow-hidden">
                <span class="relative">
                <button type="button" class="h-[36px] btn-toggle-sidebar">
                        <div class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-9 h-9 [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full bg-black/40" aria-label="button">
                            <svg data-v-56bd7dfc="" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="20" y1="12" y2="12"></line><line x1="4" x2="20" y1="6" y2="6"></line><line x1="4" x2="20" y1="18" y2="18"></line></svg>
                        </div>
                    </button>
                </span>
            </span>
            <a href="/" class="flex items-center" aria-label="Home">
                <div class="shrink-0">
                    <div class="relative aspect-[437/81] w-[120px] lg:w-[150px]">
                        <span class="site-logo" style="box-sizing:border-box;display:block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:absolute;top:0;left:0;bottom:0;right:0">
                            @if ($logo)
                                {!! $logo !!}
                            @else
                                {!! $brand !!}
                            @endif
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <div class="grow flex items-center gap-8">
            <div class="hidden lg:block">
                <ul class="flex items-center gap-8 lg:pl-10 xl:pl-20">
                    @foreach ($menu as $item)
                        @if (count($item['children']))
                        <li class="outline-none shrink-0 h-[--home-header-height] flex items-center justify-center relative menu-item">
                            <div class="[&amp;_button]:outline-none">
                                <button type="button" aria-haspopup="dialog" aria-expanded="false" aria-controls="radix-:r5i:" data-state="closed">
                                    <div class="outline-none">
                                        <div class="a-linkWrapper py-[5px] text-primary-text duration-300 hover:text-primary relative">
                                            <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" rel="" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                                            <p class="typography font-sans-text text-[1.125rem] leading-[1.5rem] relative outline-none">{{ $item['name'] }}</p>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="absolute hidden menu-item-children rounded border-secondary-text/10 outline-none will-change-[transform,opacity] data-[state=open]:data-[side=top]:animate-slideDownAndFade data-[state=open]:data-[side=bottom]:animate-slideUpAndFade data-[state=open]:data-[side=right]:animate-slideLeftAndFade data-[state=open]:data-[side=left]:animate-slideRightAndFade bg-transparent border-0 shadow-none w-[calc(1100/1920*100vw)] xl:w-[calc(1000/1920*100vw)] max-w-[800px] mr-[-200px]" style="top: 100%; left: -330%">
                                <div class="shadow-[rgba(26,26,29,0.06)_2px_2px_8px_3px] bg-secondary-bg/[98%] rounded-2xl overflow-hidden border border-secondary-text/10 py-4 px-3">
                                    <ul class="grid grid-cols-7 gap-4">
                                        @foreach ($item['children'] as $children)
                                            <li>
                                                <a rel="nofollow noreferrer" href="{{ $children['link'] }}">
                                                    <p class="typography font-sans-text text-[0.75rem] leading-[1.25rem] hover:text-primary duration-200 line-clamp-2">{{ $children['name'] }}</p>
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </li>
                        @else
                        <li class="outline-none shrink-0 h-[--home-header-height] flex items-center justify-center">
                            <div class="[&_button]:outline-none">
                                <div class="outline-none">
                                    <div class="a-linkWrapper py-[5px] text-primary-text duration-300 hover:text-primary relative">
                                        <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{ $item['name'] }}" rel="" href="{{ $item['link'] }}">{{ $item['name'] }}</a>
                                        <p class="typography font-sans-text text-[1.125rem] leading-[1.5rem] relative outline-none">{{ $item['name'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="flex items-center gap-3 xl:gap-4">
            <div class="relative">
                <button type="button" class="btn-search"><div class="outline-none"><div class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-10 h-10 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full" aria-label="button"><svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-5 h-5"><path d="M21.7104 20.2899L18.0004 16.6099C19.4405 14.8143 20.1379 12.5352 19.9492 10.2412C19.7605 7.94721 18.7001 5.81269 16.9859 4.27655C15.2718 2.74041 13.0342 1.91941 10.7333 1.98237C8.43243 2.04534 6.24311 2.98747 4.61553 4.61505C2.98795 6.24263 2.04582 8.43194 1.98286 10.7328C1.9199 13.0337 2.7409 15.2713 4.27704 16.9854C5.81318 18.6996 7.94769 19.76 10.2417 19.9487C12.5357 20.1374 14.8148 19.44 16.6104 17.9999L20.2904 21.6799C20.3834 21.7736 20.494 21.848 20.6158 21.8988C20.7377 21.9496 20.8684 21.9757 21.0004 21.9757C21.1324 21.9757 21.2631 21.9496 21.385 21.8988C21.5068 21.848 21.6174 21.7736 21.7104 21.6799C21.8906 21.4934 21.9914 21.2442 21.9914 20.9849C21.9914 20.7256 21.8906 20.4764 21.7104 20.2899ZM11.0004 17.9999C9.61592 17.9999 8.26255 17.5894 7.1114 16.8202C5.96026 16.051 5.06305 14.9578 4.53324 13.6787C4.00342 12.3996 3.8648 10.9921 4.1349 9.63427C4.40499 8.27641 5.07168 7.02912 6.05065 6.05016C7.02961 5.07119 8.27689 4.4045 9.63476 4.13441C10.9926 3.86431 12.4001 4.00293 13.6792 4.53275C14.9583 5.06256 16.0515 5.95977 16.8207 7.11091C17.5899 8.26206 18.0004 9.61544 18.0004 10.9999C18.0004 12.8564 17.2629 14.6369 15.9501 15.9497C14.6374 17.2624 12.8569 17.9999 11.0004 17.9999Z" fill="currentColor"></path></svg></div></div></button>
                <div class="absolute hidden" id="search-container" style="right: -100px;top: 120%">
                    <div class="w-[260px] bg-secondary-bg border border-secondary-text/10 outline-none shadow-[rgba(26,26,29,0.06)_2px_2px_8px_3px] will-change-[transform,opacity] data-[state=open]:data-[side=top]:animate-slideDownAndFade data-[state=open]:data-[side=bottom]:animate-slideUpAndFade data-[state=open]:data-[side=right]:animate-slideLeftAndFade data-[state=open]:data-[side=left]:animate-slideRightAndFade min-w-[540px] rounded-2xl">
                        <div class="overflow-hidden max-h-[100%] lg:max-h-[80vh] flex flex-col pb-4">
                            <div class="lg:mx-4 py-3 max-lg:container">
                                <div class="relative ">
                                    <form action="/" class="a-input">
                                        <div class="relative">
                                            <input name="search" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-primary-text ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 password-false-no-css bg-[#3A3B3C] error-false-no-css h-[44px] text-[14px] leading-[normal] rounded-full pl-9" placeholder="Nhập từ khoá tìm kiếm" value="">
                                        </div>
                                    </form>
                                    <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 left-3 -translate-y-1/2 w-5 h-5 text-secondary-text">
                                        <path d="M21.7104 20.2899L18.0004 16.6099C19.4405 14.8143 20.1379 12.5352 19.9492 10.2412C19.7605 7.94721 18.7001 5.81269 16.9859 4.27655C15.2718 2.74041 13.0342 1.91941 10.7333 1.98237C8.43243 2.04534 6.24311 2.98747 4.61553 4.61505C2.98795 6.24263 2.04582 8.43194 1.98286 10.7328C1.9199 13.0337 2.7409 15.2713 4.27704 16.9854C5.81318 18.6996 7.94769 19.76 10.2417 19.9487C12.5357 20.1374 14.8148 19.44 16.6104 17.9999L20.2904 21.6799C20.3834 21.7736 20.494 21.848 20.6158 21.8988C20.7377 21.9496 20.8684 21.9757 21.0004 21.9757C21.1324 21.9757 21.2631 21.9496 21.385 21.8988C21.5068 21.848 21.6174 21.7736 21.7104 21.6799C21.8906 21.4934 21.9914 21.2442 21.9914 20.9849C21.9914 20.7256 21.8906 20.4764 21.7104 20.2899ZM11.0004 17.9999C9.61592 17.9999 8.26255 17.5894 7.1114 16.8202C5.96026 16.051 5.06305 14.9578 4.53324 13.6787C4.00342 12.3996 3.8648 10.9921 4.1349 9.63427C4.40499 8.27641 5.07168 7.02912 6.05065 6.05016C7.02961 5.07119 8.27689 4.4045 9.63476 4.13441C10.9926 3.86431 12.4001 4.00293 13.6792 4.53275C14.9583 5.06256 16.0515 5.95977 16.8207 7.11091C17.5899 8.26206 18.0004 9.61544 18.0004 10.9999C18.0004 12.8564 17.2629 14.6369 15.9501 15.9497C14.6374 17.2624 12.8569 17.9999 11.0004 17.9999Z" fill="currentColor"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="shrink-0">
                <div>
                    @if (!auth()->check())
                    <button class="a-button flex items-center btn-toggle-modal-auth justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-10 h-10 bg-primary-btn [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full" aria-label="button"><svg width="15" height="17" viewBox="0 0 15 17" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-pink-500"><path d="M10.3812 10.311C12.6937 10.311 14.6 12.2173 14.6 14.5298V15.311C14.6 16.1548 13.9125 16.811 13.1 16.811H2.09998C1.25623 16.811 0.599976 16.1548 0.599976 15.311V14.5298C0.599976 12.2173 2.47498 10.311 4.78748 10.311C5.69373 10.311 6.09998 10.811 7.59998 10.811C9.06873 10.811 9.47498 10.311 10.3812 10.311ZM13.1 15.311V14.5298C13.1 13.0298 11.8812 11.811 10.3812 11.811C9.91248 11.811 9.19373 12.311 7.59998 12.311C5.97498 12.311 5.25623 11.811 4.78748 11.811C3.28748 11.811 2.09998 13.0298 2.09998 14.5298V15.311H13.1ZM7.59998 9.81104C5.09998 9.81104 3.09998 7.81104 3.09998 5.31104C3.09998 2.84229 5.09998 0.811035 7.59998 0.811035C10.0687 0.811035 12.1 2.84229 12.1 5.31104C12.1 7.81104 10.0687 9.81104 7.59998 9.81104ZM7.59998 2.31104C5.94373 2.31104 4.59998 3.68604 4.59998 5.31104C4.59998 6.96729 5.94373 8.31104 7.59998 8.31104C9.22498 8.31104 10.6 6.96729 10.6 5.31104C10.6 3.68604 9.22498 2.31104 7.59998 2.31104Z" fill="currentColor"></path></svg></button>
                    @else
                    <div class="relative">
                        <button type="button" class="btn-toggle-profile-menu">
                            <div class="outline-none">
                                <div class="relative ring-primary rounded-full cursor-pointer data-[state=open]:ring-[2px] lg:w-10 lg:h-10 h-9 w-9">
                                    <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                        <img title="avatar" alt="avatar"src="{{auth()->user()->avatar ??  '/themes/thempho/images/default.jpg'}}" class="rounded-full"
                                            style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                    </span>
                                </div>
                            </div>
                        </button>
                        <div style="top: 110%" class="absolute right-0 hidden" id="profile-menu">
                            <div class="w-[260px] border border-secondary-text/10 outline-none shadow-[rgba(26,26,29,0.06)_2px_2px_8px_3px] will-change-[transform,opacity] data-[state=open]:data-[side=top]:animate-slideDownAndFade data-[state=open]:data-[side=bottom]:animate-slideUpAndFade data-[state=open]:data-[side=right]:animate-slideLeftAndFade data-[state=open]:data-[side=left]:animate-slideRightAndFade rounded-xl bg-primary-comment">
                                <div>
                                    <div class="">
                                        <a href="{{route('thempho.profile')}}" class="flex items-center justify-start gap-4 px-4 hover:bg-secondary-bg py-3">
                                            <span class="relative aspect-[1/1] rounded-full overflow-hidden w-[48px]">
                                                <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                                    <img alt="{{auth()->user()->name}}" class="lozad" data-src="{{auth()->user()->avatar ??  '/themes/thempho/images/default.jpg'}}" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                                </span>
                                            </span>
                                            <div class="flex flex-col gap-1">
                                                <p class="typography font-sans-text text-[1rem] font-semibold leading-[normal]">{{auth()->user()->name}}</p>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="flex flex-col p-4 py-2 px-0">
                                        <div class="w-full">
                                            <a href="{{route('thempho.bookmark')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-primary-btn/60 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M16 2H8.00001C7.20436 2 6.4413 2.31607 5.87869 2.87868C5.31608 3.44129 5.00001 4.20435 5.00001 5V21C4.99931 21.1762 5.04518 21.3495 5.13299 21.5023C5.22079 21.655 5.3474 21.7819 5.50001 21.87C5.65203 21.9578 5.82447 22.004 6.00001 22.004C6.17554 22.004 6.34799 21.9578 6.50001 21.87L12 18.69L17.5 21.87C17.6524 21.9564 17.8248 22.0012 18 22C18.1752 22.0012 18.3476 21.9564 18.5 21.87C18.6526 21.7819 18.7792 21.655 18.867 21.5023C18.9548 21.3495 19.0007 21.1762 19 21V5C19 4.20435 18.6839 3.44129 18.1213 2.87868C17.5587 2.31607 16.7957 2 16 2ZM17 19.27L12.5 16.67C12.348 16.5822 12.1755 16.536 12 16.536C11.8245 16.536 11.652 16.5822 11.5 16.67L7.00001 19.27V5C7.00001 4.73478 7.10536 4.48043 7.2929 4.29289C7.48044 4.10536 7.73479 4 8.00001 4H16C16.2652 4 16.5196 4.10536 16.7071 4.29289C16.8947 4.48043 17 4.73478 17 5V19.27Z" fill="currentColor"></path></svg>
                                                    </span>
                                                    <p class="typography font-sans-text text-[14px]">Bookmark</p>
                                                </div>
                                                <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="w-full">
                                            <a href="{{route('thempho.history')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-primary-btn/60 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M16 14H8C7.73478 14 7.48043 14.1054 7.29289 14.2929C7.10536 14.4804 7 14.7348 7 15C7 15.2652 7.10536 15.5196 7.29289 15.7071C7.48043 15.8946 7.73478 16 8 16H16C16.2652 16 16.5196 15.8946 16.7071 15.7071C16.8946 15.5196 17 15.2652 17 15C17 14.7348 16.8946 14.4804 16.7071 14.2929C16.5196 14.1054 16.2652 14 16 14ZM16 10H10C9.73478 10 9.48043 10.1054 9.29289 10.2929C9.10536 10.4804 9 10.7348 9 11C9 11.2652 9.10536 11.5196 9.29289 11.7071C9.48043 11.8946 9.73478 12 10 12H16C16.2652 12 16.5196 11.8946 16.7071 11.7071C16.8946 11.5196 17 11.2652 17 11C17 10.7348 16.8946 10.4804 16.7071 10.2929C16.5196 10.1054 16.2652 10 16 10ZM20 4H17V3C17 2.73478 16.8946 2.48043 16.7071 2.29289C16.5196 2.10536 16.2652 2 16 2C15.7348 2 15.4804 2.10536 15.2929 2.29289C15.1054 2.48043 15 2.73478 15 3V4H13V3C13 2.73478 12.8946 2.48043 12.7071 2.29289C12.5196 2.10536 12.2652 2 12 2C11.7348 2 11.4804 2.10536 11.2929 2.29289C11.1054 2.48043 11 2.73478 11 3V4H9V3C9 2.73478 8.89464 2.48043 8.70711 2.29289C8.51957 2.10536 8.26522 2 8 2C7.73478 2 7.48043 2.10536 7.29289 2.29289C7.10536 2.48043 7 2.73478 7 3V4H4C3.73478 4 3.48043 4.10536 3.29289 4.29289C3.10536 4.48043 3 4.73478 3 5V19C3 19.7956 3.31607 20.5587 3.87868 21.1213C4.44129 21.6839 5.20435 22 6 22H18C18.7956 22 19.5587 21.6839 20.1213 21.1213C20.6839 20.5587 21 19.7956 21 19V5C21 4.73478 20.8946 4.48043 20.7071 4.29289C20.5196 4.10536 20.2652 4 20 4ZM19 19C19 19.2652 18.8946 19.5196 18.7071 19.7071C18.5196 19.8946 18.2652 20 18 20H6C5.73478 20 5.48043 19.8946 5.29289 19.7071C5.10536 19.5196 5 19.2652 5 19V6H7V7C7 7.26522 7.10536 7.51957 7.29289 7.70711C7.48043 7.89464 7.73478 8 8 8C8.26522 8 8.51957 7.89464 8.70711 7.70711C8.89464 7.51957 9 7.26522 9 7V6H11V7C11 7.26522 11.1054 7.51957 11.2929 7.70711C11.4804 7.89464 11.7348 8 12 8C12.2652 8 12.5196 7.89464 12.7071 7.70711C12.8946 7.51957 13 7.26522 13 7V6H15V7C15 7.26522 15.1054 7.51957 15.2929 7.70711C15.4804 7.89464 15.7348 8 16 8C16.2652 8 16.5196 7.89464 16.7071 7.70711C16.8946 7.51957 17 7.26522 17 7V6H19V19Z" fill="currentColor"></path></svg>
                                                    </span>
                                                    <p class="typography font-sans-text text-[14px]">Nhật ký</p>
                                                </div>
                                                <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="w-full">
                                            <a href="{{route('thempho.logout')}}" class="rounded-xl bg-primary-comment cursor-pointer hover:bg-primary-btn/60 h-[52px] lg:h-[48px] px-4 flex items-center justify-between lg:rounded-none">
                                                <div class="flex items-center gap-4">
                                                    <span class="h-10 lg:h-8 w-10 lg:w-8 rounded-lg bg-primary-btn flex items-center justify-center">
                                                        <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" font-size="18"><path d="M12.59 13L10.29 15.29C10.1963 15.3829 10.1219 15.4935 10.0711 15.6154C10.0203 15.7373 9.9942 15.868 9.9942 16C9.9942 16.132 10.0203 16.2627 10.0711 16.3846C10.1219 16.5064 10.1963 16.617 10.29 16.71C10.383 16.8037 10.4936 16.8781 10.6154 16.9289C10.7373 16.9796 10.868 17.0058 11 17.0058C11.132 17.0058 11.2627 16.9796 11.3846 16.9289C11.5064 16.8781 11.617 16.8037 11.71 16.71L15.71 12.71C15.801 12.6149 15.8724 12.5027 15.92 12.38C16.02 12.1365 16.02 11.8634 15.92 11.62C15.8724 11.4972 15.801 11.3851 15.71 11.29L11.71 7.28998C11.6168 7.19674 11.5061 7.12278 11.3842 7.07232C11.2624 7.02186 11.1319 6.99589 11 6.99589C10.8681 6.99589 10.7376 7.02186 10.6158 7.07232C10.4939 7.12278 10.3832 7.19674 10.29 7.28998C10.1968 7.38322 10.1228 7.49391 10.0723 7.61573C10.0219 7.73755 9.99591 7.86812 9.99591 7.99998C9.99591 8.13184 10.0219 8.26241 10.0723 8.38423C10.1228 8.50605 10.1968 8.61674 10.29 8.70998L12.59 11H3C2.73478 11 2.48043 11.1053 2.29289 11.2929C2.10536 11.4804 2 11.7348 2 12C2 12.2652 2.10536 12.5195 2.29289 12.7071C2.48043 12.8946 2.73478 13 3 13H12.59ZM12 1.99998C10.1311 1.99163 8.29724 2.50719 6.70647 3.48817C5.11569 4.46915 3.83165 5.87629 3 7.54998C2.88065 7.78867 2.86101 8.065 2.94541 8.31818C3.0298 8.57135 3.21131 8.78063 3.45 8.89998C3.68869 9.01932 3.96502 9.03896 4.2182 8.95457C4.47137 8.87018 4.68065 8.68867 4.8 8.44998C5.43219 7.1733 6.39383 6.0886 7.58555 5.30797C8.77727 4.52733 10.1558 4.0791 11.5788 4.00957C13.0017 3.94004 14.4174 4.25175 15.6795 4.91249C16.9417 5.57322 18.0045 6.55901 18.7581 7.76797C19.5118 8.97694 19.9289 10.3652 19.9664 11.7894C20.0039 13.2135 19.6605 14.6218 18.9715 15.8688C18.2826 17.1158 17.2731 18.1561 16.0475 18.8824C14.8219 19.6087 13.4246 19.9945 12 20C10.5089 20.0064 9.04615 19.5923 7.77969 18.8052C6.51323 18.0181 5.49435 16.8899 4.84 15.55C4.72065 15.3113 4.51137 15.1298 4.2582 15.0454C4.00502 14.961 3.72869 14.9806 3.49 15.1C3.25131 15.2193 3.0698 15.4286 2.98541 15.6818C2.90101 15.935 2.92065 16.2113 3.04 16.45C3.83283 18.0455 5.03752 19.4002 6.52947 20.374C8.02142 21.3478 9.74645 21.9054 11.5261 21.989C13.3058 22.0726 15.0755 21.6792 16.6521 20.8495C18.2288 20.0198 19.5552 18.784 20.4941 17.2698C21.433 15.7556 21.9503 14.0181 21.9925 12.237C22.0347 10.4558 21.6003 8.69577 20.7342 7.13881C19.8682 5.58185 18.6018 4.28454 17.0663 3.38108C15.5307 2.47762 13.7816 2.00081 12 1.99998Z" fill="currentColor"></path></svg>
                                                    </span>
                                                    <p class="typography font-sans-text text-[14px]">Đăng xuất</p>
                                                </div>
                                                <button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full min-w-8" aria-label="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg></button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
<div class="fixed inset-0 duration-300 bg-black/80 hidden min-[1474px]:hidden sidebar-mobile" style="pointer-events: auto;z-index: 100;"></div>
<aside class="hidden min-[1474px]:hidden sidebar-mobile">
    <div class="fixed top-1/2 z-zDialog -translate-y-1/2 w-[90vw] duration-300 left-0 translate-x-0" style="z-index: 100;">
        <div class="w-full bg-black p-0 overflow-y-auto scrollbar-hidden pb-4 h-screen">
            <div class="fixed z-0 top-0 left-0 w-full bg-black flex items-center justify-between p-4 px-2 border-b border-white/10"><button class="btn-toggle-sidebar a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-primary-btn [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full" aria-label="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 -ml-0.5"><path d="M11.29 11.9999L14.83 8.45995C15.0163 8.27259 15.1208 8.01913 15.1208 7.75495C15.1208 7.49076 15.0163 7.23731 14.83 7.04995C14.737 6.95622 14.6264 6.88183 14.5046 6.83106C14.3827 6.78029 14.252 6.75415 14.12 6.75415C13.988 6.75415 13.8573 6.78029 13.7354 6.83106C13.6136 6.88183 13.503 6.95622 13.41 7.04995L9.17 11.2899C9.07628 11.3829 9.00188 11.4935 8.95111 11.6154C8.90035 11.7372 8.87421 11.8679 8.87421 11.9999C8.87421 12.132 8.90035 12.2627 8.95111 12.3845C9.00188 12.5064 9.07628 12.617 9.17 12.7099L13.41 16.9999C13.5034 17.0926 13.6143 17.166 13.7361 17.2157C13.8579 17.2655 13.9884 17.2907 14.12 17.2899C14.2516 17.2907 14.3821 17.2655 14.5039 17.2157C14.6257 17.166 14.7366 17.0926 14.83 16.9999C15.0163 16.8126 15.1208 16.5591 15.1208 16.2949C15.1208 16.0308 15.0163 15.7773 14.83 15.5899L11.29 11.9999Z" fill="currentColor"></path></svg></button><p class="typography font-sans-text text-[1rem] leading-[1.5rem] font-semibold">Menu</p><span class="w-8"></span></div>
            <div class="flex flex-col gap-2 px-2 mt-[86px]">
                @foreach ($menu as $item)
                    @if (count($item['children']))
                    <div class="bg-primary-comment px-4 py-1 rounded-xl hover:bg-primary-btn/60 group-menuItem">
                        <div class="flex items-center h-[52px] justify-between toggle-dropdown-menu">
                            <p class="typography font-sans-text text-[1rem] leading-[1.5rem] w-full h-full grow flex items-center hover:text-primary cursor-pointer gap-2">
                                {{ $item['name'] }}
                            </p>
                            <span class="!min-w-8 !w-8"><button class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-transparent hover:bg-primary-btn-hover text-primary-text rounded-full" aria-label="button"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg></button></span>
                        </div>
                        <div class="dropdown-menu hidden">
                            <div class="flex flex-col border-t border-white/10 px-4 py-2">
                                @foreach ($item['children'] as $children)
                                    <div class="flex items-center gap-2 hover:text-primary">
                                        <a class="typography font-sans-text text-[1rem] leading-[1.5rem] py-2" href="{{ $children['link'] }}">
                                            {{ $children['name'] }}
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="bg-primary-comment px-4 py-1 rounded-xl hover:bg-primary-btn/60">
                        <div class="flex items-center h-[52px] justify-between">
                            <a href="{{ $item['link'] }}" class="typography font-sans-text text-[1rem] leading-[1.5rem] w-full h-full grow flex items-center hover:text-primary cursor-pointer gap-2">
                                <span class="typography font-sans-text text-[1rem] leading-[1.5rem] w-full h-full grow flex items-center hover:text-primary cursor-pointer gap-2">
                                    {{ $item['name'] }}
                                </span>
                            </a>
                        </div>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</aside>

<div id="search-container-mobile" class="hidden">
    <div class="fixed inset-0 z-zDialog flex justify-center items-start duration-300 bg-black/75">
        <div class="ReactModal__Content ReactModal__Content--after-open relative outline-none rounded-none w-full h-full duration-300 bg-primary-bg">
            <div class="flex flex-col h-full">
                <div class="py-4 relative">
                    <p class="typography font-sans-text text-[1rem] leading-[1.5rem] text-center font-medium">Tìm kiếm</p>
                    <button class="a-button btn-search flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-8 h-8 bg-primary-btn [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover text-primary-text rounded-full absolute right-3 top-1/2 -translate-y-1/2" aria-label="button"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7.40994 5.99994L11.7099 1.70994C11.8982 1.52164 12.004 1.26624 12.004 0.999941C12.004 0.73364 11.8982 0.478245 11.7099 0.289941C11.5216 0.101638 11.2662 -0.00415039 10.9999 -0.00415039C10.7336 -0.00415039 10.4782 0.101638 10.2899 0.289941L5.99994 4.58994L1.70994 0.289941C1.52164 0.101638 1.26624 -0.00415039 0.999939 -0.00415039C0.733637 -0.00415039 0.478243 0.101638 0.289939 0.289941C0.101635 0.478245 -0.00415277 0.73364 -0.00415277 0.999941C-0.00415278 1.26624 0.101635 1.52164 0.289939 1.70994L4.58994 5.99994L0.289939 10.2899C0.196211 10.3829 0.121816 10.4935 0.0710478 10.6154C0.0202791 10.7372 -0.00585938 10.8679 -0.00585938 10.9999C-0.00585938 11.132 0.0202791 11.2627 0.0710478 11.3845C0.121816 11.5064 0.196211 11.617 0.289939 11.7099C0.382902 11.8037 0.493503 11.8781 0.615362 11.9288C0.737221 11.9796 0.867927 12.0057 0.999939 12.0057C1.13195 12.0057 1.26266 11.9796 1.38452 11.9288C1.50638 11.8781 1.61698 11.8037 1.70994 11.7099L5.99994 7.40994L10.2899 11.7099C10.3829 11.8037 10.4935 11.8781 10.6154 11.9288C10.7372 11.9796 10.8679 12.0057 10.9999 12.0057C11.132 12.0057 11.2627 11.9796 11.3845 11.9288C11.5064 11.8781 11.617 11.8037 11.7099 11.7099C11.8037 11.617 11.8781 11.5064 11.9288 11.3845C11.9796 11.2627 12.0057 11.132 12.0057 10.9999C12.0057 10.8679 11.9796 10.7372 11.9288 10.6154C11.8781 10.4935 11.8037 10.3829 11.7099 10.2899L7.40994 5.99994Z" fill="currentColor"></path></svg></button>
                </div>
                <div class="overflow-hidden max-h-[100%] lg:max-h-[80vh] flex flex-col pb-4">
                    <div class="lg:mx-4 py-3 max-lg:container">
                        <form action="/" class="relative ">
                            <div class="a-input">
                                <div class="relative">
                                    <input name="search" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-primary-text ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 password-false-no-css bg-[#3A3B3C] error-false-no-css h-[44px] text-[14px] leading-[normal] rounded-full pl-9" placeholder="Nhập từ khoá tìm kiếm" value="">
                                </div>
                            </div>
                            <svg width="1em" height="1em" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 left-3 -translate-y-1/2 w-5 h-5 text-secondary-text"><path d="M21.7104 20.2899L18.0004 16.6099C19.4405 14.8143 20.1379 12.5352 19.9492 10.2412C19.7605 7.94721 18.7001 5.81269 16.9859 4.27655C15.2718 2.74041 13.0342 1.91941 10.7333 1.98237C8.43243 2.04534 6.24311 2.98747 4.61553 4.61505C2.98795 6.24263 2.04582 8.43194 1.98286 10.7328C1.9199 13.0337 2.7409 15.2713 4.27704 16.9854C5.81318 18.6996 7.94769 19.76 10.2417 19.9487C12.5357 20.1374 14.8148 19.44 16.6104 17.9999L20.2904 21.6799C20.3834 21.7736 20.494 21.848 20.6158 21.8988C20.7377 21.9496 20.8684 21.9757 21.0004 21.9757C21.1324 21.9757 21.2631 21.9496 21.385 21.8988C21.5068 21.848 21.6174 21.7736 21.7104 21.6799C21.8906 21.4934 21.9914 21.2442 21.9914 20.9849C21.9914 20.7256 21.8906 20.4764 21.7104 20.2899ZM11.0004 17.9999C9.61592 17.9999 8.26255 17.5894 7.1114 16.8202C5.96026 16.051 5.06305 14.9578 4.53324 13.6787C4.00342 12.3996 3.8648 10.9921 4.1349 9.63427C4.40499 8.27641 5.07168 7.02912 6.05065 6.05016C7.02961 5.07119 8.27689 4.4045 9.63476 4.13441C10.9926 3.86431 12.4001 4.00293 13.6792 4.53275C14.9583 5.06256 16.0515 5.95977 16.8207 7.11091C17.5899 8.26206 18.0004 9.61544 18.0004 10.9999C18.0004 12.8564 17.2629 14.6369 15.9501 15.9497C14.6374 17.2624 12.8569 17.9999 11.0004 17.9999Z" fill="currentColor"></path></svg>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-auth" class="hidden">
    <div class="fixed inset-0 bg-black/75 z-zDialog flex items-end justify-center duration-300 md:items-center opacity-100 !z-[calc(var(--zDialog)+2)]">
        <div class="ReactModal__Content ReactModal__Content--after-open relative duration-300 w-full min-w-[200px] h-[90vh] supports-[height:90dvh]:h-[90dvh] outline-none md:w-auto md:translate-y-0 translate-y-0 overflow-hidden bg-secondary-bg rounded-2xl max-md:mb-8 max-md:mx-4 scrollbar-hidden max-md:max-h-[520px] md:h-[554px]">
            <div class="flex h-full text-black-b500">
                <div class="relative shrink min-w-0 w-full sm:rounded-md lg:rounded-none">
                    <div class="w-full pt-[66px] h-full overflow-x-hidden overflow-y-auto scrollbar-hidden">
                        <div class="p-[1px] h-full pb-5 mx-0 sm:pt-3 max-sm:px-6 sm:mx-16 lg:mx-16">
                            <div class="px-1 relative w-full md:w-[384px]">
                                <div class="absolute inset-x-0 top-0 duration-200 w-full block translate-x-0 opacity-1 pb-12" style="transition-duration: 250ms;">
                                    <p class="typography font-sans-text text-[2rem] leading-12 text-primary-text text-center font-bold">Đăng nhập</p>
                                    <div class="mt-7 flex flex-col gap-4">
                                        <a href="{{route('loginGoogle')}}" class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 ring-[1px] ring-white rounded-full h-12 gap-2 px-6 font-semibold relative uppercase text-[0.8125rem] leading-4" aria-label="button-icon">
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="absolute top-1/2 -translate-y-1/2 left-4"><g clip-path="url(#clip0_781_4801)"><path d="M11.9995 6.16667C13.3468 6.16667 14.5838 6.62794 15.5714 7.39505L18.6023 4.50341C16.8401 2.94996 14.5333 2 11.9995 2C8.15979 2 4.83002 4.1666 3.1543 7.34154L6.52466 10.0023C7.3411 7.76614 9.48069 6.16667 11.9995 6.16667Z" fill="#F44336"></path><path d="M21.9134 13.2516C21.9655 12.8419 22 12.424 22 12.0001C22 11.2852 21.9219 10.5891 21.7794 9.91675H12V14.0834H17.4052C16.9679 15.2199 16.1894 16.1815 15.1983 16.8496L18.5812 19.5203C20.3745 17.9463 21.6016 15.742 21.9134 13.2516Z" fill="#2196F3"></path><path d="M6.16667 12C6.16667 11.2971 6.29738 10.6264 6.5252 10.0023L3.15484 7.34155C2.42028 8.73336 2 10.3168 2 12C2 13.6644 2.41255 15.2303 3.13185 16.6108L6.50648 13.9466C6.29036 13.337 6.16667 12.6837 6.16667 12Z" fill="#FFC107"></path><path d="M12.001 17.8333C9.46302 17.8333 7.30965 16.2095 6.50745 13.9465L3.13281 16.6107C4.80034 19.8111 8.14248 21.9999 12.001 21.9999C14.5241 21.9999 16.8249 21.0626 18.5822 19.5202L15.1993 16.8495C14.2853 17.4657 13.1913 17.8333 12.001 17.8333Z" fill="#00B060"></path><path opacity="0.1" d="M11.9994 21.7917C9.05638 21.7917 6.41004 20.5774 4.53906 18.6428C6.37057 20.6982 9.02983 22.0001 11.9994 22.0001C14.9416 22.0001 17.5788 20.7239 19.4062 18.7007C17.5408 20.6039 14.9145 21.7917 11.9994 21.7917Z" fill="black"></path><path opacity="0.1" d="M12 13.875V14.0833H17.4052L17.4896 13.875H12Z" fill="black"></path><path d="M21.9961 12.1226C21.9968 12.0816 22.0008 12.0413 22.0008 12.0001C22.0008 11.9885 21.9989 11.9772 21.9989 11.9656C21.9983 12.0181 21.9957 12.0699 21.9961 12.1226Z" fill="#E6E6E6"></path><path opacity="0.2" d="M12 9.91675V10.1251H21.8213C21.8082 10.0563 21.7939 9.98501 21.7794 9.91675H12Z" fill="white"></path><path d="M21.7794 9.91667H12V14.0833H17.4052C16.5646 16.268 14.481 17.8333 12 17.8333C8.77836 17.8333 6.16667 15.2216 6.16667 12C6.16667 8.77831 8.77836 6.16667 12 6.16667C13.1682 6.16667 14.2449 6.52555 15.1571 7.11724C15.2967 7.20798 15.4408 7.29317 15.5719 7.39505L18.6029 4.50341L18.5345 4.45082C16.7808 2.93089 14.5029 2 12 2C6.47713 2 2 6.47713 2 12C2 17.5228 6.47713 22 12 22C17.0981 22 21.2962 18.1823 21.9134 13.2515C21.9655 12.8418 22 12.4239 22 12C22 11.2851 21.9219 10.589 21.7794 9.91667Z" fill="url(#paint0_linear_781_4801)"></path><path opacity="0.1" d="M15.1564 6.90892C14.2443 6.31723 13.1676 5.95834 11.9993 5.95834C8.77771 5.95834 6.16602 8.56999 6.16602 11.7917C6.16602 11.8268 6.16649 11.8543 6.1671 11.8893C6.2233 8.71627 8.81286 6.16668 11.9993 6.16668C13.1676 6.16668 14.2443 6.52556 15.1564 7.11725C15.2961 7.20799 15.4401 7.29318 15.5713 7.39506L18.6022 4.50342L15.5713 7.18673C15.4401 7.08485 15.2961 6.99965 15.1564 6.90892Z" fill="black"></path><path opacity="0.2" d="M12 2.20833C14.4792 2.20833 16.7358 3.12366 18.4827 4.618L18.6029 4.50341L18.5112 4.42356C16.7575 2.90363 14.5029 2 12 2C6.47713 2 2 6.47713 2 12C2 12.0351 2.00488 12.0691 2.00524 12.1042C2.0617 6.62987 6.51228 2.20833 12 2.20833Z" fill="white"></path></g><defs><linearGradient id="paint0_linear_781_4801" x1="2" y1="12" x2="22" y2="12" gradientUnits="userSpaceOnUse"><stop stop-color="white" stop-opacity="0.2"></stop><stop offset="1" stop-color="white" stop-opacity="0"></stop></linearGradient><clipPath id="clip0_781_4801"><rect width="20" height="20" fill="white" transform="translate(2 2)"></rect></clipPath></defs></svg>
                                            <span>Tiếp tục với google</span>
                                        </a>
                                        <div>
                                            <p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] text-center text-primary-text">Hoặc</p>
                                        </div>
                                        <form class="flex flex-col gap-3" id="login-form">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="a-input">
                                                <div class="relative">
                                                    <input id="email_lg" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-[0.875rem] text-primary-text leading-[0.875rem] ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 password-false-no-css bg-[#3A3B3C] error-false-no-css rounded-full h-11" placeholder="Tên đăng nhập" value="">
                                                </div>
                                            </div>
                                            <div class="a-input">
                                                <div class="relative">
                                                    <input id="password_lg" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-[0.875rem] text-primary-text leading-[0.875rem] ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 pr-9 bg-[#3A3B3C] error-false-no-css rounded-full h-11" type="password" placeholder="Mật khẩu" value="">
                                                    <div class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-auto h-auto lg:hover:bg-black-b100/30 text-primary-text rounded-md absolute bg-transparent p-2 right-1 top-1/2 -translate-y-1/2 cursor-pointer" aria-label="button">
                                                        <svg stroke="currentColor" fill="currentColor" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary-text opacity-40" stroke-width="1.5"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-hover rounded-full h-12 gap-2 px-6 mt-2 text-[0.8125rem] font-semibold leading-4 uppercase" aria-label="button-icon" type="submit">Đăng nhập</button>
                                        </form>
                                    </div>
                                    <div class="flex justify-center mt-5 sm:mt-10">
                                        <button class="typography btn-auth-register font-sans-text text-[1rem] leading-[1.5rem] cursor-pointer text-primary-text font-semibold hover:underline">
                                            Chưa có tài khoản? <span class="text-primary">Đăng ký</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="a-button flex btn-toggle-modal-auth items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-auto h-auto px-3 py-3 [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover rounded-full [&amp;:not(:disabled)]:hover:bg-black-b100/20 absolute top-4 right-4 bg-[#525252] hover:!bg-[#3e3e3e] text-primary-text" aria-label="button"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[currentColor] w-3 h-3"><path d="M7.40994 5.99994L11.7099 1.70994C11.8982 1.52164 12.004 1.26624 12.004 0.999941C12.004 0.73364 11.8982 0.478245 11.7099 0.289941C11.5216 0.101638 11.2662 -0.00415039 10.9999 -0.00415039C10.7336 -0.00415039 10.4782 0.101638 10.2899 0.289941L5.99994 4.58994L1.70994 0.289941C1.52164 0.101638 1.26624 -0.00415039 0.999939 -0.00415039C0.733637 -0.00415039 0.478243 0.101638 0.289939 0.289941C0.101635 0.478245 -0.00415277 0.73364 -0.00415277 0.999941C-0.00415278 1.26624 0.101635 1.52164 0.289939 1.70994L4.58994 5.99994L0.289939 10.2899C0.196211 10.3829 0.121816 10.4935 0.0710478 10.6154C0.0202791 10.7372 -0.00585938 10.8679 -0.00585938 10.9999C-0.00585938 11.132 0.0202791 11.2627 0.0710478 11.3845C0.121816 11.5064 0.196211 11.617 0.289939 11.7099C0.382902 11.8037 0.493503 11.8781 0.615362 11.9288C0.737221 11.9796 0.867927 12.0057 0.999939 12.0057C1.13195 12.0057 1.26266 11.9796 1.38452 11.9288C1.50638 11.8781 1.61698 11.8037 1.70994 11.7099L5.99994 7.40994L10.2899 11.7099C10.3829 11.8037 10.4935 11.8781 10.6154 11.9288C10.7372 11.9796 10.8679 12.0057 10.9999 12.0057C11.132 12.0057 11.2627 11.9796 11.3845 11.9288C11.5064 11.8781 11.617 11.8037 11.7099 11.7099C11.8037 11.617 11.8781 11.5064 11.9288 11.3845C11.9796 11.2627 12.0057 11.132 12.0057 10.9999C12.0057 10.8679 11.9796 10.7372 11.9288 10.6154C11.8781 10.4935 11.8037 10.3829 11.7099 10.2899L7.40994 5.99994Z" fill="currentColor"></path></svg></button>
        </div>
    </div>
</div>

<div id="modal-auth-register" class="hidden">
    <div class="fixed inset-0 bg-black/75 z-zDialog flex items-end justify-center duration-300 md:items-center opacity-100 !z-[calc(var(--zDialog)+2)]">
        <div class="ReactModal__Content ReactModal__Content--after-open relative duration-300 w-full min-w-[200px] h-[90vh] supports-[height:90dvh]:h-[90dvh] outline-none md:w-auto md:translate-y-0 translate-y-0 overflow-hidden bg-secondary-bg rounded-2xl max-md:mb-8 max-md:mx-4 scrollbar-hidden max-md:max-h-[420px] md:h-[468px]">
            <div class="flex h-full text-black-b500">
                <div class="relative shrink min-w-0 w-full sm:rounded-md lg:rounded-none">
                    <div class="w-full pt-[66px] h-full overflow-x-hidden overflow-y-auto scrollbar-hidden">
                        <div class="p-[1px] h-full pb-5 mx-0 sm:pt-3 max-sm:px-6 sm:mx-16 lg:mx-16">
                            <div class="px-1 relative w-full md:w-[384px]">
                                <div class="absolute inset-x-0 top-0 duration-200 w-full block translate-x-0 opacity-1 pb-12" style="transition-duration: 250ms;">
                                    <p class="typography font-sans-text text-[2rem] leading-12 text-primary-text text-center font-bold">Đăng ký</p>
                                    <div class="mt-7 flex flex-col gap-4">
                                        <form class="flex flex-col gap-3" id="form-register">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <div class="a-input">
                                                <div class="relative">
                                                    <input id="name_rg" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-[0.875rem] text-primary-text leading-[0.875rem] ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 password-false-no-css bg-[#3A3B3C] error-false-no-css rounded-full h-11" placeholder="Tên" value="">
                                                </div>
                                            </div>
                                            <div class="a-input">
                                                <div class="relative">
                                                    <input id="email_rg" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-[0.875rem] text-primary-text leading-[0.875rem] ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 password-false-no-css bg-[#3A3B3C] error-false-no-css rounded-full h-11" placeholder="Email" value="">
                                                </div>
                                            </div>
                                            <div class="a-input">
                                                <div class="relative">
                                                    <input id="password_rg" class="items-center placeholder:text-primary-text/60 outline-none caret-pink-p500 w-full block text-[0.875rem] text-primary-text leading-[0.875rem] ring-white focus:ring-[1px] px-4 pt-[0.5625rem] pb-[0.625rem] disabled:text-muted disabled:border-border/60 pr-9 bg-[#3A3B3C] error-false-no-css rounded-full h-11" type="password" placeholder="Mật khẩu" value="">
                                                    <div class="a-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-auto h-auto lg:hover:bg-black-b100/30 text-primary-text rounded-md absolute bg-transparent p-2 right-1 top-1/2 -translate-y-1/2 cursor-pointer" aria-label="button">
                                                        <svg stroke="currentColor" fill="currentColor" viewBox="0 0 16 16" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-primary-text opacity-40" stroke-width="1.5"><path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"></path><path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"></path></svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <button class="a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-hover rounded-full h-12 gap-2 px-6 mt-2 text-[0.8125rem] font-semibold leading-4 uppercase" aria-label="button-icon" type="submit">Đăng nhập</button>
                                        </form>
                                    </div>
                                    <div class="flex justify-center mt-5 sm:mt-10">
                                        <button class="typography btn-toggle-modal-auth font-sans-text text-[1rem] leading-[1.5rem] cursor-pointer text-primary-text font-semibold hover:underline">
                                            Đã có tài khoản? <span class="text-primary">Đăng nhập</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="a-button btn-auth-register flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:text-primary-text/40 disabled:cursor-not-allowed w-auto h-auto px-3 py-3 [&amp;:not(:disabled)]:lg:hover:bg-primary-btn-hover rounded-full [&amp;:not(:disabled)]:hover:bg-black-b100/20 absolute top-4 right-4 bg-[#525252] hover:!bg-[#3e3e3e] text-primary-text" aria-label="button"><svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-[currentColor] w-3 h-3"><path d="M7.40994 5.99994L11.7099 1.70994C11.8982 1.52164 12.004 1.26624 12.004 0.999941C12.004 0.73364 11.8982 0.478245 11.7099 0.289941C11.5216 0.101638 11.2662 -0.00415039 10.9999 -0.00415039C10.7336 -0.00415039 10.4782 0.101638 10.2899 0.289941L5.99994 4.58994L1.70994 0.289941C1.52164 0.101638 1.26624 -0.00415039 0.999939 -0.00415039C0.733637 -0.00415039 0.478243 0.101638 0.289939 0.289941C0.101635 0.478245 -0.00415277 0.73364 -0.00415277 0.999941C-0.00415278 1.26624 0.101635 1.52164 0.289939 1.70994L4.58994 5.99994L0.289939 10.2899C0.196211 10.3829 0.121816 10.4935 0.0710478 10.6154C0.0202791 10.7372 -0.00585938 10.8679 -0.00585938 10.9999C-0.00585938 11.132 0.0202791 11.2627 0.0710478 11.3845C0.121816 11.5064 0.196211 11.617 0.289939 11.7099C0.382902 11.8037 0.493503 11.8781 0.615362 11.9288C0.737221 11.9796 0.867927 12.0057 0.999939 12.0057C1.13195 12.0057 1.26266 11.9796 1.38452 11.9288C1.50638 11.8781 1.61698 11.8037 1.70994 11.7099L5.99994 7.40994L10.2899 11.7099C10.3829 11.8037 10.4935 11.8781 10.6154 11.9288C10.7372 11.9796 10.8679 12.0057 10.9999 12.0057C11.132 12.0057 11.2627 11.9796 11.3845 11.9288C11.5064 11.8781 11.617 11.8037 11.7099 11.7099C11.8037 11.617 11.8781 11.5064 11.9288 11.3845C11.9796 11.2627 12.0057 11.132 12.0057 10.9999C12.0057 10.8679 11.9796 10.7372 11.9288 10.6154C11.8781 10.4935 11.8037 10.3829 11.7099 10.2899L7.40994 5.99994Z" fill="currentColor"></path></svg></button>
        </div>
    </div>
</div>

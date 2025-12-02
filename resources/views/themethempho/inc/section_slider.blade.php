<section class="l-section empty:hidden mt-8 lg:mt-[4rem]">
    <div class="t-shortVideoList overflow-hidden">
        <div class="m-sectionTitle flex items-center justify-between gap-3 pb-4 sm:pb-8 container">
            <div class="a-linkWrapper relative">
                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{$item['label']}}" rel="" href="{{$item['link']}}">{{$item['label']}}</a>
                <h3 class="typography font-sans-text lg:text-[1.75rem] lg:leading-[2.5rem] sm:text-[1.5rem] sm:leading-[1.75rem] text-[1.25rem] leading-[1.75rem] text-primary font-bold">
                    {{$item['label']}}
                </h3>
            </div>
            <div class="a-linkWrapper relative m-seeAllText flex items-center gap-2 p-2 -mr-2">
                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" target="_self" title="tất cả" rel="" href="{{$item['link']}}">tất cả</a>
                <p class="typography font-sans-text text-[1rem] leading-[1.5rem] text-primary normal-case">tất cả</p>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
            </div>
        </div>
        <div class="container">
            <div class="relative">
                <div class="swiper swiper-hot max-lg:!overflow-visible">
                    <div class="swiper-wrapper">
                        @foreach ($item['data'] as $movie)
                        <div class="m-videoCard group/shortVideoCard relative w-full cursor-pointer swiper-slide">
                            <div class="a-linkWrapper relative">
                                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{$movie->name}}" rel="" href="{{$movie->getUrl()}}">
                                    {{$movie->name}}
                                </a>
                                <div class="relative w-full h-full rounded-lg overflow-hidden aspect-[202/269]">
                                    <div class="absolute group-hover/shortVideoCard:scale-[1.2] inset-0 duration-300">
                                        <div class="relative w-full h-full">
                                            <div class="absolute inset-0">
                                                <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                                    <img title="{{$movie->name}}" class="lozad" alt="{{$movie->name}}" data-src="{{$movie->getThumbUrl()}}" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="absolute inset-0 bg-[linear-gradient(0deg,rgba(0,0,0,0.5)_0%,rgba(12,11,17,0)_12.48%)]"></div>
                                </div>
                                <h3 class="typography font-sans-text lg:text-[1rem] text-[0.875rem] leading-[1.25rem] mt-2 line-clamp-2 lg:leading-[20px] text-primary-text/80 pr-3 duration-200 lg:pr-4 group-hover/shortVideoCard:text-primary">{{$movie->name}}</h3>
                            </div>
                            <div class="flex items-center justify-between">
                                <p class="typography font-sans-text text-[0.75rem] mt-1 leading-[normal] text-secondary-text/80 lowercase">{{$movie->view_total}} Lượt xem</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <button class="a-button navigation-prev-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:cursor-not-allowed bg-primary hover:bg-primary-hover rounded-full text-primary-text disabled:text-primary-text disabled:opacity-50 w-10 h-10 absolute max-lg:hidden short-button-prev z-zContent top-1/2 left-0 -translate-x-1/2 -translate-y-1/2 swiper-button-disabled" aria-label="slide left"><svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0.0799999 7.38006C0.127594 7.50281 0.19896 7.61495 0.290001 7.71006L5.29 12.7101C5.38324 12.8033 5.49393 12.8773 5.61575 12.9277C5.73757 12.9782 5.86814 13.0042 6 13.0042C6.2663 13.0042 6.5217 12.8984 6.71 12.7101C6.80324 12.6168 6.8772 12.5061 6.92766 12.3843C6.97812 12.2625 7.00409 12.1319 7.00409 12.0001C7.00409 11.7338 6.8983 11.4784 6.71 11.2901L3.41 8.00006L11 8.00006C11.2652 8.00006 11.5196 7.8947 11.7071 7.70717C11.8946 7.51963 12 7.26528 12 7.00006C12 6.73484 11.8946 6.48049 11.7071 6.29295C11.5196 6.10542 11.2652 6.00006 11 6.00006L3.41 6.00006L6.71 2.71006C6.80373 2.61709 6.87812 2.5065 6.92889 2.38464C6.97966 2.26278 7.0058 2.13207 7.0058 2.00006C7.0058 1.86805 6.97966 1.73734 6.92889 1.61548C6.87812 1.49362 6.80373 1.38302 6.71 1.29006C6.61704 1.19633 6.50644 1.12194 6.38458 1.07117C6.26272 1.0204 6.13201 0.994261 6 0.994261C5.86799 0.994261 5.73728 1.0204 5.61542 1.07117C5.49356 1.12194 5.38296 1.19633 5.29 1.29006L0.290001 6.29006C0.19896 6.38516 0.127594 6.49731 0.0799999 6.62006C-0.0200176 6.86352 -0.0200176 7.1366 0.0799999 7.38006Z" fill="currentColor"></path></svg></button>
                <button class="a-button navigation-next-button flex items-center justify-center [&amp;:not(:disabled)]:active:scale-95 button-icon-base disabled:bg-primary-btn/40 disabled:cursor-not-allowed bg-primary hover:bg-primary-hover rounded-full text-primary-text disabled:text-primary-text disabled:opacity-50 w-10 h-10 absolute max-lg:hidden short-button-next z-zContent top-1/2 right-0 translate-x-1/2 -translate-y-1/2" aria-label="slide right"><svg width="12" height="13" viewBox="0 0 12 13" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11.92 5.95008C11.8724 5.82733 11.801 5.71518 11.71 5.62008L6.71 0.620077C6.61676 0.526838 6.50607 0.452878 6.38425 0.402417C6.26243 0.351957 6.13186 0.325985 6 0.325985C5.7337 0.325985 5.4783 0.431773 5.29 0.620077C5.19676 0.713315 5.1228 0.824005 5.07234 0.945827C5.02188 1.06765 4.99591 1.19822 4.99591 1.33008C4.99591 1.59638 5.1017 1.85177 5.29 2.04008L8.59 5.33008H1C0.734784 5.33008 0.48043 5.43543 0.292893 5.62297C0.105357 5.81051 0 6.06486 0 6.33008C0 6.59529 0.105357 6.84965 0.292893 7.03718C0.48043 7.22472 0.734784 7.33008 1 7.33008H8.59L5.29 10.6201C5.19627 10.713 5.12188 10.8236 5.07111 10.9455C5.02034 11.0674 4.9942 11.1981 4.9942 11.3301C4.9942 11.4621 5.02034 11.5928 5.07111 11.7147C5.12188 11.8365 5.19627 11.9471 5.29 12.0401C5.38296 12.1338 5.49356 12.2082 5.61542 12.259C5.73728 12.3097 5.86799 12.3359 6 12.3359C6.13201 12.3359 6.26272 12.3097 6.38458 12.259C6.50644 12.2082 6.61704 12.1338 6.71 12.0401L11.71 7.04008C11.801 6.94497 11.8724 6.83283 11.92 6.71008C12.02 6.46662 12.02 6.19354 11.92 5.95008Z" fill="currentColor"></path></svg></button>
            </div>
        </div>
    </div>
</section>

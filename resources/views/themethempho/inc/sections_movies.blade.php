<section class="l-section empty:hidden mt-8 lg:mt-[4rem] container">
    <div>
        <div class="m-sectionTitle flex items-center justify-between gap-3 pb-4 sm:pb-8">
            <div class="a-linkWrapper relative">
                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="{{ $item['label'] }}" rel="" href="{{ $item['link'] }}">{{ $item['label'] }}</a>
                <h3 class="typography font-sans-text lg:text-[1.75rem] lg:leading-[2.5rem] sm:text-[1.5rem] sm:leading-[1.75rem] text-[1.25rem] leading-[1.75rem] text-primary font-bold">{{ $item['label'] }}</h3>
            </div>
            <div class="a-linkWrapper relative m-seeAllText flex items-center gap-2 p-2 -mr-2">
                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" target="_self" title="tất cả" rel="" href="{{ $item['link'] }}">tất cả</a>
                <p class="typography font-sans-text text-[1rem] leading-[1.5rem] text-primary normal-case">tất cả</p>
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="text-primary"><path d="M14.83 11.2899L10.59 7.04995C10.497 6.95622 10.3864 6.88183 10.2646 6.83106C10.1427 6.78029 10.012 6.75415 9.88 6.75415C9.74799 6.75415 9.61729 6.78029 9.49543 6.83106C9.37357 6.88183 9.26297 6.95622 9.17 7.04995C8.98375 7.23731 8.87921 7.49076 8.87921 7.75495C8.87921 8.01913 8.98375 8.27259 9.17 8.45995L12.71 11.9999L9.17 15.5399C8.98375 15.7273 8.87921 15.9808 8.87921 16.2449C8.87921 16.5091 8.98375 16.7626 9.17 16.9499C9.26344 17.0426 9.37426 17.116 9.4961 17.1657C9.61794 17.2155 9.7484 17.2407 9.88 17.2399C10.0116 17.2407 10.1421 17.2155 10.2639 17.1657C10.3857 17.116 10.4966 17.0426 10.59 16.9499L14.83 12.7099C14.9237 12.617 14.9981 12.5064 15.0489 12.3845C15.0997 12.2627 15.1258 12.132 15.1258 11.9999C15.1258 11.8679 15.0997 11.7372 15.0489 11.6154C14.9981 11.4935 14.9237 11.3829 14.83 11.2899Z" fill="currentColor"></path></svg>
            </div>
        </div>
    </div>
    <div>
        <ul class="grid gap-y-6 gap-x-2 grid-cols-2 md:gap-4 lg:gap-x-4 lg:gap-y-8 lg:grid-cols-5">
            @foreach ($item['data'] as $key => $movie)
                @include('themes::themethempho.inc.sections_movies_item')
            @endforeach
        </ul>
    </div>
    <div class="flex justify-center mt-5">
        <button onclick="window.location.href='{{ $item['link'] }}'" class="a-button justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 hover:bg-primary-btn-hover rounded-full h-8 text-[0.875rem] m-videoMore px-4 text-primary-text/50 flex items-center font-normal gap-1.5 bg-primary-btn/80 hover:text-primary-text" aria-label="button-icon">
            <span class="">Hiện thêm</span>
            <svg width="10" height="8" viewBox="0 0 12 8" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M11 1.16994C10.8126 0.983692 10.5592 0.87915 10.295 0.87915C10.0308 0.87915 9.77737 0.983692 9.59001 1.16994L6.00001 4.70994L2.46001 1.16994C2.27265 0.983692 2.0192 0.87915 1.75501 0.87915C1.49082 0.87915 1.23737 0.983692 1.05001 1.16994C0.956281 1.26291 0.881887 1.37351 0.831118 1.49537C0.780349 1.61723 0.754211 1.74793 0.754211 1.87994C0.754211 2.01195 0.780349 2.14266 0.831118 2.26452C0.881887 2.38638 0.956281 2.49698 1.05001 2.58994L5.29001 6.82994C5.38297 6.92367 5.49357 6.99806 5.61543 7.04883C5.73729 7.0996 5.868 7.12574 6.00001 7.12574C6.13202 7.12574 6.26273 7.0996 6.38459 7.04883C6.50645 6.99806 6.61705 6.92367 6.71001 6.82994L11 2.58994C11.0937 2.49698 11.1681 2.38638 11.2189 2.26452C11.2697 2.14266 11.2958 2.01195 11.2958 1.87994C11.2958 1.74793 11.2697 1.61723 11.2189 1.49537C11.1681 1.37351 11.0937 1.26291 11 1.16994Z" fill="currentColor"></path></svg>
        </button>
    </div>
</section>
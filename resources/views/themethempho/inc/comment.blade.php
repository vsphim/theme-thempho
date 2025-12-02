<section class="l-section empty:hidden mt-8 lg:mt-[4rem] max-lg:container-sm scroll-mt-[--home-header-height]">
    <div id="comment" class="empty:hidden">
        <div>
            <div class="relative"><div class="m-sectionTitle flex items-center justify-between gap-3 pb-4 sm:pb-8 text-[1rem]"><div class="block"><h3 class="typography font-sans-text lg:text-[1.75rem] lg:leading-[2.5rem] sm:text-[1.5rem] sm:leading-[1.75rem] text-[1.25rem] leading-[1.75rem] text-primary font-bold">Bình luận ({{$totalComment}})</h3></div></div></div>
            <div class="[&:_div[data-radix-popper-content-wrapper]]:!z-[1000]">
                <form class="relative form-comment border border-black bg-primary-comment rounded-lg [&amp;:has(.replay-input:focus)]:border-primary pt-2">
                    <textarea placeholder="Thêm bình luận" class="text-[16px] px-4 w-full bg-transparent placeholder:text-red-500 outline-none min-h-[60px] whitespace-pre-wrap break-words [&amp;_img]:w-[--icon-size] [&amp;_img]:h-[--icon-size] [&amp;_img]:inline-block [&amp;_img]:object-cover [&amp;_img]:object-[calc(var(--icon-ps)*var(--icon-size))_0]"></textarea>
                    <div class="h-[1px] w-full bg-black"></div>
                    <div class="flex justify-end items-center p-2 py-2 gap-3">
                        <div>
                            <button type="submit" class="a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-hover rounded-full h-8 px-4 font-normal text-[0.875rem] min-w-14 gap-2" aria-label="button-icon">
                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.1498 0.86001C18.7678 0.470572 18.2833 0.197227 17.7524 0.0715841C17.2215 -0.0540591 16.6659 -0.0268691 16.1498 0.15001L1.9998 4.88001C1.42912 5.06681 0.930493 5.42616 0.572758 5.90845C0.215023 6.39073 0.0158211 6.97218 0.00265102 7.57251C-0.010519 8.17285 0.162992 8.76247 0.499233 9.25998C0.835473 9.75749 1.31786 10.1384 1.87981 10.35L7.1198 12.35C7.23912 12.3956 7.34776 12.4654 7.43895 12.5548C7.53014 12.6443 7.60191 12.7516 7.6498 12.87L9.64981 18.12C9.85339 18.674 10.2228 19.1518 10.7078 19.4882C11.1927 19.8246 11.7696 20.0033 12.3598 20H12.4298C13.0308 19.9891 13.6134 19.7903 14.0958 19.4317C14.5781 19.073 14.9362 18.5724 15.1198 18L19.8498 3.83001C20.0218 3.31895 20.0474 2.76995 19.9237 2.2451C19.8 1.72024 19.5319 1.24046 19.1498 0.86001ZM17.9998 3.20001L13.2198 17.38C13.1643 17.5595 13.0528 17.7165 12.9017 17.828C12.7505 17.9396 12.5677 17.9999 12.3798 18C12.1931 18.0031 12.0098 17.9492 11.8544 17.8456C11.699 17.742 11.5788 17.5936 11.5098 17.42L9.50981 12.17C9.36481 11.7885 9.14119 11.4418 8.85349 11.1524C8.56578 10.863 8.22041 10.6373 7.83981 10.49L2.58981 8.49001C2.4127 8.42511 2.26046 8.30621 2.15459 8.1501C2.04872 7.99399 1.99458 7.80856 1.9998 7.62001C1.99996 7.43215 2.06022 7.24928 2.17178 7.09813C2.28334 6.94699 2.44034 6.83551 2.6198 6.78001L16.7998 2.05001C16.9626 1.98366 17.1411 1.96588 17.3138 1.99883C17.4865 2.03179 17.646 2.11406 17.7729 2.2357C17.8998 2.35734 17.9888 2.51314 18.0291 2.68427C18.0693 2.8554 18.0592 3.03453 17.9998 3.20001Z" fill="currentColor"></path></svg>
                                <p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] font-[300]">Bình luận</p>
                            </button>
                        </div>
                    </div>
                </form>
                <div class="flex flex-col gap-2 mt-2">
                    @foreach ($comments as $comment)
                    <div class="flex gap-3 lg:gap-4 bg-primary-comment px-2 py-2 lg:px-4 rounded-lg lg:py-2">
                        <div class="shrink-0 w-8 lg:w-10">
                            <div class=" relative w-full aspect-square">
                                <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                    <img title="{{$comment->user->name}}" alt="{{$comment->user->name}}" data-src="{{$comment->user->avatar ?? '/themes/thempho/images/default.jpg'}}" class="rounded-full lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                </span>
                            </div>
                        </div>
                        <div class="grow">
                            <div class="grow">
                                <div class="flex items-center gap-1">
                                    <p class="typography font-sans-text font-bold text-primary-text/80 text-[0.875rem] lg:text-[1rem]">{{$comment->user->name}}</p>
                                    <span class="relative aspect-[3/1] w-10"></span>
                                </div>
                                <p class="typography font-sans-text text-[0.75rem] text-primary-text/60 leading-[100%] lg:text-[0.75rem]">{{$comment->created_at->diffForHumans()}}</p>
                            </div>
                            <div class="mt-3">
                                <div class="a-showMoreContent relative">
                                    <div class="relative overflow-hidden max-h-[64px] lg:max-h-[74px]">
                                        <p class="text-primary-text/80 font-[200] text-[0.875rem] lg:text-[1rem] [&amp;_img]:w-[--icon-size] [&amp;_img]:h-[--icon-size] [&amp;_img]:inline-block [&amp;_img]:object-cover [&amp;_img]:object-[calc(var(--icon-ps)*var(--icon-size))_0]">
                                            {!! $comment->content !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-2 flex gap-2 -ml-2"><button data-id="{{$comment->id}}" class="a-button btn-reply flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-transparent ring-0 text-primary-text/40 hover:bg-black-b100 hover:text-primary-text/80 rounded-full h-7 gap-1 px-3 font-normal text-[0.875rem]" aria-label="button-icon"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"><path d="M11 0C9.68677 0 8.38641 0.258658 7.17315 0.761205C5.9599 1.26375 4.85751 2.00035 3.92892 2.92893C2.05356 4.8043 0.999988 7.34784 0.999988 10C0.991246 12.3091 1.79078 14.5485 3.25999 16.33L1.25999 18.33C1.12123 18.4706 1.02723 18.6492 0.98986 18.8432C0.952486 19.0372 0.973409 19.2379 1.04999 19.42C1.13305 19.5999 1.26769 19.7511 1.43683 19.8544C1.60598 19.9577 1.80199 20.0083 1.99999 20H11C13.6522 20 16.1957 18.9464 18.0711 17.0711C19.9464 15.1957 21 12.6522 21 10C21 7.34784 19.9464 4.8043 18.0711 2.92893C16.1957 1.05357 13.6522 0 11 0ZM11 18H4.40999L5.33999 17.07C5.52624 16.8826 5.63078 16.6292 5.63078 16.365C5.63078 16.1008 5.52624 15.8474 5.33999 15.66C4.03057 14.352 3.21516 12.6305 3.03268 10.7888C2.8502 8.94705 3.31193 7.09901 4.33922 5.55952C5.3665 4.02004 6.89578 2.88436 8.6665 2.34597C10.4372 1.80759 12.3398 1.8998 14.0502 2.60691C15.7606 3.31402 17.1728 4.59227 18.0464 6.22389C18.92 7.85551 19.2009 9.73954 18.8411 11.555C18.4814 13.3705 17.5033 15.005 16.0735 16.1802C14.6438 17.3554 12.8508 17.9985 11 18Z" fill="currentColor"></path></svg> <span>Phản hồi</span></button></div>
                            <div class="mt-2 hidden" id="form-{{$comment->id}}">
                                <form data-parent="{{$comment->id}}" class="relative form-comment border rounded-lg [&amp;:has(.replay-input:focus)]:border-primary pt-2 border-transparent bg-black/50">
                                    <textarea placeholder="Thêm bình luận..." class="text-[16px] px-4 w-full bg-transparent placeholder:text-red-500 outline-none min-h-[60px] whitespace-pre-wrap break-words [&amp;_img]:w-[--icon-size] [&amp;_img]:h-[--icon-size] [&amp;_img]:inline-block [&amp;_img]:object-cover [&amp;_img]:object-[calc(var(--icon-ps)*var(--icon-size))_0]"></textarea>
                                    <div class="h-[1px] w-full bg-primary-comment"></div>
                                    <div class="flex justify-end items-center p-2 py-2 gap-3">
                                        <div>
                                            <button type="submit" class="a-button flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] text-primary-text duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-primary hover:bg-primary-hover rounded-full h-8 px-4 font-normal text-[0.875rem] min-w-14 gap-2"><svg width="14" height="14" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M19.1498 0.86001C18.7678 0.470572 18.2833 0.197227 17.7524 0.0715841C17.2215 -0.0540591 16.6659 -0.0268691 16.1498 0.15001L1.9998 4.88001C1.42912 5.06681 0.930493 5.42616 0.572758 5.90845C0.215023 6.39073 0.0158211 6.97218 0.00265102 7.57251C-0.010519 8.17285 0.162992 8.76247 0.499233 9.25998C0.835473 9.75749 1.31786 10.1384 1.87981 10.35L7.1198 12.35C7.23912 12.3956 7.34776 12.4654 7.43895 12.5548C7.53014 12.6443 7.60191 12.7516 7.6498 12.87L9.64981 18.12C9.85339 18.674 10.2228 19.1518 10.7078 19.4882C11.1927 19.8246 11.7696 20.0033 12.3598 20H12.4298C13.0308 19.9891 13.6134 19.7903 14.0958 19.4317C14.5781 19.073 14.9362 18.5724 15.1198 18L19.8498 3.83001C20.0218 3.31895 20.0474 2.76995 19.9237 2.2451C19.8 1.72024 19.5319 1.24046 19.1498 0.86001ZM17.9998 3.20001L13.2198 17.38C13.1643 17.5595 13.0528 17.7165 12.9017 17.828C12.7505 17.9396 12.5677 17.9999 12.3798 18C12.1931 18.0031 12.0098 17.9492 11.8544 17.8456C11.699 17.742 11.5788 17.5936 11.5098 17.42L9.50981 12.17C9.36481 11.7885 9.14119 11.4418 8.85349 11.1524C8.56578 10.863 8.22041 10.6373 7.83981 10.49L2.58981 8.49001C2.4127 8.42511 2.26046 8.30621 2.15459 8.1501C2.04872 7.99399 1.99458 7.80856 1.9998 7.62001C1.99996 7.43215 2.06022 7.24928 2.17178 7.09813C2.28334 6.94699 2.44034 6.83551 2.6198 6.78001L16.7998 2.05001C16.9626 1.98366 17.1411 1.96588 17.3138 1.99883C17.4865 2.03179 17.646 2.11406 17.7729 2.2357C17.8998 2.35734 17.9888 2.51314 18.0291 2.68427C18.0693 2.8554 18.0592 3.03453 17.9998 3.20001Z" fill="currentColor"></path></svg></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <ul class="flex flex-col gap-2 mt-2">
                                @foreach ($comment->replies as $reply)
                                <li>
                                    <div class="flex gap-3 lg:gap-4 bg-primary-comment rounded-lg px-0 py-0 lg:py-0 lg:px-0">
                                        <div class="shrink-0 w-8 lg:w-10">
                                            <div class=" relative w-full aspect-square">
                                                <span style="box-sizing: border-box; display: block; overflow: hidden; width: initial; height: initial; background: none; opacity: 1; border: 0px; margin: 0px; padding: 0px; position: absolute; inset: 0px;">
                                                    <img title="{{$reply->user->name}}" alt="{{$reply->user->name}}" data-src="{{$reply->user->avatar ?? '/themes/thempho/images/default.jpg'}}" class="rounded-full lozad" style="position: absolute; inset: 0px; box-sizing: border-box; padding: 0px; border: none; margin: auto; display: block; width: 0px; height: 0px; min-width: 100%; max-width: 100%; min-height: 100%; max-height: 100%; object-fit: cover;">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="grow">
                                            <div class="grow">
                                                <div class="flex items-center gap-1">
                                                    <p class="typography font-sans-text font-bold text-primary-text/80 text-[0.875rem] lg:text-[1rem]">{{$reply->user->name}}</p>
                                                    <span class="relative aspect-[3/1] w-10"></span>
                                                </div>
                                                <p class="typography font-sans-text text-[0.75rem] text-primary-text/60 leading-[100%] lg:text-[0.75rem]">{{$reply->created_at->diffForHumans()}}</p>
                                            </div>
                                            <div class="mt-3">
                                                <div class="a-showMoreContent relative">
                                                    <div class="relative overflow-hidden max-h-[64px] lg:max-h-[74px]">
                                                        <p class="text-primary-text/80 font-[200] text-[0.875rem] lg:text-[1rem] [&amp;_img]:w-[--icon-size] [&amp;_img]:h-[--icon-size] [&amp;_img]:inline-block [&amp;_img]:object-cover [&amp;_img]:object-[calc(var(--icon-ps)*var(--icon-size))_0]">
                                                            {!! $reply->content !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-2 flex gap-2 -ml-2"><button data-id="{{$comment->id}}" class="a-button btn-reply flex items-center justify-center relative [&amp;:not(:disabled)]:active:opacity-[0.92] duration-200 whitespace-nowrap disabled:bg-primary-btn/40 disabled:text-primary-text/40 active:scale-[0.98] disabled:active:scale-100 bg-transparent ring-0 text-primary-text/40 hover:bg-black-b100 hover:text-primary-text/80 rounded-full h-7 gap-1 px-3 font-normal text-[0.875rem]" aria-label="button-icon"><svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5"><path d="M11 0C9.68677 0 8.38641 0.258658 7.17315 0.761205C5.9599 1.26375 4.85751 2.00035 3.92892 2.92893C2.05356 4.8043 0.999988 7.34784 0.999988 10C0.991246 12.3091 1.79078 14.5485 3.25999 16.33L1.25999 18.33C1.12123 18.4706 1.02723 18.6492 0.98986 18.8432C0.952486 19.0372 0.973409 19.2379 1.04999 19.42C1.13305 19.5999 1.26769 19.7511 1.43683 19.8544C1.60598 19.9577 1.80199 20.0083 1.99999 20H11C13.6522 20 16.1957 18.9464 18.0711 17.0711C19.9464 15.1957 21 12.6522 21 10C21 7.34784 19.9464 4.8043 18.0711 2.92893C16.1957 1.05357 13.6522 0 11 0ZM11 18H4.40999L5.33999 17.07C5.52624 16.8826 5.63078 16.6292 5.63078 16.365C5.63078 16.1008 5.52624 15.8474 5.33999 15.66C4.03057 14.352 3.21516 12.6305 3.03268 10.7888C2.8502 8.94705 3.31193 7.09901 4.33922 5.55952C5.3665 4.02004 6.89578 2.88436 8.6665 2.34597C10.4372 1.80759 12.3398 1.8998 14.0502 2.60691C15.7606 3.31402 17.1728 4.59227 18.0464 6.22389C18.92 7.85551 19.2009 9.73954 18.8411 11.555C18.4814 13.3705 17.5033 15.005 16.0735 16.1802C14.6438 17.3554 12.8508 17.9985 11 18Z" fill="currentColor"></path></svg> <span>Phản hồi</span></button></div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<script>
$(document).on('submit', '.form-comment', function(e) {
    e.preventDefault();
    var comment = $(this).find('textarea').val();
    var parent_id = $(this).data('parent');
    $.ajax({
        type: 'POST',
        url: '{{ route('thempho.comment') }}',
        data: {
            '_token': '{{ csrf_token() }}',
            'content': comment,
            'movie_id': movie_id,
            'parent_id': parent_id
        },
        success: function(response) {
            if (response.status == 'success') {
                window.location.reload();
            }else{
                alert(response.message);
            }
        }
    });
});
$(document).on('click', '.btn-reply', function() {
    var id = $(this).data('id');
    $('.reply-form').addClass('hidden');
    $('#form-' + id).toggleClass('hidden');
});
</script>

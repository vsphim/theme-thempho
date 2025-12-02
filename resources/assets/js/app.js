$(document).ready((function() {
    let e;
    $(".menu-item").hover((function() {
        clearTimeout(e), $(this).find(".menu-item-children").removeClass("hidden")
    }), (function() {
        const t = $(this);
        e = setTimeout((function() {
        t.find(".menu-item-children").addClass("hidden")
        }), 300)
    })), $(".menu-item-children").hover((function() {
      clearTimeout(e)
    }), (function() {
      $(this).addClass("hidden")
    })), $(".toggle-dropdown-menu").on("click", (function() {
      $(this).closest('.group-menuItem').find(".dropdown-menu").toggleClass("hidden"), $(this).find("svg").toggleClass("rotate-90")
    })), $(".btn-toggle-sidebar").on("click", (function() {
      $(".sidebar-mobile").toggleClass("hidden")
    }));

    $(".btn-search").on("click", function() {
        if ($(window).width() < 1024) {

            $("#search-container-mobile").toggleClass("hidden");
        } else {
            $("#search-container").toggleClass("hidden");
        }
    });

    $(document).on('submit', '#login-form', function(e) {
        e.preventDefault();

        const username = $('#email_lg').val();
        const password = $('#password_lg').val();
        $(this).find('p').remove();

        if (username === '') {
            $('#email_lg').after('<p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] text-red-400 mt-1 ml-4">Vui lòng không để trống</p>');
        }

        if (password === '') {
            $('#password_lg').after('<p class="typography font-sans-text text-[0.875rem] leading-[1.25rem] text-red-400 mt-1 ml-4">Vui lòng không để trống</p>');
        }

        if (username !== '' && password !== '') {
            $.ajax({
                url: '/auth/login',
                method: 'POST',
                data: {
                    username: username,
                    password: password,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        window.location.reload();
                    } else {
                        alert('Tài khoản hoặc mật khẩu không chính xác');
                    }
                }
            });
        }
    });

    $(document).on('submit', '#form-register', function(e) {
        e.preventDefault();

        const name = $('#name_rg').val();
        const email = $('#email_rg').val();
        const password = $('#password_rg').val();

        if (name === '') {
            $('#name_rg').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (email === '') {
            $('#email_rg').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (password === '') {
            $('#password_rg').after('<p class="typography font-content text-[14px] leading-[normal] font-normal text-red-500">Vui lòng không để trống</p>');
        }

        if (name !== '' && email !== '' && password !== '') {
            $.ajax({
                url: '/auth/register',
                method: 'POST',
                data: {
                    name: name,
                    email: email,
                    password: password,
                    _token: $('input[name="_token"]').val()
                },
                success: function(response) {
                    if (response.success) {
                        alert('Đăng ký thành công');
                    } else {
                        alert('Tài khoản đã tồn tại');
                    }
                }
            });
        }
    });

    $('.btn-toggle-modal-auth').on('click', function() {
        $('#modal-auth').toggleClass('hidden');
        $('#modal-auth-register').addClass('hidden');
    });

    $('.btn-auth-register').on('click', function() {
        $('#modal-auth-register').toggleClass('hidden');
        $('#modal-auth').addClass('hidden');
    });

    $('.btn-go-to-top').on('click', function() {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() > 100) {
            $('.btn-go-to-top').removeClass('hidden');
        } else {
            $('.btn-go-to-top').addClass('hidden');
        }

        if ($(window).scrollTop() > 50) {
            $('header').removeClass('bg-transparent').addClass('bg-black/[100%]');
        } else {
            $('header').removeClass('bg-black/[100%]').addClass('bg-transparent');
        }
    });

    $('.btn-toggle-profile-menu').on('click', function() {
        $('#profile-menu').toggleClass('hidden');
    });

}));

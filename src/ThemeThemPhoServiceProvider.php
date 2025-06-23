<?php

namespace vsphim\ThemeThemPho;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeThemPhoServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/thempho')
        ], 'thempho-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'thempho' => [
                'name' => 'ThemPho',
                'author' => 'vsphim@gmail.com',
                'package_name' => 'vsphim/theme-thempho',
                'publishes' => ['thempho-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'recommendations_limit',
                        'label' => 'Recommended movies limit',
                        'type' => 'number',
                        'value' => 10,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 40,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 8,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template(block_thumb|top)',
                        'value' => <<<EOT
                        Mới nhất||is_copyright|0|10|/danh-sach/phim-bo|block_thumb
                        Phim hay||is_copyright|0|10|#|top
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <footer class="hidden lg:block bg-primary-btn/60 w-full py-10">
                            <div class="l-container container">
                                <div class="flex flex-col gap-20">
                                    <div class="grid grid-cols-12 gap-10">
                                        <div class="col-span-4 flex flex-col items-start gap-8">
                                            <a href="/" class="flex items-center" aria-label="Home">
                                                <div class="shrink-0">
                                                    <div class="relative aspect-[437/81] w-[120px] lg:w-[150px]">
                                                        <span style="box-sizing:border-box;display:block;overflow:hidden;width:initial;height:initial;background:none;opacity:1;border:0;margin:0;padding:0;position:absolute;top:0;left:0;bottom:0;right:0">
                                                            <img title="logo" alt="logo" src="/logo.svg" loading="lazy" style="position:absolute;top:0;left:0;bottom:0;right:0;box-sizing:border-box;padding:0;border:none;margin:auto;display:block;width:0;height:0;min-width:100%;max-width:100%;min-height:100%;max-height:100%;object-fit:cover">
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                            <p class="typography font-sans-text text-[1rem] leading-[1.5rem] text-primary-text/50">ThemphoTV - Tinh hoa 18+. Chuyên trang tổng hợp hàng ngày các thể loại Phim Sex Việt Nam, VietSub, Sex Cổ Trang, Sex Trung Quốc, sex Hàn Quốc, JAV hay, và của các video sex nổi tiếng, huyền thoại</p>
                                        </div>
                                        <div class="col-span-2">
                                            <div class="flex flex-col gap-4 pl-16">
                                                <p class="typography font-sans-text text-[1rem] leading-[1.5rem]">Thực đơn</p>
                                                <div class="grid grid-cols-12 gap-2">
                                                    <div class="col-span-12">
                                                        <div class="a-linkWrapper relative text-primary-text/50 hover:text-primary">
                                                            <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="Người nổi tiếng" rel="" href="#">Người nổi tiếng</a>
                                                            <p class="typography font-sans-text text-[1rem] leading-[1.5rem]">Người nổi tiếng</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12">
                                                        <div class="a-linkWrapper relative text-primary-text/50 hover:text-primary">
                                                            <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="Thái Lan" rel="" href="#">Thái Lan</a>
                                                            <p class="typography font-sans-text text-[1rem] leading-[1.5rem]">Thái Lan</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 items-center">
                                        <div class="col-span-4">
                                            <p class="typography font-sans-text text-[0.8125rem] leading-[1rem] text-primary-text/40">Copyright © 2025, ThemphoTV. All Rights Reserved</p>
                                        </div>
                                        <div class="col-span-4 flex items-center justify-center gap-3">
                                            <div class="a-linkWrapper relative text-primary-text/40 hover:text-primary">
                                                <a class="absolute text-transparent inset-0 z-zContent overflow-hidden" title="Sitemap" rel="" href="/sitemap.xml">Sitemap</a>
                                                <p class="typography font-sans-text text-[0.8125rem] leading-[1rem]">SITEMAP</p>
                                            </div>
                                            <p class="typography font-sans-text text-[0.8125rem] leading-[1rem] text-primary-text/40">|</p>
                                            <div class="a-linkWrapper relative text-primary-text/40 hover:text-primary">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}

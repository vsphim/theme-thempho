<?php

namespace vsphim\ThemeThemPho\Controllers;

use Backpack\Settings\app\Models\Setting;
use Illuminate\Http\Request;
use Ophim\Core\Models\Actor;
use Ophim\Core\Models\Catalog;
use Ophim\Core\Models\Category;
use Ophim\Core\Models\Director;
use Ophim\Core\Models\Episode;
use Ophim\Core\Models\Movie;
use Ophim\Core\Models\Region;
use Ophim\Core\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ThemeThemPhoController
{

    public function index(Request $request)
    {
        if ($request['search'] || $request['filter']) {
            $data = Movie::when(!empty($request['filter']['category']), function ($movie) {
                $movie->whereHas('categories', function ($categories) {
                    $categories->where('id', request('filter')['category']);
                });
            })->when(!empty($request['filter']['region']), function ($movie) {
                $movie->whereHas('regions', function ($regions) {
                    $regions->where('id', request('filter')['region']);
                });
            })->when(!empty($request['filter']['year']), function ($movie) {
                $movie->where('publish_year', request('filter')['year']);
            })->when(!empty($request['filter']['type']), function ($movie) {
                $movie->where('type', request('filter')['type']);
            })->when(!empty($request['search']), function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $search = $request['search'];
                    $query->where('name', 'like', '%' . $search . '%')
                        ->orWhere('origin_name', 'like', '%' . $search . '%')
                        ->orWhere('slug', 'like', '%' . $search . '%');

                    $query->orWhereHas('categories', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('regions', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    })->orWhereHas('actors', function ($subQuery) use ($search) {
                        $subQuery->where('name', 'like', '%' . $search . '%');
                    });
                });
            })->when(!empty($request['filter']['sort']), function ($movie) {
                if (request('filter')['sort'] == 'create') {
                    return $movie->orderBy('created_at', 'desc');
                }
                if (request('filter')['sort'] == 'update') {
                    return $movie->orderBy('updated_at', 'desc');
                }
                if (request('filter')['sort'] == 'year') {
                    return $movie->orderBy('publish_year', 'desc');
                }
                if (request('filter')['sort'] == 'view') {
                    return $movie->orderBy('view_total', 'desc');
                }
            })->paginate(get_theme_option('per_page_limit'));

            return view('themes::themethempho.catalog', [
                'data' => $data,
                'search' => $request['search'],
                'section_name' => "Tìm kiếm phim: $request->search"
            ]);
        }
        return view('themes::themethempho.index', [
            'title' => Setting::get('site_homepage_title')
        ]);
    }

    public function getMovieOverview(Request $request)
    {
        /** @var Movie */
        $movie = Movie::fromCache()->find($request->movie ?: $request->id);

        if (is_null($movie)) return view('themes::themethempho.404');

        $movie->generateSeoTags();

        $movie->increment('view_total', 1);
        $movie->increment('view_day', 1);
        $movie->increment('view_week', 1);
        $movie->increment('view_month', 1);

        $movie_related_cache_key = 'movie_related:' . $movie->id;
        $movie_related = Cache::get($movie_related_cache_key);
        if(is_null($movie_related)) {
            $movie_related = $movie->categories[0]->movies()->inRandomOrder()->limit(get_theme_option('movie_related_limit', 10))->get();
            Cache::put($movie_related_cache_key, $movie_related, setting('site_cache_ttl', 5 * 60));
        }

        $episode = $movie->episodes->first();
        if(!$episode) {
            return view('themes::themethempho.404');
        }

        $tops = Movie::orderBy('view_total', 'desc')->limit(10)->get();

        return view('themes::themethempho.single', [
            'currentMovie' => $movie,
            'title' => $movie->getTitle(),
            'movie_related' => $movie_related,
            'episode' => $episode,
            'tops' => $tops
        ]);
    }

    public function getEpisode(Request $request)
    {
        $movie = Movie::fromCache()->find($request->movie ?: $request->movie_id)->load('episodes');

        if (is_null($movie)) abort(404);

        /** @var Episode */
        $episode_id = $request->id;
        $episode = $movie->episodes->when($episode_id, function ($collection, $episode_id) {
            return $collection->where('id', $episode_id);
        })->firstWhere('slug', $request->episode);

        if (is_null($episode)) abort(404);

        $episode->generateSeoTags();

        $movie->increment('view_total', 1);
        $movie->increment('view_day', 1);
        $movie->increment('view_week', 1);
        $movie->increment('view_month', 1);

        $movie_related_cache_key = 'movie_related:' . $movie->id;
        $movie_related = Cache::get($movie_related_cache_key);
        if(is_null($movie_related)) {
            $movie_related = $movie->categories[0]->movies()->inRandomOrder()->limit(get_theme_option('movie_related_limit', 10))->get();
            Cache::put($movie_related_cache_key, $movie_related, setting('site_cache_ttl', 5 * 60));
        }

        return view('themes::themethempho.episode', [
            'currentMovie' => $movie,
            'movie_related' => $movie_related,
            'episode' => $episode,
            'title' => $episode->getTitle()
        ]);
    }

    public function getMovieOfCategory(Request $request)
    {
        /** @var Category */
        $category = Category::fromCache()->find($request->category ?: $request->id);

        if (is_null($category)) abort(404);

        $category->generateSeoTags();

        $movies = $category->movies()->orderBy('created_at', 'desc')->paginate(get_theme_option('per_page_limit'));

        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'category' => $category,
            'title' => $category->seo_title ?: $category->getTitle(),
            'section_name' => "Phim thể loại $category->name"
        ]);
    }

    public function getMovieOfRegion(Request $request)
    {
        /** @var Region */
        $region = Region::fromCache()->find($request->region ?: $request->id);

        if (is_null($region)) abort(404);

        $region->generateSeoTags();

        $movies = $region->movies()->orderBy('created_at', 'desc')->paginate(get_theme_option('per_page_limit'));

        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'region' => $region,
            'title' => $region->seo_title ?: $region->getTitle(),
            'section_name' => "Phim quốc gia $region->name"
        ]);
    }

    public function getMovieOfActor(Request $request)
    {
        /** @var Actor */
        $actor = Actor::fromCache()->find($request->actor ?: $request->id);

        if (is_null($actor)) abort(404);

        $actor->generateSeoTags();

        $movies = $actor->movies()->orderBy('created_at', 'desc')->paginate(get_theme_option('per_page_limit'));

        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'person' => $actor,
            'title' => $actor->getTitle(),
            'section_name' => "Diễn viên $actor->name"
        ]);
    }

    public function getMovieOfDirector(Request $request)
    {
        /** @var Director */
        $director = Director::fromCache()->find($request->director ?: $request->id);

        if (is_null($director)) abort(404);

        $director->generateSeoTags();

        $movies = $director->movies()->orderBy('created_at', 'desc')->paginate(get_theme_option('per_page_limit'));

        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'person' => $director,
            'title' => $director->getTitle(),
            'section_name' => "Đạo diễn $director->name"
        ]);
    }

    public function getMovieOfTag(Request $request)
    {
        /** @var Tag */
        $tag = Tag::fromCache()->find($request->tag ?: $request->id);

        if (is_null($tag)) abort(404);

        $tag->generateSeoTags();

        $movies = $tag->movies()->orderBy('created_at', 'desc')->paginate(get_theme_option('per_page_limit'));
        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'tag' => $tag,
            'title' => $tag->getTitle(),
            'section_name' => "Tags: $tag->name"
        ]);
    }

    public function getMovieOfType(Request $request)
    {
        /** @var Catalog */
        $catalog = Catalog::fromCache()->find($request->type ?: $request->id);

        if (is_null($catalog)) abort(404);

        $catalog->generateSeoTags();

        $cache_key = 'catalog:' . $catalog->id . ':page:' . ($request['page'] ?: 1);
        $movies = Cache::get($cache_key);
        if(is_null($movies)) {
            $value = explode('|', trim($catalog->value));
            [$relation_config, $field, $val, $sortKey, $alg] = array_merge($value, ['', 'is_copyright', 0, 'created_at', 'desc']);
            $relation_config = explode(',', $relation_config);

            [$relation_table, $relation_field, $relation_val] = array_merge($relation_config, ['', '', '']);
            try {
                $movies = \Ophim\Core\Models\Movie::when($relation_table, function ($query) use ($relation_table, $relation_field, $relation_val, $field, $val) {
                    $query->whereHas($relation_table, function ($rel) use ($relation_field, $relation_val, $field, $val) {
                        $rel->where($relation_field, $relation_val)->where(array_combine(explode(",", $field), explode(",", $val)));
                    });
                })->when(!$relation_table, function ($query) use ($field, $val) {
                    $query->where(array_combine(explode(",", $field), explode(",", $val)));
                })
                ->orderBy($sortKey, $alg)
                ->paginate($catalog->paginate);

                Cache::put($cache_key, $movies, setting('site_cache_ttl', 5 * 60));
            } catch (\Exception $e) {}
        }

        return view('themes::themethempho.catalog', [
            'data' => $movies,
            'section_name' => "Danh sách $catalog->name"
        ]);
    }

    public function reportEpisode(Request $request, $movie, $slug)
    {
        $movie = Movie::fromCache()->find($movie)->load('episodes');

        $episode = $movie->episodes->when(request('id'), function ($collection) {
            return $collection->where('id', request('id'));
        })->firstWhere('slug', $slug);

        $episode->update([
            'report_message' => request('message', ''),
            'has_report' => true
        ]);

        return response([], 204);
    }

    public function rateMovie(Request $request, $movie)
    {

        $movie = Movie::fromCache()->find($movie);

        $movie->refresh()->increment('rating_count', 1, [
            'rating_star' => $movie->rating_star +  ((int) request('rating') - $movie->rating_star) / ($movie->rating_count + 1)
        ]);

        return response()->json(['status' => true, 'rating_star' => number_format($movie->rating_star, 1), 'rating_count' => $movie->rating_count]);
    }

    public function loginCallback(Request $request)
    {
        $user = Socialite::driver('google')->stateless()->user();

        $findUser = User::where('google_id', $user->id)->first();
        if($findUser) {
            Auth::login($findUser);
            return redirect()->intended('/');
        }else{
            $findEmail = User::where('email', $user->email)->first();
            if($findEmail) {
                $findEmail->update(['google_id' => $user->id]);
                Auth::login($findEmail);
                return redirect()->intended('/');
            }
            $newUser = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'google_id' => $user->id,
                'avatar' => $user->avatar,
                'password' => bcrypt($user->id),
            ]);

            Auth::login($newUser);
            return redirect()->intended('/');
        }
    }

    public function getGoogleSignInUrl()
    {
        return Socialite::driver('google')->redirect();
    }

    public function login(Request $request)
    {
        $email = $request->username;
        $password = $request->password;

        if(Auth::attempt(['email' => $email, 'password' => $password], true)) {
            return response()->json(['success' => true]);
        }else{
            return response()->json(['success' => false]);
        }
    }

    public function register(Request $request)
    {
        $email = $request->email;
        $password = $request->password;
        $name = $request->name;

        $user = User::where('email', $email)->first();
        if($user) {
            return response()->json(['success' => false]);
        }

        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'name' => $name,
        ]);

        return response()->json(['success' => true]);
    }

    public function comment(Request $request)
    {
        if(!Auth::check()){
            return response()->json(['status' => 'error', 'message' => 'Vui lòng đăng nhập để bình luận']);
        }

        $request->validate([
            'content' => 'required',
        ], [
            'content.required' => 'Vui lòng nhập nội dung bình luận',
        ]);

        DB::table('comments')->insert([
            'user_id' => Auth::id(),
            'movie_id' => $request->movie_id,
            'content' => $request->content,
            'parent_id' => $request->parent_id,
            'episode_id' => $request->episode_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['status' => 'success', 'message' => 'Bình luận thành công']);
    }

    public function follow(Request $request)
    {
        $check = DB::table('follows')->where('user_id', Auth::id())->where('movie_id', $request->movie_id)->first();
        if($check) {
            DB::table('follows')->where('user_id', Auth::id())->where('movie_id', $request->movie_id)->delete();
            return response()->json(['status' => 'unfollow']);
        }else{
            DB::table('follows')->insert([
                'user_id' => Auth::id(),
                'movie_id' => $request->movie_id,
            ]);
            return response()->json(['status' => 'follow']);
        }
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->intended('/');
    }

    public function profile()
    {
        if(!Auth::check()){
            return redirect()->intended('/');
        }
        return view('themes::themethempho.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập họ tên',
        ]);

        $user = User::find(Auth::id());
        $user->name = $request->name;
        if($request->hasFile('avatar')) {
            $request->validate([
                'avatar' => 'mimes:jpg,jpeg,png,gif|max:2048',
            ], [
                'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpg, jpeg, png hoặc gif',
                'avatar.max' => 'Dung lượng ảnh đại diện không được vượt quá 2MB',
            ]);

            $avatar = $request->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $path = public_path('uploads/' . $avatarName);
            file_put_contents($path, file_get_contents($avatar->getRealPath()));
            $user->avatar = '/uploads/' . $avatarName;
        }
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin thành công');
    }

    public function bookmark()
    {
        if(!Auth::check()){
            return redirect()->intended('/');
        }
        $movies = DB::table('follows')->where('user_id', Auth::id())->orderByDesc('created_at')->paginate(15);
        foreach($movies as $movie){
            $movie->movie = Movie::find($movie->movie_id);
        }
        return view('themes::themethempho.bookmark', compact('movies'));
    }

    public function history()
    {
        if(!Auth::check()){
            return redirect()->intended('/');
        }
        $movies = DB::table('histories')->where('user_id', Auth::id())->orderByDesc('updated_at')->paginate(15);
        foreach($movies as $movie){
            $movie->movie = Movie::find($movie->movie_id);
            $lastEpisode = last(explode(',', $movie->watch_at));
            $movie->continue = Episode::find($lastEpisode);
        }
        return view('themes::themethempho.history', compact('movies'));
    }
}

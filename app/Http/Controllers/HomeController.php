<?php

namespace App\Http\Controllers;

use App\Models\{FaqCategory, Page, Testimonial, Vehicle, BodyStyle, Bid, SellerQA};
use DB, Auth, Mail;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\User;
use App\Notifications\BidsNotification;
use Illuminate\Support\Facades\{Schema, Storage};



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        $page = Page::whereSlug('home')->first();
        $vehcile = Vehicle::active()->orderBy('expire', 'asc')->paginate(50);
        $all = Vehicle::new();

        $body = BodyStyle::active()->get();
        $vechile = Vehicle::active();

        return view('welcome', compact('page', 'vehcile', 'body', 'vechile', 'all'));
    }
    public function past()
    {
        $page = Page::whereSlug('home')->first();
        $vehcile = Vehicle::active()->where('expire','<=', now())->orderBy('expire', 'asc')->paginate(50);
        $all = Vehicle::new();

        $body = BodyStyle::active()->get();
        $vechile = Vehicle::active()->where('expire','<=', now());

        return view('welcome', compact('page', 'vehcile', 'body', 'vechile', 'all'));
    }
    public function searchForm(Request $request)
    {
        $page = Page::whereSlug('home')->first();
        $vehcile = Vehicle::active()->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%'])->paginate(50);

        $all = Vehicle::new();

        $body = BodyStyle::active()->get();
        $vechile = Vehicle::active()->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($request->search) . '%']);

        return view('welcome', compact('page', 'vehcile', 'body', 'vechile', 'all'));
        
    }
    public function sellacar()
    {
        $page = Page::whereSlug('sell-a-car')->first();
        $testimonal = Testimonial::all();

        return view('sellacar', compact('page', 'testimonal'));
    }
    public function whycars()
    {
        $page = Page::whereSlug('what-cars-bids')->first();
        $faqCategory = FaqCategory::all();

        return view('whatis', compact('page', 'faqCategory'));
    }
    
    public function search(Request $request)
    {
        $query = Vehicle::query();

        foreach ($request->all() as $column => $value) {
            if ($value) {
                if (is_array($value)) {
                    if ($value[0] != null  && $value[0] != null)
                        $query->whereBetween($column, $value);
                } else {
                    $query->where($column, $value);
                }
            }
        }

        $query->with(['highBid' => function ($query) {
            $query->select('vehicle_id', DB::raw('MAX(bid) as highest_bid'))
                ->groupBy('vehicle_id');
        }]);



        return response()->json(['status' => $query->get()->isNotEmpty(), 'data' => $query->get(), 'url' => asset('/')]);
    }
    public function photos()
    {
        $page = Page::whereSlug('photography')->first();

        return view('photos', compact('page'));
    }

    public function wishlist()
    {
        $page = Page::whereSlug('home')->first();
        $vehcile = Auth::user()->wishlists()->active()->orderBy('expire', 'asc')->paginate(50);
        $all = Vehicle::new();
        $vechile = Auth::user()->wishlists()->active();
        return view('wishlist', compact('vechile', 'vehcile', 'all'));
    }

    public function support()
    {
        $page = Page::whereSlug('support')->first();

        return view('support', compact('page'));
    }
    public function shipping()
    {
        $page = Page::whereSlug('shipping')->first();

        return view('shipping', compact('page'));
    }
    public function inspection()
    {
        $page = Page::whereSlug('inspection')->first();

        return view('inspection', compact('page'));
    }
    public function crash()
    {
        $page = Page::whereSlug('home')->first();
        $vehcile = Vehicle::active()->where('crash', '!=', null)->orderBy('expire', 'asc')->paginate(50);
        $all = Vehicle::new();

        $body = BodyStyle::active()->get();
        $vechile = Vehicle::active()->where('crash', '!=', null);

        return view('welcome', compact('page', 'vehcile', 'body', 'vechile', 'all'));
    }
    public function vehicleDetail($slug)
    {
        $vechile = Vehicle::findBySlug($slug);
        $bid = Bid::where('vehicle_id', $vechile->id)
            ->where('bid', function ($query) use ($vechile) {
                $query->selectRaw('MAX(bid)')
                    ->from('bids')
                    ->where('vehicle_id', $vechile->id);
            })
            ->first();
        $count = 0;
        $bid_count = Bid::where('vehicle_id', $vechile->id)->count();
        $comment_count = Comment::where('vehicle_id', $vechile->id)->count();
        $all = Vehicle::new();
        $comments = Comment::where('vehicle_id', $vechile->id)->get();
        $vechile->views = $vechile->views + 1;
        $vechile->save();
        $questions = SellerQA::where('vehicle_id', $vechile->id)->whereType('question')->get();
        return view('vehicle.detail', compact('vechile', 'all', 'comments', 'bid', 'bid_count', 'comment_count', 'questions'));
    }


    public function blank()
    {

        return view('blank');
    }

    public function profile($id)
    {
        $user = User::find($id);
        $likes_count = $user->whereHas('comment', function ($query) {
            $query->with('like');
        });
        $count = $likes_count->count();

        return view('profile', compact('user', 'count'));
    }
}

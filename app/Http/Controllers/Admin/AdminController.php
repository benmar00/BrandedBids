<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Page;
use App\Models\Inquiry;
use App\Models\BodyStyle;
use App\Models\Vehicle;
use App\Models\Bid;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $banner = Banner::all();
        $page = Page::all();
        $inquiry = Inquiry::all();
        $product = Vehicle::all();
        $bids = Bid::all();
        $category = BodyStyle::all();
        return view('admin.dashboard', compact('banner', 'page', 'inquiry', 'category', 'product','bids'));
    }
    public function profile()
    {
        return view('admin.profile');
    } public function settings()
    {
        return view('admin.settings');
    }
    public function bid()
    {
        if(Auth::user()->hasRole('customer'))
        {
            $data = Bid::whereHas('vehicle', function ($query) {
                $query->where('seller_id', Auth::user()->id);
            })->paginate(12);
        }
        else{
            $data = Bid::paginate(12);
        }
        return view('admin.bid.index', compact('data'));
    }

}

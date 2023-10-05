<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite, Auth;
use App\Models\{User, Comment, Bid, Vehicle, SellerQA, Flagged, Like, Make, SettingCheck};
use App\Notifications\{CommentNotification, VehicleNotification};
use Hash, File, Carbon, DB, Mail;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $include;
    public function __construct()
    {
        $this->include = [
            'index' => ['heading' => 'Dashboard', 'include' => 'user.include.dashboard'],
            'settings' => ['heading' => 'Account Settings', 'include' => 'user.include.settings'],
            'listings' => ['heading' => 'Listings', 'include' => 'user.include.listings'],
            'vehicleupload' => ['heading' => 'Add Vehicle', 'include' => 'user.forms.vehicleupload'],
            'steptwo' => ['heading' => 'Add Vehicle', 'include' => 'user.forms.aboutcar'],
            'bids' => ['heading' => 'My Bids', 'include' => 'user.include.bids'],
        ];
    }
    private function returnView($page, $extra = [])
    {
        return view('user.app', $page + $extra);
    }
    public function settings()
    {
        $settings = SettingCheck::all();
        return  $this->returnView($this->include[__FUNCTION__], ['settings' => $settings]);
    }

    public function settingStatus(Request $request)
    {
        $checking = DB::table('setting_check_user')->where('user_id', $request->user_id)->where('setting_check_id', $request->setting_id)->first();
        // dd($request->all());

        if ($request->status == 1 && $checking == null) {
            DB::table('setting_check_user')->insert([
                'user_id' =>  $request->user_id,
                'setting_check_id' =>  $request->setting_id,
                'status' =>  $request->status,

            ]);
            return response()->json(['status' => true, 'message' => 'Setting Updated']);
        } else {
            $check = DB::table('setting_check_user')
                ->where('user_id', $request->user_id)
                ->where('setting_check_id', $request->setting_id)
                ->update(['status' => $request->status]);
            return response()->json(['status' => false, 'message' => 'Setting Updated']);
        }
    }

    public function submissionUpdateInspect(Request $request)
    {
        $vehcile = Vehicle::findBySlug($request->input('slug'));
        $vehcile->inspection = $request->input('value');

        $vehcile->save();

        return response()->json(['status' => true, 'message' => 'Updated successfully']);
    }

    public function submissionUpdate(Request $request)
    {

        $formData = $request->all();
        $vehcile = Vehicle::findBySlug($formData['slug']);
        $vehcile->loan = $formData['loan'];
        $vehcile->vin = $formData['vin'];
        $vehcile->year = $formData['year'];
        $vehcile->make_id = $formData['make'];
        $vehcile->model = $formData['model'];
        $vehcile->mileage = $formData['mileage'];
        $vehcile->transmission_mode = $formData['transmission_mode'];
        $vehcile->features = $formData['features'];
        $vehcile->equipment = $formData['equipment'];
        $vehcile->exterior_color = $formData['exterior_color'];
        $vehcile->interior_color = $formData['interior_color'];
        $vehcile->engine = $formData['engine'];
        $vehcile->history = $formData['history'];
        $vehcile->save();

        return response()->json(['status' => true, 'message' => 'Updated successfully']);
    }

    public function saveImage($path, $image)
    {
        $data = explode(',', $image);
        $base64Data = $data[1];
        $mimeInfo = finfo_open();
        $mimeType = finfo_buffer($mimeInfo, base64_decode($base64Data), FILEINFO_MIME_TYPE);
        finfo_close($mimeInfo);
        $imageTypes = [
            'image/jpeg' => ['jpg', 'jpeg'],
            'image/png' => ['png'],
            'image/gif' => ['gif'],
            'image/webp' => ['webp'],
            'image/bmp' => ['bmp'],
            'image/tiff' => ['tiff', 'tif'],
            'image/svg+xml' => ['svg'],
            'image/x-icon' => ['ico'],
        ];

        // Get the first extension for the MIME type
        $extension = isset($imageTypes[$mimeType]) ? $imageTypes[$mimeType][0] : 'unknown';
        $carimg = $path . uniqid() . '.' . $extension;
        Storage::disk('upload')->put($carimg, base64_decode($base64Data));

        return $carimg;
    }


    public function saveCar(Request $request)
    {

        $formData = $request->input('jsonData');
        $jsonData = $request->input('formData');

        $make = Make::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($formData['car']['make']) . '%'])->first();
        if (!$make) {
            $make = new Make;
            $make->name = $formData['car']['make'];
            $make->status = 1;
            $make->save();
        }


        $vechile = new Vehicle;
        $vechile->conditions =  '{"paint":"1","dents":"0","rust":"1"}';
        $vechile->videos =  '[]';
        $vechile->docphoto = '[]';
        $vechile->extra = '{}';
        $vechile->data = '{}';
        $vechile->dealer = '{}';
        
        $vechile->party = $formData['car']['party'];
        $vechile->name = $formData['car']['year'] . ' ' . $make->name . ' ' . $formData['car']['model'];
        $vechile->location = $formData['car']['location'];


        if (array_key_exists('lisenceimg', $formData) && $formData['lisenceimg'] !== '' && $formData['lisenceimg'] !== null) {
            $vechile->lisence = $this->saveImage('uploads/lisences/', $formData['lisenceimg']);
        }
        if ($formData['car']['location'] == 'CA') {
            $vechile->city = $formData['car']['city'];
        } else {
            $vechile->zip = $formData['car']['zip'];
        }
        $vechile->flaws = $formData['car']['flaw'];
        if ($formData['car']['flaw'] == 1) {
            $vechile->flaw_content = $formData['car']['flaw_content'];
        }
        $vechile->website = $formData['car']['website'];
        $vechile->model = $formData['car']['model'];
        $vechile->vin = $formData['car']['vin'];
        $vechile->year = $formData['car']['year'];
        $vechile->make_id = $make->id;
        $vechile->transmission_mode = $formData['car']['transmission_mode'];
        $vechile->mileage = $formData['car']['mileage'];
        $vechile->features = $formData['car']['features'];
        $vechile->modify = $formData['car']['modify'];
        $vechile->dealer = json_encode($formData['dealer']);
        $vechile->status = 0;
        $vechile->seller_id = Auth::user()->id;
        $vechile->title_status = $jsonData['data']['title']['title_status'];
        $vechile->data = json_encode($jsonData['data']);
        $imagesarray = [];
        foreach ($jsonData['images'] as $key => $item) {
            $carimg = $this->saveImage('uploads/vehicle/', $item);
            if ($key == 0) {
                $vechile->image = $carimg;
            } else {
                array_push($imagesarray, $carimg);
            }
        }

        if (count($imagesarray) > 0) {
            $vechile->images = json_encode($imagesarray);
        }
        
       
      
        
        
        
        $vechile->save();
        User::where('role', 1)->first()->notify(new VehicleNotification($vechile, Auth::user()));

        return response()->json(['status' => true, 'message' => 'Your car has been submitted', 'slug' => $vechile->slug, 'url' => route('car.submission', $vechile->slug)]);
    }
    public function submission($slug)
    {
        $item = Vehicle::findBySlug($slug);

        return view('user.forms.submission', compact('item'));
    }

    public function submissionUpdateFive(Request $request)
    {
        $vechile = Vehicle::findBySlug($request->input('slug'));
        $imagesarray = [];
        foreach ($request->input('images') as $item) {
            array_push($imagesarray, $this->saveImage('uploads/addphotos/', $item));
        }
        if (count($imagesarray) > 0) {
            $vechile->images = json_encode(array_merge(json_decode($vechile->images, true), $imagesarray));
        }
        $vechile->videos = json_encode($request->input('videos'));

        $vechile->save();
        return response()->json(['status' => true, 'message' => "Form Submitted Successfully"]);
    }

    public function submissionUpdateFour(Request $request)
    {
        $item = Vehicle::findBySlug($request->input('slug'));
        $item->serv_history = json_encode($request->input('serv_history'));
        $item->modify = $request->input('modify');
        $item->flaws = $request->input('flaws');
        $alljson = json_decode($item->extra, true);
        $item->extra = json_encode($alljson);
        $item->issues = json_encode($request->input('issues'));
        $item->conditions = json_encode($request->input('condition'));
        $item->save();
        return response()->json(['status' => true, 'message' => "Form Submitted Successfully"]);
    }

    public function submissionUpdateEight(Request $request)
    {
        $review = [];
        $vechile = Vehicle::findBySlug($request->input('slug'));
        $vechile->schedule = $request->input('value');
        $review['reserve'] = $request->input('reserve');
        $review['privacy'] = $request->input('privacy');
        $vechile->review = json_encode($review);
        $vechile->save();
        return response()->json(['status' => true, 'message' => "Form Submitted Successfully"]);
    }
    public function submissionUpdateSeven(Request $request)
    {
        $vechile = Vehicle::findBySlug($request->input('slug'));
        $vechile->schedule = $request->input('value');
        $vechile->save();
        return response()->json(['status' => true, 'message' => "Form Submitted Successfully"]);
    }
    public function submissionUpdateSix(Request $request)
    {
        $vechile = Vehicle::findBySlug($request->input('slug'));


        $imagesarray = [];
        foreach ($request->input('images') as $item) {
            $carimg =  'uploads/doucument_photos/' . uniqid() . '.png';
            Storage::disk('upload')->put($carimg, base64_decode($item));

            array_push($imagesarray, $carimg);
        }
        if (count($imagesarray) > 0) {
            $vechile->docphoto = json_encode($imagesarray);
        }

        $vechile->save();
        return response()->json(['status' => true, 'message' => "Form Submitted Successfully", "route" => route('home')]);
    }


    public function past()
    {
        $page = Page::whereSlug('home')->first();
        $filter = [
            'ended' => Vehicle::active()->where('expire', '<=', now())->get(),
            'low_mile' => Vehicle::active()->where('expire', '<=', now())->orderBy('mileage', 'ASC')->get(),
            'high_mile' =>   Vehicle::active()->where('expire', '<=', now())->orderBy('mileage', 'DESC')->get(),
            'low_price' => Vehicle::active()->where('expire', '<=', now())->orderBy('starting_bid', 'ASC')->get(),
            'high_price' => Vehicle::active()->where('expire', '<=', now())->orderBy('starting_bid', 'DESC')->get(),
        ];
        $vehcile = Vehicle::active()->where('expire', '<=', now());

        $body = BodyStyle::active()->get();



        return view('past_auc', compact('page', 'filter', 'body'));
    }

    public function searchForm(Request $request)
    {
        $query = Vehicle::query();

        $query->whereHas('make', function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        });
        foreach (['name', 'exterior_color', 'interior_color', 'transmission_mode', 'year'] as $column) {
            $query->orWhere($column, 'LIKE', '%' . $request->search . '%');
        }
        $page = Page::whereSlug('home')->first();
        $all = Vehicle::new();

        $body = BodyStyle::active()->get();


        $vechile = $query->active();
        $vehcile = $vechile->orderBy('expire', 'asc')->paginate(50);
        return view('welcome', compact('page', 'vehcile', 'body', 'vechile', 'all'));
    }
    public function highbid(Request $request)
    {
        $vechile = Vehicle::find($request->input('vechile'));
        $highbid = Bid::where('vehicle_id', $request->input('vechile'))->latest()->first();
        $highbid->user->increment('win');
        $checking = DB::table('setting_check_user')->where('user_id', $user->id)->where('setting_check_id', 7)->first();
        if ($checking != null) {
            $status = $checking->status;
        } else {
            $status = 0;
        }

        if ($highbid) {
            if ($status == 1) {
                $vechile->users->each(function ($user) use ($vechile, $highbid) {
                    $user->notify(new BidsNotification($vechile, $highbid->bid));
                });
            }
            return response()->json(['status' => true, 'bid' => $highbid->bid, 'name' => ucwords($highbid->user->name)]);
        } else {
            return response()->json(['status' => false, 'message' => 'Auction has ended']);
        }
    }


    public function editProfile(Request $request)
    {

        $user = User::find($request->user_id);
        // dd($request->all());
        $user->bio = $request->bio;
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/faq')) or File::makeDirectory(public_path('uploads/faq'), 0777, true, true);

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/faq'), $fileName);
            $user->image = 'uploads/faq/' . $fileName;
        }
        $user->save();
        return back()->with('success', 'Profie Updated');
    }

    public function changePass(Request $request)
    {
        $user = User::find($request->user_id);
        if ($request->password == $request->cpassword) {
            $user->password = FacadesHash::make($request->password);
            $user->save();
            return back()->with('success', 'Password Changed Successfully');
        } else {
            return back()->with('danger', 'Passwords are not same');
        }
    }

    public function listings()
    {
        return  $this->returnView($this->include[__FUNCTION__]);
    }

    public function vehicleupload()
    {
        return  $this->returnView($this->include[__FUNCTION__]);
    }

    public function steptwo()
    {
        return  $this->returnView($this->include[__FUNCTION__]);
    }

    public function index()
    {
        return $this->returnView($this->include[__FUNCTION__]);
    }

    public function bids()
    {
        return $this->returnView($this->include[__FUNCTION__]);
    }
    public function allread()
    {
        Auth::user()->unreadNotifications->markAsRead();
        return redirect()->back();
    }
    public function accountUpdate(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $data = [
            'password' => Hash::make($request->input('password'))
        ];
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/faq')) or File::makeDirectory(public_path('uploads/faq'), 0777, true, true);

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/faq'), $fileName);
            $data['image'] = 'uploads/faq/' . $fileName;
        }
        Auth::user()->update($data);
        return redirect('/user/dashboard')->with('success', 'Account Settting Update');
    }

    public function redirectFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/user/dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password' => bcrypt('@Admin!23#')
                ]);

                Auth::login($newUser);

                return redirect('/user/dashboard');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function addtowishlist(Request $request)
    {
        $vehicleId = $request->input('vechile');
        $user = Auth::user();

        $vehicle = Vehicle::find($vehicleId);
        if ($vehicle) {
            // Check if the user is already attached to the vehicle
            if ($vehicle->users()->where('user_id', $user->id)->exists()) {
                // Detach the user from the vehicle
                $vehicle->users()->detach($user->id);
                return response()->json(['status' => false, 'message' => 'Removed to your wishlist']);
            } else {
                // Attach the user to the vehicle
                $vehicle->users()->attach($user);
                return response()->json(['status' => true, 'message' => 'Added to your wishlist']);
            }
        }
        return response()->json(['status' => false, 'message' => 'Vehcile not found.']);
    }
    public function ask(Request $request)
    {
        SellerQA::create([
            'vehicle_id' => $request->input('vechile'),
            'user_id' => Auth::user()->id,
            'question_id' => 0,
            'type' => 'question',
            'content' => $request->input('question')
        ]);
        return redirect()->back()->with('success', 'Question Posted successfully!');
    }

    public function flag(Request $request)
    {
        $flag = Flagged::where('comment_id', $request->input('comment'))->where('user_id', Auth::user()->id);
        if ($flag->exists()) {
            $flag->delete();
            return response()->json(['status' => true, 'message' => 'Unmarked as inapporiated flag']);
        } else {
            Flagged::create([
                'comment_id' => $request->input('comment'),
                'user_id' => Auth::user()->id
            ]);
            return response()->json(['status' => false, 'message' => 'Marked as inapporiated flag']);
        }
    }

    public function sellerqa($slug)
    {
        $qas = Vehicle::findBySlug($slug)->qas()->where('type', 'question')->get();

        return view('admin.vehicle.qas', compact('qas'));
    }

    public function reply(Request $request)
    {
        $comment = new Comment;
        $comment->comment = $request->input('comment');
        $comment->reply_id = $request->input('reply_id');
        $comment->user_id = Auth::user()->id;
        $comment->vehicle_id = $request->input('vechile');
        $comment->save();
        $user = $comment->reply->user_id;
        $to = User::find($user);
        $from_id = Auth::user()->id;
        $from = User::find($from_id);
        $car_id = $comment->vehicle_id;
        $car = Vehicle::find($car_id);
        // dd($user);


        $to->notify(new CommentNotification($to, $from, $comment, $car));

        return response()->json(['status' => true, 'message' => 'Suceessfuly Replied!', 'image' => Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/default.png'), 'name' => Auth::user()->name, 'date' => Carbon::now()->diffForHumans(), 'from' => $comment->reply->user->name]);
    }
    public function answer(Request $request)
    {
        SellerQA::create([
            'vehicle_id' => $request->input('vechile_id'),
            'user_id' => Auth::user()->id,
            'question_id' => $request->input('question_id'),
            'type' => 'answer',
            'content' => $request->input('content')
        ]);
        return redirect()->back()->with('success', 'You answered the given question');
    }
    public function handleGoogleCallback()
    {


        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect('/user/dashboard');
            } else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,
                    'role' => 2,
                    'google_id' => $user->id,
                    'password' => bcrypt('@Admin!23#')


                ]);

                Auth::login($newUser);

                return redirect('/user/dashboard');
            }
        } catch (Exception $e) {

            return redirect('dashboard');
        }
    }

    public function comment(Request $request)
    {
        $vehicle = Vehicle::find($request->vehcile);
        $user = User::find($vehicle->seller_id);
        $checking = DB::table('setting_check_user')->where('user_id', $user->id)->where('setting_check_id', 14)->first();
        $checking2 = DB::table('setting_check_user')->where('user_id', $user->id)->where('setting_check_id', 8)->first();
        $from = User::find(Auth::user()->id);
        // dd($checking);

        $comment = Comment::create([
            'user_id' => Auth::user()->id,
            'comment' => $request->comment,
            'vehicle_id' => $request->vehcile
        ]);
        if ($checking2 != null) {
            $status2 = $checking->status;
        } else {
            $status2 = 0;
        }

        if ($status2 == 1) {
            $user->notify(new CommentNotification($user, $from, $comment, $vehicle));
        }


        if ($checking != null) {
            $status = $checking->status;
        } else {
            $status = 0;
        }

        if ($status == 1) {
            $emails = $user->email;

            $data = [
                'user_id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'comment' => $request->comment,
                'vehicle' => $vehicle->name,
                'slug' => $vehicle->slug,
                'vehicle_id' => $request->vehcile
            ];
            $subject = 'NEW COMMENT - BRANDED BIDS';
            Mail::send('commentmail', $data, function ($message) use ($emails, $subject) {
                $message->from(config('services.mail.username'), 'NEW COMMENT - BRANDED BIDS');
                $message->to($emails)->subject($subject);
            });
        }


        return response()->json(['status' => true, 'message' => 'Comment Successfully.', 'image' => Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/default.png'), 'name' => Auth::user()->name, 'date' => Carbon::now()->diffForHumans()]);
    }

    public function reputation(Request $request)
    {
        // dd($request->all());

        $like = Like::where('user_id', $request->user_id)->where('comment_id', $request->comment_id);
        if ($like->exists()) {
            $like->delete();
            $count = Like::where('comment_id', $request->comment_id)->count();
            return response()->json(['status' => true, 'message' => 'Reputation Updated', 'count' => $count, 'like' => false]);
        } else {
            Like::create([
                'user_id' => $request->user_id,
                'comment_id' => $request->comment_id,
                'vehicle_id' => $request->vehicle_id
            ]);
            $count = Like::where('comment_id', $request->comment_id)->count();
            return response()->json(['status' => true, 'message' => 'Reputation Updated Successfully.', 'count' => $count, 'like' => true]);
        }
    }

    public function bid(Request $request)
    {
        $bid = Bid::where('vehicle_id', $request->vehile_id)->max('bid');
        if ($bid == null) {

            $bid = Vehicle::find($request->vehile_id)->starting_bid;
        }

        if ($request->bid > $bid) {
            $card_number = str_replace(' ', '', $request->card_number);
            $user = User::find($request->user_id);
            $user->is_bidder = 1;
            $user->name_card = $request->card_holders_name;
            $user->zip_code = $request->zip_code;
            $user->card_number = $card_number;
            $user->expiry_month = $request->expiry_month;
            $user->expiry_year = $request->expiry_year;
            $user->cvc = $request->cvc;
            $user->phone = $request->phone;
            $user->save();



            Bid::create([
                'vehicle_id' => $request->vehile_id,
                'user_id' => $request->user_id,
                'bid' => $request->bid
            ]);
            return response()->json(['status' => true, 'message' => 'Comment Successfully.', 'image' => Auth::user()->image ? asset(Auth::user()->image) : asset('front/images/default.png'), 'name' => Auth::user()->name, 'date' => Carbon::now()->diffForHumans(), 'amount' => $request->bid]);
        } else {
            return response()->json(['status' => false, 'message' => 'Please Bid a High Price']);
        }
    }


    public function login(Request $request)
    {
        $input = $request->all();
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required',
            ]
        );
        if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } else if (Auth::user()->role == 2) {
                return redirect()->route('user.dashboard');
            }
        } else {
            return redirect()->back()->withErrors(['msg' => 'Email and Password are wrong']);
        }
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Schema;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;

use File, Auth;
use App\Notifications\VehicleNotification;
use Mail;
use App\Models\{Vehicle, Make, BodyStyle};
use Illuminate\Http\Request;
use App\Models\User;
class VehicleController extends Controller
{

    public function removeColumns($columns, $columsToBeRemove)
    {
        foreach ($columsToBeRemove as $value) {
            if (($key = array_search($value, $columns)) !== false) {
                unset($columns[$key]);
            }
        }
        return $columns;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $data = new Vehicle();

        if ($search != null) {
            $query = Vehicle::query();

            $table = $data->getTable();

            $columns = $this->removeColumns(Schema::getColumnListing($table), ['created_at', 'updated_at', 'image', 'id']);

            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $search . '%');
            }

            $data = $query->orderBy('name')->paginate(12);

            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        } else {
            if (Auth::user()->hasRole('customer')) {
                $data = $data->where('seller_id', Auth::user()->id);
            }
            $data = $data->paginate(12);
            if ($request->onChange == true) {
                return response()->json(['status' => true, 'data' => $data, 'lastPage' => $data->lastPage()]);
            }
        }


        return view('admin.vehicle.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    
    public function acceptcar(Request $request)
    {
        $car = Vehicle::find($request->input('id'));
            
        $data = [
            'car' => $car->name,
            'link' => route('vehicleDetail',$car->slug)
            ];
         $subject = 'Your Car is accepted';
            Mail::send('caracceptmail', $data, function ($message) use ($subject, $car) {
                $message->from(config('services.mail.username'), 'BRANDED BIDS');
                $message->to($car->seller->email)->subject($subject);
            });
            $car->accept = 1;
            $car->save();
            return response()->json(['status' => true, 'message' => 'Car Accepted! sent email notification to seller']);
    }
     
    public function deleteVideo(Request $request)
    {
        $data = Vehicle::find($request->input('id'));
        $videos = json_decode($data->videos,true);
        if (($key = array_search($request->input('video'), $videos)) !== false) {
            unset($videos[$key]);
        }
        $data->videos = json_encode($videos);
        $data->save();
        return response()->json(['status'=>true,'message'=>'This value is deleted successfuly.']);



    }
    public function create()
    {
        $bodystyle = BodyStyle::all();
        $make = Make::all();
        $data = null;
        return view('admin.vehicle.create', compact('data', 'make', 'bodystyle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'make_id' => 'required',
            'name' => 'required',
            'mileage' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'vin' => 'required',
            'image' => 'required'
        ]);
        $request->request->remove('_token');
        $data = $request->input();
        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/vehicle')) or File::makeDirectory(public_path('uploads/vehicle'), 0777, true, true);

            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/vehicle'), $fileName);
            $data['image'] = 'uploads/vehicle/' . $fileName;
        }
        if ($request->hasFile('gallery')) {
            $productImages = [];
            foreach ($request->file('gallery') as $key => $file) {

                $fileName = time() . '_' . strval($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/vehicle'), $fileName);

                array_push($productImages, 'uploads/vehicle/' . $fileName);
            }
            $data = array_merge($data, ['images' => json_encode($productImages)]);
            // dd($data);
        }
        if ($request->hasFile('crashgallery')) {
            $productImages = [];
            foreach ($request->file('crashgallery') as $key => $file) {

                $fileName = time() . '_' . strval($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/vehicle'), $fileName);

                array_push($productImages, 'uploads/vehicle/' . $fileName);
            }
            $data = array_merge($data, ['crash' => json_encode($productImages)]);
            // dd($data);
        }
        $videos = [];
        foreach ($request->videos as $value) {
            array_push($videos, $value);

        }
        $data['videos'] = json_encode($videos);
        $vechile = Vehicle::create($data);
    
        $vechile->save();
        

        User::where('role',1)->first()->notify(new VehicleNotification($vechile, Auth::user()));

        return redirect('admin/vehicle')->with('success', 'Vehicle added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */

     public function details($id)
     {
        $item = Vehicle::find($id);
        return view('admin.vehicle.details',compact('item'));

     }

    public function edit($id)
    {

        $bodystyle = BodyStyle::all();
        $data = Vehicle::findOrFail($id);

        $make = Make::all();
        if (Auth::user()->hasRole('customer')) {
            if ($data->seller_id == Auth::user()->id) {
                return view('admin.vehicle.create', compact('data', 'make', 'bodystyle'));
            } else {
                return abort('403');
            }
        } else {
            return view('admin.vehicle.create', compact('data', 'make', 'bodystyle'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Vehicle $vehicle)
    {

        $this->validate($request, [
            'make_id' => 'required',
            'year' => 'required|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'name' => 'required',
            'mileage' => 'required',
            'vin' => 'required'
        ]);

        $request->request->remove('_token');
        $request->request->remove('_method');
        $data = $request->input();

        if ($request->hasFile('image')) {
            File::isDirectory(public_path('uploads/vehicle')) or File::makeDirectory(public_path('uploads/vehicle'), 0777, true, true);
            if (File::exists(public_path($vehicle->image))) {
                File::delete(public_path($vehicle->image));
            }
            $fileName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/vehicle'), $fileName);
            $data['image'] = 'uploads/vehicle/' . $fileName;
        }

        if ($request->hasFile('gallery')) {
            $productImages = [];
            foreach ($request->file('gallery') as $key => $file) {
                $fileName = time() . '_' . strval($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/vehicle'), $fileName);
                array_push($productImages, 'uploads/vehicle/' . $fileName);
            }
            // Merge the new gallery images with the existing oness
            $currentImages = json_decode($vehicle->images) ?? [];
            $updatedImages = array_merge($currentImages, $productImages);
            $data['images'] = $updatedImages;
        }
        if ($request->hasFile('crashgallery')) {
            $productImages = [];
            foreach ($request->file('crashgallery') as $key => $file) {
                $fileName = time() . '_' . strval($key + 1) . '.' . $file->extension();
                $file->move(public_path('uploads/vehicle'), $fileName);
                array_push($productImages, 'uploads/vehicle/' . $fileName);
            }
            // Merge the new gallery images with the existing oness
            $currentImages = json_decode($vehicle->crash) ?? [];
            $updatedImages = array_merge($currentImages, $productImages);
            $data['crash'] = $updatedImages;
        }
       
        if($request->videos)
        {
             $videos = [];
             foreach ($request->videos as $value) {
                array_push($videos, $value);

            }
            $vehicle->videos = json_encode($videos);

        }
       

        $vehicle->update($data);




        return redirect()->back()->with('success', 'Vehicle Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Vehicle $vehicle)
    {

        $status = $vehicle->status;
        if ($status == 0) {
            $vehicle->status = 1;
            $message = 'Deactive';
        } else {
            $vehicle->status = 0;
            $message = 'Active';
        }
        $vehicle->save();

        return redirect()->back()->with('success', 'Vehicle ' . $message);
    }

    public function deleteImages(Request $request)
    {
        if (File::exists(public_path($request->input('path')))) {
            File::delete(public_path($request->input('path')));
        }

        $vehicle = Vehicle::find($request->input('key'));
        $imagesArray = json_decode($vehicle->images, true);

        if (($key = array_search($request->input('path'), $imagesArray)) !== false) {
            unset($imagesArray[$key]);
        }

        $vehicle->update(['images' => json_encode($imagesArray)]);

        return response()->json(['status' => true]);
    }
    public function crashDeleteImages(Request $request)
    {
        if (File::exists(public_path($request->input('path')))) {
            File::delete(public_path($request->input('path')));
        }

        $vehicle = Vehicle::find($request->input('key'));
        $imagesArray = json_decode($vehicle->crash, true);

        if (($key = array_search($request->input('path'), $imagesArray)) !== false) {
            unset($imagesArray[$key]);
        }

        $vehicle->update(['crash' => json_encode($imagesArray)]);

        return response()->json(['status' => true]);
    }
}

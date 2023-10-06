<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\{
    HomeController,
    CartController,
    SuperAdminController,
    UserController,
};
use App\Http\Controllers\Admin\{
    AdminController,
    AttributeController,
    ConfigController,
    BannerController,
    ProductController,
    CategoryController,
    CustomerController,
    PermissionsController,
    PageController,
    InquiryController,
    RolesController,
    VehicleController
};

use App\Models\{Inquiry, Vehicle};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();


Route::get('/', [HomeController::class, 'index'])->name('home');
// search vechile
Route::get('/search-vechile', [HomeController::class, 'search'])->name('search.vechile');

Route::get('/sell-a-car', [HomeController::class, 'sellacar'])->name('sellacar');
Route::get('/past-results', [HomeController::class, 'past'])->name('past');
Route::get('/why-cars-and-bids', [HomeController::class, 'whycars'])->name('whycars');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/photography', [HomeController::class, 'photos'])->name('photos');
Route::get('/support', [HomeController::class, 'support'])->name('support');
Route::get('profile/{id}', [HomeController::class, 'profile'])->name('profile');

Route::get('/shipping', [HomeController::class, 'shipping'])->name('shipping');
Route::get('/inspection', [HomeController::class, 'inspection'])->name('inspection');
Route::get('/vehicle-detail/{slug}', [HomeController::class, 'vehicleDetail'])->name('vehicleDetail');
Route::get('/blank', [HomeController::class, 'blank'])->name('blank');
Route::get('crash-gallery',[HomeController::class, 'crash'])->name('crash-gallery');

//Facebook Login
Route::get('/redirect', [UserController::class, 'redirectFacebook']);
Route::get('/callback', [UserController::class, 'facebookCallback']);
//Google Login
Route::get('auth/google', [UserController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [UserController::class, 'handleGoogleCallback']);

Route::post('highbid', [HomeController::class, 'highbid'])->name('highbid');

Route::get('search',[HomeController::class, 'searchForm'])->name('searchForm');
Route::get('test',[HomeContusroller::class, 'test'])->name('test');



Route::post('/inquiry-submit', [InquiryController::class, 'submit'])->name('inquiry.submit');




Route::group(['middleware' => ['auth', 'isSuper']], function () {
    //Category
    Route::resource('category', CategoryController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('roles', RolesController::class);
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {

    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');

    Route::get('/crud-generator', [Hamdan\CrudGenerator\Controllers\ProcessController::class, 'getGenerator'])->name('generator');
    Route::post('process', [Hamdan\CrudGenerator\Controllers\ProcessController::class, 'postGenerator'])->name('postGenerator');
    // Config
    Route::group(['prefix' => 'config'], function () {
        Route::get('favicon', [ConfigController::class, 'favicon'])->name('admin.config.favicon');
        Route::get('logo', [ConfigController::class, 'logo'])->name('admin.config.logo');
        Route::get('settings', [ConfigController::class, 'configSettings'])->name('admin.config.settings');
        Route::post('update', [ConfigController::class, 'configPost'])->name('admin.config.post');
        Route::get('option', [ConfigController::class, 'configOption'])->name('admin.config.option');
        Route::post('add-new-config', [ConfigController::class, 'addNewConfig'])->name('add.new.config');
        Route::post('option/update', [ConfigController::class, 'configOptionUpdate'])->name('admin.config.option.update');
    });

    // Section Create
    Route::post('section-create', [PageController::class, 'sectionCreate'])->name('section.create');

    //Inquiry
    Route::get('inquiry', [InquiryController::class, 'index'])->name('inquiry.index');
    Route::get('inquiry-detail/{id}', [InquiryController::class, 'detail'])->name('inquiry.detail');

    // Banner
    Route::resource('banner', BannerController::class);

    //Category
    Route::resource('category', CategoryController::class);

    //Page
    Route::resource('page', PageController::class);

    //Product
    Route::resource('product', ProductController::class);


    //Delete Productimage
    Route::post('/product/delete-image', [ProductController::class, 'deleteImages'])->name('product.delete_img');

    //Attribute
    Route::resource('attribute', AttributeController::class);

    //Delete Attribute Value
    Route::post('/product/delete-attribute-value', [AttributeController::class, 'deleteAttrValue'])->name('attribute.deleteAttrValue');
    Route::post('/vehicle/delete-video', [VehicleController::class, 'deleteVideo'])->name('vehicleDetail.deleteVideo');

    Route::get('/vehicle-details/{id}',[VehicleController::class, 'details'])->name('admin.vehicleDetail');

    // Customer
    Route::resource('customer', CustomerController::class);

    require_once('crudweb.php');
});

Route::group(['middleware' =>  ['auth']], function () {
    Route::post('comment', [UserController::class, 'comment'])->name('comment');
    Route::post('reputation', [UserController::class, 'reputation'])->name('reputation');
    Route::post('bid', [UserController::class, 'bid'])->name('bid');
    Route::post('ask-a-question', [UserController::class, 'ask'])->name('ask.a.question');
    Route::post('answer-a-question', [UserController::class, 'answer'])->name('answer-question');
    Route::get('wishlist', [HomeController::class, 'wishlist'])->name('wishlist');

    Route::resource('vehicle', VehicleController::class);
    Route::post('/vehicle/delete-image', [VehicleController::class, 'deleteImages'])->name('vehicle.delete_img');
    Route::get('/bid', [AdminController::class, 'bid'])->name('admin.bid.index');

    Route::post('add-to-wishlist', [UserController::class, 'addtowishlist'])->name('add_to_wishlist');
    Route::post('/reply', [UserController::class, 'reply'])->name('reply');
    Route::post('/flag', [UserController::class, 'flag'])->name('flag');
    Route::post('/editProfile', [UserController::class, 'editProfile'])->name('editProfile');
    Route::get('/settingStatus', [UserController::class, 'settingStatus'])->name('settingStatus');
    Route::get('seller-qa/{slug}',[UserController::class, 'sellerqa'])->name('sellerqa');

    Route::get('/mark-all-read', [UserController::class, 'allread'])->name('allread');

    Route::post('/savecar', [UserController::class, 'saveCar'])->name('savecar');
    Route::get('/submission/{slug}',[UserController::class,'submission'])->name('car.submission');
    Route::post('/submission-update',[UserController::class,'submissionUpdate'])->name('car.submission.update');
    Route::post('/submission-update-four',[UserController::class,'submissionUpdateFour'])->name('car.submission.update.stepfour');
    Route::post('/submission-update-five',[UserController::class,'submissionUpdateFive'])->name('car.submission.update.stepfive');
    Route::post('/submission-update-six',[UserController::class,'submissionUpdateSix'])->name('car.submission.update.stepsix');
    Route::post('/submission-update-seven',[UserController::class,'submissionUpdateSeven'])->name('car.submission.update.stepseven');
    Route::post('/submission-update-eight',[UserController::class,'submissionUpdateEight'])->name('car.submission.update.stepeight');
    Route::post('/submission-update-inspect',[UserController::class,'submissionUpdateInspect'])->name('car.submission.update.inspect');



});

Route::group(['prefix' => 'user', 'as' => 'user.', 'middleware' =>  ['auth', 'isUser']], function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/bids', [UserController::class, 'bids'])->name('bids');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::get('/listings', [UserController::class, 'listings'])->name('listings');
    Route::get('/vehicleupload-step-one', [UserController::class, 'vehicleupload'])->name('vehicleupload');
    Route::get('/vehicleupload-step-two', [UserController::class, 'steptwo'])->name('vehicleupload.two');
    Route::post('/changePass', [UserController::class, 'changePass'])->name('changePass');

    Route::post('/account-update', [UserController::class, 'accountUpdate'])->name('update');
});

Route::group(['as' => 'product.'], function () {
    Route::get('shop', [CartController::class, 'shop'])->name('shop');
});

<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\DarkModeController;
use App\Http\Controllers\Backend\ColorSchemeController;

use App\Http\Controllers\Backend\BackendPageController;
use App\Http\Controllers\Backend\LogsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\ModelsController;
use App\Http\Controllers\Backend\GenerationsController;
use App\Http\Controllers\Backend\Sub_modelsController;
use App\Http\Controllers\Backend\PostsController;
use App\Http\Controllers\Backend\CustomersController;
use App\Http\Controllers\Backend\ContactsController;
use App\Http\Controllers\Backend\DealsController;
use App\Http\Controllers\Backend\DiscountsController;
use App\Http\Controllers\Backend\LevelMemberController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\PackagesController;

use App\Http\Controllers\Frontend\QrCodeController;
use App\Http\Controllers\Frontend\FrontendPageController;
use App\Http\Controllers\Frontend\SmsController;
use App\Http\Controllers\Frontend\PostController;
use App\Http\Controllers\Frontend\LevelandPrivilegeController;
use App\Http\Controllers\Frontend\PackagesAndDealsController;
use App\Http\Controllers\Frontend\PaymentAndCheckoutController;
use App\Http\Controllers\Frontend\SearchController;


use App\Http\Controllers\PaySolutionsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/payment/form/{order}', [PaySolutionsController::class, 'paymentform'])->name('payment.form');
Route::post('/create-payment', [PaySolutionsController::class, 'createPayment'])->name('payment.create');
Route::get('/payment/success', [PaySolutionsController::class, 'paymentSuccess'])->name('payment.success');
Route::get('/payment/fail', [PaySolutionsController::class, 'paymentFail'])->name('payment.fail');
Route::get('/payment/result', [PaySolutionsController::class, 'paymentResult'])->name('payment.result');
// This route will handle the return after payment
Route::get('/payment/return', [PaySolutionsController::class, 'handleReturn'])->name('payment.return');
// This route will handle the callback from the payment gateway
// Route::get('/payment/postback', [PaySolutionsController::class, 'handlePostBack'])->name('payment.postback');
// Route::match(['get', 'post'], '/payment/postback', [PaySolutionsController::class, 'handlePostBack'])->name('payment.postback');


// Route::post('/payment/postback', [PaySolutionsController::class, 'handlePostBack'])->name('payment.postback');

Route::post('/payment/postbacktest', [PaySolutionsController::class, 'handlePostBacktest'])->name('payment.postbacktest');
Route::post('/payment/back', [PaySolutionsController::class, 'handleBack'])->name('payment.back');

// Route::post('/test-post', function (Request $request) {
//     return response()->json(['message' => 'POST request works']);
// });








Route::post('/create-secure-link', [PaySolutionsController::class, 'createSecureLink'])->name('secure.link');
// Display the payment form
// Route::get('/payment', [PaySolutionsController::class, 'showForm'])->name('payment.form');
// Handle the payment submission
// Route::post('/payment', [PaySolutionsController::class, 'handlePayment'])->name('payment.submit');






Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');


// check if the SQL file exists

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "cache is cleared";
});
Route::get('/clear-route', function() {
    Artisan::call('route:clear');
    return "route is cleared";
});
Route::get('/clear-config', function() {
    Artisan::call('config:clear');
    return "config is cleared";
});
Route::get('/clear-view', function() {
    Artisan::call('view:clear');
    return "view is cleared";
});
Route::get('/clear-all', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "All is cleared";
});


// Route::get('/delete-cars-images', [SearchController::class, 'deleteCarsAndImages']);

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';

Route::controller(AuthController::class)->middleware('loggedin')->group(function() {
    Route::get('login', 'loginView')->name('login.index');
    Route::post('login', 'login')->name('login.check');
    Route::get('register', 'registerView')->name('register.index');
    Route::post('register', 'register')->name('register.store');
});

// Route::get('/login-page', [AuthController::class, 'loginView']);
// Route::post('/login', [AuthController::class, 'login']);


Route::controller(FrontendPageController::class)->group(function() {
        
});
// Route::post('/create-payment', [PaySolutionsController::class, 'createPayment']);
// Route::get('/create-payment', function () {
//     return view('frontend.create-payment');
// });


Route::middleware('sessionlogin')->group(function() {

    Route::controller(PostController::class)->group(function() {

        Route::post('/regiser-sellcar', 'carpostbrowse')->name('carpostbrowse');
        Route::post('/regiser-sellcar-submit', 'carpostbrowsesubmit')->name('carpostbrowsesubmit');
        Route::post('/carpost-upload-image', 'carpostuploadimage')->name('carpostuploadimage');
        Route::post('/carpost-delete-image', 'carpostdeleteimage')->name('carpostdeleteimage');

        Route::get('/regiser-sellcar-edit/{id}', 'carpostbrowseedit')->name('carpostbrowseedit');
        Route::post('/regiser-sellcar-edit-submit/{id}', 'carpostbrowseeditsubmit')->name('carpostbrowseeditsubmit');







        Route::get('/carpost-register-upload', 'carpostregistertestuploadPage')->name('carpostregistertestuploadPage');
        Route::post('/carpost-register-upload-submit', 'carpostregistertestuploadsubmitPage')->name('carpostregistertestuploadsubmitPage');
        
        Route::get('/carpost-register-upload-edit/{id}', 'carpostregistertestuploadeditPage')->name('carpostregistertestuploadeditPage');
        Route::post('/carpost-register-upload-edit-submit', 'carpostregistertestuploadeditsubmitPage')->name('carpostregistertestuploadeditsubmitPage');



        Route::post('/upload-image', 'upload')->name('upload.image');
        Route::post('/posts', 'store')->name('post.store');
        Route::get('/carpost-register-dragdrop', 'carpostregisterdragdropPage')->name('carpostregisterdragdropPage');
        Route::post('/carpost-register-dragdrop-action', 'carpostregisterdragdropactionPage')->name('carpostregisterdragdropactionPage');
        


        Route::post('/carpost-delete', 'carpostdeleteactionPage')->name('carpostdeleteactionPage');
        Route::post('/update-click-count/{car}', 'updateClickCount')->name('updaupdateClickCountteClickCount');
        Route::post('/carpost-renew', 'carpostrenewactionPage')->name('carpostrenewactionPage');
   




        Route::post('/carpost-select-brand', 'carpostSelectBrand')->name('carpostSelectBrand');
        Route::post('/carpost-select-model', 'carpostSelectModel')->name('carpostSelectModel');
        Route::post('/carpost-select-generations', 'carpostSelectGenerations')->name('carpostSelectGenerations');
        Route::post('/carpost-select-generations-year', 'carpostSelectGenerationsYear')->name('carpostSelectGenerationsYear');
        Route::post('/carpost-select-sub_models', 'carpostSelectSub_model')->name('carpostSelectSub_model');

        Route::get('/carpost-step1', 'carpoststep1Page')->name('carpoststep1Page');
        // Route::get('/carpost-register', 'carpostregisterPage')->name('carpostregisterPage');

        

        Route::post('/carpost-register', 'carpostregisterPage')->name('carpostregisterPage');
        Route::get('/carpost-register-edit/{post}', 'carpostregistereditPage')->name('carpostregistereditPage');
        Route::get('/carpost-register-success', 'carpostregistersuccessPage')->name('carpostregistersuccessPage');
        Route::post('/carpost-register-submit', 'carpostregisterSubmitPage')->name('carpostregisterSubmitPage');
        Route::post('/carpost-register-edit-submit', 'carpostregistereditubmitPage')->name('carpostregistereditubmitPage');
        Route::post('/exterior-upload', 'exteriorupload')->name('exteriorupload');
        Route::post('/exterior-rearrange', 'exteriorrearrange')->name('exteriorrearrange');
        Route::post('/exterior-delete', 'exteriordelete')->name('exteriordelete');
        Route::post('/interior-upload', 'interiorupload')->name('interiorupload');
        Route::post('/interior-rearrange', 'interiorrearrange')->name('interiorrearrange');
        Route::post('/interior-delete', 'interiordelete')->name('interiordelete');
        Route::post('/licenseplate-upload', 'licenseplateupload')->name('licenseplateupload');
        Route::post('/licenseplate-rearrange', 'licenseplaterearrange')->name('licenseplaterearrange');
        Route::post('/licenseplate-delete', 'licenseplatedelete')->name('licenseplatedelete');
    });

    Route::controller(FrontendPageController::class)->group(function() {

        Route::get('/profile', 'profilePage')->name('profilePage');
        Route::post('/update-reserve', 'updatereservePage')->name('updatereservePage');
        Route::post('/update-soldout', 'updatesoldoutAction')->name('updatesoldoutAction');
        Route::post('/update-contackback', 'updatecontackbackPage')->name('updatecontackbackPage');
        Route::post('/update-price', 'updatepricePage')->name('updatepricePage');
        Route::post('/updateMyDeal', 'updateMyDeal')->name('updateMyDeal');




        Route::get('/dev', 'DevelopPage')->name('DevelopPage');
        
        
        
        Route::get('/login-welcome', 'loginwelcomePage')->name('loginwelcomePage');
        Route::get('/edit-profile-first', 'editprofilePage_afterregis')->name('editprofilePage_afterregis');
        Route::get('/edit-profile', 'editprofilePage')->name('editprofilePage');
        Route::post('/edit-profile-action', 'editprofileactionPage')->name('editprofileactionPage');

        Route::get('/notification', 'notificationPage')->name('notificationPage');
        Route::get('/termcondition', 'termconditionPage')->name('termconditionPage');
        Route::get('/privacypolicy', 'privacypolicyPage')->name('privacypolicyPage');
        
        Route::get('/postcar-welcome', 'postcarwelcomePage')->name('postcarwelcomePage');
        Route::get('/postcar-welcome-dealer', 'postcarwelcomedealerPage')->name('postcarwelcomedealerPage');
        Route::get('/postcar-welcome-lady', 'postcarwelcomeladyPage')->name('postcarwelcomeladyPage');
        Route::get('/postcar', 'postcarPage')->name('postcarPage');
        Route::get('/carpost-step2', 'carpoststep2Page')->name('carpoststep2Page');
        Route::get('/carpost-step3', 'carpoststep3Page')->name('carpoststep3Page');
        Route::get('/carpost-step4', 'carpoststep4Page')->name('carpoststep4Page');
        
        Route::get('/profile-check', 'profilecheckPage')->name('profilecheckPage');
        Route::get('/profile-editcarinfo', 'profileeditcarinfoPage')->name('profileeditcarinfoPage');
        Route::get('/profile-expire', 'profileexpirePage')->name('profileexpirePage');
        Route::get('/profile-soldout', 'profilesoldoutPage')->name('profilesoldoutPage');
        Route::get('/performance', 'performancePage')->name('performancePage');
        Route::get('/performance-viewpost', 'performanceviewpostPage')->name('performanceviewpostPage');
        Route::get('/performance-view', 'performanceviewPage')->name('performanceviewPage');
        Route::get('/search-performance', 'searchperformance')->name('searchperformance');
        Route::get('/search-performanceviewpost', 'searchperformanceviewpost')->name('searchperformanceviewpost');
        Route::get('/search-performanceview', 'searchperformanceview')->name('searchperformanceview');
        // Route::get('/check-price', 'checkpricePage')->name('checkpricePage');
        Route::get('/customer-contact', 'customercontactPage')->name('customercontactPage');
        Route::get('/update-carprice', 'updatecarpricePage')->name('updatecarpricePage');

        // Route::post('/update-status', 'contactupdateStatus')->name('contactupdateStatus');
        Route::post('/updateContactStatus/{id}', 'updateContactStatus')->name('updateContactStatus');


        Route::get('/dealer-carpost-step1', 'dealercarpoststep1Page')->name('dealercarpoststep1Page');
        Route::get('/dealer-carpost-step2', 'dealercarpoststep2Page')->name('dealercarpoststep2Page');
        Route::get('/dealer-carpost-step3', 'dealercarpoststep3Page')->name('dealercarpoststep3Page');
        Route::get('/dealer-carpost-step4', 'dealercarpoststep4Page')->name('dealercarpoststep4Page');
        Route::get('/edit-carpost-step1', 'editcarpoststep1Page')->name('editcarpoststep1Page');
        Route::get('/edit-carpost-step2', 'editcarpoststep2Page')->name('editcarpoststep2Page');
        Route::get('/edit-carpost-step3', 'editcarpoststep3Page')->name('editcarpoststep3Page');
        Route::get('/edit-carpost-step4', 'editcarpoststep4Page')->name('editcarpoststep4Page');
        Route::get('/edit-dealer-carpost-step1', 'editdealercarpoststep1Page')->name('editdealercarpoststep1Page');
        Route::get('/edit-dealer-carpost-step2', 'editdealercarpoststep2Page')->name('editdealercarpoststep2Page');
        Route::get('/edit-dealer-carpost-step3', 'editdealercarpoststep3Page')->name('editdealercarpoststep3Page');
        Route::get('/edit-dealer-carpost-step4', 'editdealercarpoststep4Page')->name('editdealercarpoststep4Page');

        Route::get('/profilesearchmodel/{data}', 'profilesearchmodel')->name('profilesearchmodel');
        
        Route::get('/searchprofilepage', 'searchprofilePage')->name('searchprofilePage');
        Route::get('/searchprofilecheckpage', 'searchprofilecheckPage')->name('searchprofilecheckPage');
        Route::get('/searchprofileeditcarinfopage', 'searchprofileeditcarinfoPage')->name('searchprofileeditcarinfoPage');
        Route::get('/searchprofileexpirepage', 'searchprofileexpirePage')->name('searchprofileexpirePage');
        
        // Route::get('/searchprofileexpirepage', 'searchprofileexpirePage')->name('searchprofileexpirePage');
    });

    Route::controller(LevelandPrivilegeController::class)->group(function() {
        Route::get('/special-privileges', 'specialprivilegesPage')->name('specialprivilegesPage');
        Route::get('/seeall-tiers', 'seealltiersPage')->name('seealltiersPage');
        Route::get('/profile-member/{level}', 'profilememberPage')->name('profilememberPage');
    });
    Route::controller(PackagesAndDealsController::class)->group(function() {

        Route::get('/package-premium', 'packagepremiumPage')->name('packagepremiumPage');
        Route::get('/package-premium-detail', 'packagepremiumdetailPage')->name('packagepremiumdetailPage');
        Route::get('/package-premium-detail/{id}', 'packagepremiumdetailPage')->name('packagepremiumdetailPage');
        Route::get('/package-contact', 'packagecontactPage')->name('packagecontactPage');
        Route::post('/package-contact-submit', 'submitPackageContact')->name('submitPackageContact');



        Route::get('/your-package', 'yourpackagePage')->name('yourpackagePage');

        Route::get('/getcoupon', 'getcouponPage')->name('getcouponPage');

        Route::post('/adddealgroup-action', 'adddealgroupaction')->name('adddealgroupaction');
        Route::post('/updateMyDeal', 'updateMyDeal')->name('updateMyDeal');
        Route::post('/adddeal-action', 'adddealaction')->name('adddealaction');
        Route::post('/editprice-action', 'editpriceaction')->name('editpriceaction');
        Route::get('/special-deal', 'specialdealPage')->name('specialdealPage');
        Route::get('/special-adddeal', 'specialadddealPage')->name('specialadddealPage');
        Route::get('/special-changedeal', 'specialchangedealPage')->name('specialchangedealPage');
        Route::get('/special-selectdeal/{car}', 'specialselectdealPage')->name('specialselectdealPage');


        Route::post('/cart-select-district', 'cartselectdistrict')->name('cartselectdistrict');
        Route::post('/cart-select-subdistrict', 'cartselectsubdistrict')->name('cartselectsubdistrict');
        Route::get('/package', 'packagePage')->name('packagePage');
        Route::get('/orderpay/{order}', 'orderpayPage')->name('orderpayPage');
        Route::post('/orderpay-action', 'orderpayaction')->name('orderpayaction');
        Route::post('/cart', 'cartPage')->name('cartPage');
        Route::post('/cart-action', 'cartactionPage')->name('cartactionPage');
        Route::post('/apply-coupon', 'applyCouponAction')->name('applyCouponAction');


        
    });



    

    
    
    
    
    // Route::controller(PaymentAndCheckoutController::class)->group(function() {
        
    // });
    
});
Route::controller(SearchController::class)->group(function() {
    Route::get('/testdev', 'testdev')->name('testdev');
    Route::get('/convertcar', 'convertcar')->name('convertcar'); // New route for AJAX


    Route::get('/carsearch/{kw1?}/{kw2?}/{kw3?}/{kw4?}/{kw5?}', 'carsearchPage')->name('carsearchPage');
    
    Route::get('/get-brand-name/{id}', 'getBrandName')->name('getBrandName');
    Route::get('/get-model-name/{id}', 'getModelName')->name('getModelName');
    Route::get('/get-generation-name/{id}', 'getGenerationName')->name('getGenerationName');
    Route::get('/get-submodel-name/{id}', 'getSubmodelName')->name('getSubmodelName');
});



Route::get('/callback', [PackagesController::class, 'callbackAction'])->name('callbackAction');
Route::get('/notify', [PackagesController::class, 'notifyAction'])->name('notifyAction');


Route::get('login-system', [AuthController::class, 'backendLogin'])->name('backendLogin');
Route::get('loopidentity', [FrontendPageController::class, 'loopidentity'])->name('loopidentity');
Route::get('/generate-qrcode', [QrCodeController::class, 'index']);
Route::get("/clearsessioncustomer", [FrontendPageController::class, 'clearsessioncustomer']);
Route::get('/login', [FrontendPageController::class, 'loginPage'])->name('loginPage');
Route::get('/', [FrontendPageController::class, 'indexPage'])->name('indexPage');
Route::post('helpcaraction', [FrontendPageController::class, 'helpcaractionPage'])->name('helpcaractionPage');
Route::post('contactcaraction', [FrontendPageController::class, 'contactcaractionPage'])->name('contactcaractionPage');

Route::get('/logoutone', [FrontendPageController::class, 'logoutone_session'])->name('logoutone_session');
Route::get('/logoutall', [FrontendPageController::class, 'logoutall_session'])->name('logoutall_session');

Route::get('/phpinfo', function () {
    return phpinfo();
});

Route::get('/news', [FrontendPageController::class, 'newsPage'])->name('newsPage');
Route::get('/news-detail/{slug}', [FrontendPageController::class, 'newsdetailPage'])->name('newsdetailPage');
Route::get('/car', [FrontendPageController::class, 'carPage'])->name('carPage');
Route::get('/empty', [FrontendPageController::class, 'emptyPage'])->name('emptyPage');

Route::get('/car-detail/{slug}', [FrontendPageController::class, 'cardetailPage'])->name('cardetailPage');

Route::get('/popup-carsearch-model/{id}', [FrontendPageController::class, 'popupcarsearchmodel'])->name('popupcarsearchmodel');
Route::get('/popup-carsearch-generation/{id}', [FrontendPageController::class, 'popupcarsearchgeneration'])->name('popupcarsearchgeneration');
Route::get('/popup-carsearch-submodel/{id}', [FrontendPageController::class, 'popupcarsearchsubmodel'])->name('popupcarsearchsubmodel');
Route::get('/popup-carsearch-year/{id}', [FrontendPageController::class, 'popupcarsearchyear'])->name('popupcarsearchyear');
Route::get('/searchbrandtext/{brand_name}', [FrontendPageController::class, 'searchbrandtext'])->name('searchbrandtext');
Route::get('/searchmodeltext/{brand_id}/{model_name}', [FrontendPageController::class, 'searchmodeltext'])->name('searchmodeltext');
Route::get('/searchgenerationtext/{model_id}/{generation_name}', [FrontendPageController::class, 'searchgenerationtext'])->name('searchgenerationtext');
Route::get('/searchsubmodeltext/{generation_id}/{submodel_name}', [FrontendPageController::class, 'searchsubmodeltext'])->name('searchsubmodeltext');
Route::get('/search/{brand_id}/{model_id}/{generation_id}/{submodel_id}/{evtype}/{payment}/{pricelow}/{pricehigh}/{color}/{gear}/{power}/{province_id}/{yearlow}/{yearhigh}',  [FrontendPageController::class, 'search'])->name('search');
Route::get('/search2',  [FrontendPageController::class, 'search2']);
Route::get('/brandev', [FrontendPageController::class, 'brandev'])->name('brandev');
Route::get('/brandnotev', [FrontendPageController::class, 'brandnotev'])->name('brandnotev');
Route::get('/search-category/{id}', [FrontendPageController::class, 'searchcategory'])->name('searchcategory');
Route::get('/check-price/{brand}/{model}', [FrontendPageController::class, 'checkprice'])->name('checkprice');
Route::get('/search-price/{brand_id}/{model_id}/{generation_id}/{price}', [FrontendPageController::class, 'searchprice'])->name('searchprice');
Route::get('/search-price2/{brand_id}/{model_id}/{generation_id}/{price}/{modelyear}', [FrontendPageController::class, 'searchprice2'])->name('searchprice2');
Route::get('/carpost-register', function(){
    return redirect('/');
});
Route::get('/updategeneration',  [FrontendPageController::class, 'updategeneration']);


Route::get('/test-pdf', function () {
    $pdf = PDF::loadHTML('<h1>Test PDF</h1>');
    return $pdf->stream();
});

Route::get('/backend/delete-admin-removed-cars', [BackendPageController::class, 'deleteAdminRemovedCars'])->name('delete.admin.removed.cars');



Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');        


    Route::get('/backend', [BackendPageController::class, 'backendDashboard'])->name('backendDashboard');
    Route::get('/backend/profile', [UsersController::class, 'BN_profile'])->name('BN_profile');
    Route::get('/backend/profile-edit', [UsersController::class, 'BN_profile_edit'])->name('BN_profile_edit');
    Route::post('/backend/profile-edit-action', [UsersController::class, 'BN_profile_edit_action'])->name('BN_profile_edit_action');


        
    Route::group(['middleware' => ['job_access']], function () {

        Route::prefix('backend')->group(function () {

            Route::prefix('orders')->group(function () {
                Route::get('', [OrdersController::class, 'BN_orders'])->name('BN_orders');
                Route::get('/{id}', [OrdersController::class, 'BN_order_detail'])->name('BN_order_detail'); // Add this line

                // New routes for generating documents
                Route::get('/generate-document/{id}/individual-receipt', [OrdersController::class, 'generateIndividualReceipt'])->name('generate.individual.receipt');
                Route::get('/generate-document/{id}/corporate-tax-invoice', [OrdersController::class, 'generateCorporateTaxInvoice'])->name('generate.corporate.tax.invoice');
                Route::get('/generate-document/{id}/short-receipt', [OrdersController::class, 'generateShortReceipt'])->name('generate.short.receipt');
        
            });

            Route::prefix('deals')->group(function () {
                Route::get('', [DealsController::class, 'BN_deals'])->name('BN_deals');
                Route::get('/add', [DealsController::class, 'BN_deals_add'])->name('BN_deals_add');
                Route::post('/add-action', [DealsController::class, 'BN_deals_add_action'])->name('BN_deals_add_action');
                Route::get('/edit/{id}', [DealsController::class, 'BN_deals_edit'])->name('BN_deals_edit');
                Route::put('/edit-action', [DealsController::class, 'BN_deals_edit_action'])->name('BN_deals_edit_action'); // Updated to PUT
                Route::get('/detail/{id}', [DealsController::class, 'BN_deals_detail'])->name('BN_deals_detail');
            });

            Route::prefix('packages')->group(function () {
                
                Route::get('', [PackagesController::class, 'BN_packages'])->name('BN_packages');
                Route::get('/edit/{type}/{id}', [PackagesController::class, 'BN_packages_edit'])->name('BN_packages_edit');
                Route::post('/edit-action', [PackagesController::class, 'BN_packages_edit_action'])->name('BN_packages_edit_action');
                Route::get('/detail/dealer/{id}', [PackagesController::class, 'BN_packages_detail_dealer'])->name('BN_packages_detail_dealer');
                Route::get('/detail/vip/{id}', [PackagesController::class, 'BN_packages_detail_vip'])->name('BN_packages_detail_vip');
    
            });

            Route::prefix('levels')->group(function () {

                Route::get('', [LevelMemberController::class, 'BN_levels'])->name('BN_levels');
                Route::get('/edit/{id}', [LevelMemberController::class, 'BN_levels_edit'])->name('BN_levels_edit');
                Route::post('/edit-action', [LevelMemberController::class, 'BN_levels_edit_action'])->name('BN_levels_edit_action');
                Route::get('/detail/{id}', [LevelMemberController::class, 'BN_levels_detail'])->name('BN_levels_detail');
            });

            Route::prefix('discounts')->group(function () {
                Route::get('', [DiscountsController::class, 'BN_discounts'])->name('BN_discounts');
                Route::get('/add', [DiscountsController::class, 'BN_discounts_add'])->name('BN_discounts_add');
                Route::post('/add-action', [DiscountsController::class, 'BN_discounts_add_action'])->name('BN_discounts_add_action');
                Route::get('/edit/{id}', [DiscountsController::class, 'BN_discounts_edit'])->name('BN_discounts_edit');
                Route::post('/edit-action', [DiscountsController::class, 'BN_discounts_edit_action'])->name('BN_discounts_edit_action');
                Route::get('/detail/{id}', [DiscountsController::class, 'BN_discounts_detail'])->name('BN_discounts_detail');
            });
            
            
            
            
            Route::prefix('customers')->group(function () {

                Route::get('', [CustomersController::class, 'BN_customers'])->name('BN_customers');
                Route::get('/fetch', [CustomersController::class, 'BN_customersFetch'])->name('BN_customersFetch');
                Route::get('/add', [CustomersController::class, 'BN_customers_add'])->name('BN_customers_add');
                Route::post('/add-action', [CustomersController::class, 'BN_customers_add_action'])->name('BN_customers_add_action');
                Route::get('/edit/{id}', [CustomersController::class, 'BN_customers_edit'])->name('BN_customers_edit');
                Route::post('/edit-action', [CustomersController::class, 'BN_customers_edit_action'])->name('BN_customers_edit_action');
                Route::get('/detail/{id}', [CustomersController::class, 'BN_customers_detail'])->name('BN_customers_detail');
                Route::get('/detail/package/{id}', [CustomersController::class, 'BN_customers_detail_package'])->name('BN_customers_detail_package');
                Route::get('/detail/deal/{id}', [CustomersController::class, 'BN_customers_detail_deal'])->name('BN_customers_detail_deal');

                Route::get('/register-vip/{id}', [CustomersController::class, 'BN_customers_register_vip'])->name('BN_customers_register_vip');
                Route::post('/register-vip-action', [CustomersController::class, 'BN_customers_register_vip_action'])->name('BN_customers_register_vip_action');

            });

            Route::prefix('posts')->group(function () {

                Route::get('', [PostsController::class, 'BN_posts'])->name('BN_posts');
                Route::get('add', [PostsController::class, 'BN_posts_add'])->name('BN_posts_add');
                Route::get('excelpostsell', [PostsController::class, 'BN_posts_excelpostsell'])->name('BN_posts_excelpostsell');
                Route::post('excelpostsell-store', [PostsController::class, 'BN_posts_excelpostsell_store'])->name('BN_posts_excelpostsell_store');
                Route::get('fetch', [PostsController::class, 'BN_postsFetch'])->name('BN_postsFetch');
                Route::post('add-action', [PostsController::class, 'BN_posts_add_action'])->name('BN_posts_add_action');
                Route::get('detail/{id}', [PostsController::class, 'BN_posts_detail'])->name('BN_posts_detail');
                Route::get('edit/{id}', [PostsController::class, 'BN_posts_edit'])->name('BN_posts_edit');
                Route::post('edit-action', [PostsController::class, 'BN_posts_edit_action'])->name('BN_posts_edit_action');
                Route::post('status-action', [PostsController::class, 'BN_posts_status_action'])->name('BN_posts_status_action');

            });

            Route::prefix('car')->group(function () {

                Route::get('', [BrandsController::class, 'BN_car'])->name('BN_car');

                Route::get('excelcars-add', [BrandsController::class, 'BN_excelcars_add'])->name('BN_excelcars_add');
                Route::post('excelcars-store', [BrandsController::class, 'BN_excelcars_store'])->name('BN_excelcars_store');

                Route::get('brands', [BrandsController::class, 'BN_brands'])->name('BN_brands');
                Route::get('brands-add', [BrandsController::class, 'BN_brands_add'])->name('BN_brands_add');
                Route::get('brands-edit/{id}', [BrandsController::class, 'BN_brands_edit'])->name('BN_brands_edit');
                Route::get('brands-delete/{id}', [BrandsController::class, 'BN_brands_delete'])->name('BN_brands_delete');
                Route::post('brands-add-action', [BrandsController::class, 'BN_brands_add_action'])->name('BN_brands_add_action');
                Route::post('brands-edit-action', [BrandsController::class, 'BN_brands_edit_action'])->name('BN_brands_edit_action');
                Route::get('brandsfetch', [BrandsController::class, 'BN_brandsFetch'])->name('BN_brandsFetch');
                Route::get('brands-preview/{id}', [BrandsController::class, 'BN_brands_preview'])->name('BN_brands_preview');

                // Route::get('brander/{$name}/{id}', [BrandsController::class, 'BN_brands_preview'])->name('BN_brands_preview');

                Route::get('models', [ModelsController::class, 'BN_carmd'])->name('BN_carmd');
                Route::get('models-add', [ModelsController::class, 'BN_carmd_add'])->name('BN_carmd_add');
                Route::get('models-edit/{id}', [ModelsController::class, 'BN_carmd_edit'])->name('BN_carmd_edit');
                Route::get('models-delete/{id}', [ModelsController::class, 'BN_carmd_delete'])->name('BN_carmd_delete');
                Route::post('models-add-action', [ModelsController::class, 'BN_carmd_add_action'])->name('BN_carmd_add_action');
                Route::post('models-edit-action', [ModelsController::class, 'BN_carmd_edit_action'])->name('BN_carmd_edit_action');
                Route::get('modelsfetch', [ModelsController::class, 'BN_carmdFetch'])->name('BN_carmdFetch');

                Route::get('generations', [GenerationsController::class, 'BN_generations'])->name('BN_generations');
                Route::get('generations-add', [GenerationsController::class, 'BN_generations_add'])->name('BN_generations_add');
                Route::post('generations-add-action', [GenerationsController::class, 'BN_generations_add_action'])->name('BN_generations_add_action');
                Route::get('generations-edit/{id}', [GenerationsController::class, 'BN_generations_edit'])->name('BN_generations_edit');
                Route::get('generations-delete/{id}', [GenerationsController::class, 'BN_generations_delete'])->name('BN_generations_delete');
                Route::post('generations-edit-action', [GenerationsController::class, 'BN_generations_edit_action'])->name('BN_generations_edit_action');
                Route::get('generationsfetch', [GenerationsController::class, 'BN_generationsFetch'])->name('BN_generationsFetch');

                Route::get('sub_models', [Sub_modelsController::class, 'BN_sub_models'])->name('BN_sub_models');
                Route::get('sub_models-add', [Sub_modelsController::class, 'BN_sub_models_add'])->name('BN_sub_models_add');
                Route::post('sub_models-add-action', [Sub_modelsController::class, 'BN_sub_models_add_action'])->name('BN_sub_models_add_action');
                Route::get('sub_models-delete/{id}', [Sub_modelsController::class, 'BN_sub_models_delete'])->name('BN_sub_models_delete');
                Route::get('sub_models-edit/{id}', [Sub_modelsController::class, 'BN_sub_models_edit'])->name('BN_sub_models_edit');
                Route::post('sub_models-edit-action', [Sub_modelsController::class, 'BN_sub_models_edit_action'])->name('BN_sub_models_edit_action');
                Route::get('sub_modelsfetch', [Sub_modelsController::class, 'BN_sub_modelsFetch'])->name('BN_sub_modelsFetch');

                // Route::get('generations', [BackendPageController::class, 'BN_generations'])->name('BN_generations');
                // Route::get('sub_models', [BackendPageController::class, 'BN_sub_models'])->name('BN_sub_models');

            });

            Route::prefix('categories')->group(function () {

                Route::get('', [CategoriesController::class, 'BN_categories'])->name('BN_categories');
                Route::get('add', [CategoriesController::class, 'BN_categories_add'])->name('BN_categories_add');
                Route::get('edit/{id}', [CategoriesController::class, 'BN_categories_edit'])->name('BN_categories_edit');
                Route::post('add-action', [CategoriesController::class, 'BN_categories_add_action'])->name('BN_categories_add_action');
                Route::post('edit-action', [CategoriesController::class, 'BN_categories_edit_action'])->name('BN_categories_edit_action');
                Route::get('fetch', [CategoriesController::class, 'BN_categoriesFetch'])->name('BN_categoriesFetch');

            });

            Route::prefix('tags')->group(function () {

                Route::get('', [BackendPageController::class, 'BN_tags'])->name('BN_tags');

            });

            Route::prefix('news')->group(function () {

                Route::get('', [NewsController::class, 'BN_news'])->name('BN_news');
                Route::get('add', [NewsController::class, 'BN_news_add'])->name('BN_news_add');
                // Route::post('add', [NewsController::class, 'store'])->name('BN_news_add_action');
                Route::post('/upload-image', [NewsController::class, 'uploadImage'])->name('upload.image');


                Route::get('edit/{id}', [NewsController::class, 'BN_news_edit'])->name('BN_news_edit');
                Route::post('add-action', [NewsController::class, 'BN_news_add_action'])->name('BN_news_add_action');
                Route::post('edit-action', [NewsController::class, 'BN_news_edit_action'])->name('BN_news_edit_action');
                Route::get('fetch', [NewsController::class, 'BN_newsFetch'])->name('BN_newsFetch');
                Route::get('index', [NewsController::class, 'BN_newsIndex'])->name('BN_newsIndex');
                Route::post('store', [NewsController::class, 'BN_news_store'])->name('BN_news_store');

                Route::delete('delete/{id}', [NewsController::class, 'BN_news_delete'])->name('BN_news_delete');

            });

            Route::prefix('users')->group(function () {

                Route::get('', [UsersController::class, 'BN_user'])->name('BN_user');
                Route::get('fetch', [UsersController::class, 'BN_usersFetch'])->name('BN_usersFetch');
                Route::get('add', [UsersController::class, 'BN_user_add'])->name('BN_user_add');
                Route::post('action', [UsersController::class, 'BN_user_add_action'])->name('BN_user_add_action');
                Route::get('edit/{id}', [UsersController::class, 'BN_user_edit'])->name('BN_user_edit');
                Route::post('edit-action', [UsersController::class, 'BN_user_edit_action'])->name('BN_user_edit_action');

            });

            Route::prefix('contactsvip')->group(function () {

                Route::get('', [ContactsController::class, 'BN_contactsvip'])->name('BN_contactsvip');

            });

            Route::prefix('contacts')->group(function () {

                Route::get('', [ContactsController::class, 'BN_contacts'])->name('BN_contacts');

            });

            Route::prefix('setting')->group(function () {
                Route::get('slide', [BackendPageController::class, 'BN_slide'])->name('BN_slide');
                Route::post('slide-update', [BackendPageController::class, 'BN_slideupdate'])->name('BN_slideupdate');
                Route::post('slide-delete', [BackendPageController::class, 'BN_slidedelete'])->name('BN_slidedelete');

                Route::get('main', [BackendPageController::class, 'BN_setting'])->name('BN_setting');
                
                Route::get('setfooter', [BackendPageController::class, 'BN_setfooter'])->name('BN_setfooter');
                Route::get('termcondition', [BackendPageController::class, 'BN_termcondition'])->name('BN_termcondition');
                Route::get('privacypolicy', [BackendPageController::class, 'BN_privacypolicy'])->name('BN_privacypolicy');
                
                Route::post('setfooter-update', [BackendPageController::class, 'BN_setfooterupdate'])->name('BN_setfooterupdate');
                Route::post('termcondition-update', [BackendPageController::class, 'BN_termcondition_update'])->name('BN_termcondition_update');
                Route::post('privacypolicy-update', [BackendPageController::class, 'BN_privacypolicy_update'])->name('BN_privacypolicy_update');

                Route::post('/bn-banner-update', [BackendPageController::class, 'BN_bannerUpdate'])->name('BN_bannerUpdate');

            });

            Route::prefix('logs')->group(function () {

                Route::get('', [LogsController::class, 'BN_logs'])->name('BN_logs');
                Route::get('fetch', [LogsController::class, 'BN_logsFetch'])->name('BN_logsFetch');

            });

            Route::prefix('dev')->group(function () {

                Route::get('', [BackendPageController::class, 'BN_dev'])->name('BN_dev');

            });

            
        });

    });

    





    
    
    

    
    

    

    


    

    

    

    

    

    
});
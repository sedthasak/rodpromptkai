<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\DarkModeController;
use App\Http\Controllers\Backend\ColorSchemeController;

use App\Http\Controllers\Backend\BackendPageController;
use App\Http\Controllers\Backend\LogsController;
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\NewsController;

use App\Http\Controllers\Frontend\QrCodeController;
use App\Http\Controllers\Frontend\FrontendPageController;

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
Route::get('dark-mode-switcher', [DarkModeController::class, 'switch'])->name('dark-mode-switcher');
Route::get('color-scheme-switcher/{color_scheme}', [ColorSchemeController::class, 'switch'])->name('color-scheme-switcher');

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

Route::middleware('sessionlogin')->group(function() {
    Route::controller(FrontendPageController::class)->group(function() {
        Route::get('/dev', 'DevelopPage')->name('DevelopPage');
        
        Route::get('/', 'indexPage')->name('indexPage');
        Route::get('/login', 'loginPage')->name('loginPage');
        Route::get('/login-welcome', 'loginwelcomePage')->name('loginwelcomePage');
        Route::get('/edit-profile-first', 'editprofilePage_afterregis')->name('editprofilePage_afterregis');
        Route::get('/edit-profile', 'editprofilePage')->name('editprofilePage');

        Route::get('/notification', 'notificationPage')->name('notificationPage');
        Route::get('/news', 'newsPage')->name('newsPage');
        Route::get('/news-detail', 'newsdetailPage')->name('newsdetailPage');
        Route::get('/postcar', 'postcarPage')->name('postcarPage');
        Route::get('/car', 'carPage')->name('carPage');
        Route::get('/car-detail', 'cardetailPage')->name('cardetailPage');
        Route::get('/postcar-welcome', 'postcarwelcomePage')->name('postcarwelcomePage');
        Route::get('/postcar-welcome-dealer', 'postcarwelcomedealerPage')->name('postcarwelcomedealerPage');
        Route::get('/postcar-welcome-lady', 'postcarwelcomeladyPage')->name('postcarwelcomeladyPage');
        Route::get('/carpost-step1', 'carpoststep1Page')->name('carpoststep1Page');
        Route::get('/carpost-step2', 'carpoststep2Page')->name('carpoststep2Page');
        Route::get('/carpost-step3', 'carpoststep3Page')->name('carpoststep3Page');
        Route::get('/carpost-step4', 'carpoststep4Page')->name('carpoststep4Page');
        Route::get('/profile', 'profilePage')->name('profilePage');
        Route::get('/profile-check', 'profilecheckPage')->name('profilecheckPage');
        Route::get('/profile-editcarinfo', 'profileeditcarinfoPage')->name('profileeditcarinfoPage');
        Route::get('/profile-expire', 'profileexpirePage')->name('profileexpirePage');
        Route::get('/performance', 'performancePage')->name('performancePage');
        Route::get('/performance-viewpost', 'performanceviewpostPage')->name('performanceviewpostPage');
        Route::get('/performance-view', 'performanceviewPage')->name('performanceviewPage');
        Route::get('/check-price', 'checkpricePage')->name('checkpricePage');
        Route::get('/customer-contact', 'customercontactPage')->name('customercontactPage');
        Route::get('/update-carprice', 'updatecarpricePage')->name('updatecarpricePage');

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
    });
});


Route::get('login-system', [AuthController::class, 'backendLogin'])->name('backendLogin');
Route::get('loopidentity', [\App\Http\Controllers\Frontend\FrontendPageController::class, 'loopidentity'])->name('loopidentity');
Route::get('/generate-qrcode', [QrCodeController::class, 'index']);




Route::middleware('auth')->group(function() {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');        

    Route::controller(BackendPageController::class)->group(function() {

        Route::get('/backend', 'backendDashboard')->name('backendDashboard');

        // Route::get('/backend/dev', 'BN_dev')->name('BN_dev');
        // Route::get('/backend/logs', 'BN_logs')->name('BN_logs');
        // Route::get('/backend/users', 'BN_user')->name('BN_user');
        // Route::get('/backend/news', 'BN_news')->name('BN_news');
        Route::get('/backend/setting', 'BN_setting')->name('BN_setting');
        Route::get('/backend/posts', 'BN_posts')->name('BN_posts');
        
        Route::get('/backend/tags', 'BN_tags')->name('BN_tags');
        
    });
    
    Route::get('/backend/dev', [BackendPageController::class, 'BN_dev'])->name('BN_dev');

    Route::get('/backend/logs', [LogsController::class, 'BN_logs'])->name('BN_logs');
    Route::get('/backend/logsfetch', [LogsController::class, 'BN_logsFetch'])->name('BN_logsFetch');
    Route::get('/backend/users', [UsersController::class, 'BN_user'])->name('BN_user');
    Route::get('/backend/usersfetch', [UsersController::class, 'BN_usersFetch'])->name('BN_usersFetch');
    Route::get('/backend/users-add', [UsersController::class, 'BN_user_add'])->name('BN_user_add');
    Route::post('/backend/users-add-action', [UsersController::class, 'BN_user_add_action'])->name('BN_user_add_action');
    Route::get('/backend/profile', [UsersController::class, 'BN_profile'])->name('BN_profile');
    Route::get('/backend/profile-edit', [UsersController::class, 'BN_profile_edit'])->name('BN_profile_edit');
    Route::post('/backend/profile-edit-action', [UsersController::class, 'BN_profile_edit_action'])->name('BN_profile_edit_action');

    Route::get('/backend/categories', [CategoriesController::class, 'BN_categories'])->name('BN_categories');
    Route::get('/backend/categories-add', [CategoriesController::class, 'BN_categories_add'])->name('BN_categories_add');
    Route::get('/backend/categories-edit/{id}', [CategoriesController::class, 'BN_categories_edit'])->name('BN_categories_edit');
    Route::post('/backend/categories-add-action', [CategoriesController::class, 'BN_categories_add_action'])->name('BN_categories_add_action');
    Route::post('/backend/categories-edit-action', [CategoriesController::class, 'BN_categories_edit_action'])->name('BN_categories_edit_action');
    Route::get('/backend/categoriesfetch', [CategoriesController::class, 'BN_categoriesFetch'])->name('BN_categoriesFetch');

    Route::get('/backend/news', [NewsController::class, 'BN_news'])->name('BN_news');
    Route::get('/backend/news-add', [NewsController::class, 'BN_news_add'])->name('BN_news_add');
    Route::get('/backend/newsfetch', [NewsController::class, 'BN_newsFetch'])->name('BN_newsFetch');


    Route::controller(PageController::class)->group(function() {
        // Route::get('/', 'backendDashboard')->name('backendDashboard');
        // Route::get('login-page', 'login')->name('login');
        Route::get('dashboard-overview-1-page', 'dashboardOverview1')->name('dashboard-overview-1');
        Route::get('dashboard-overview-2-page', 'dashboardOverview2')->name('dashboard-overview-2');
        Route::get('dashboard-overview-3-page', 'dashboardOverview3')->name('dashboard-overview-3');
        Route::get('dashboard-overview-4-page', 'dashboardOverview4')->name('dashboard-overview-4');
        Route::get('inbox-page', 'inbox')->name('inbox');
        Route::get('file-manager-page', 'fileManager')->name('file-manager');
        Route::get('point-of-sale-page', 'pointOfSale')->name('point-of-sale');
        Route::get('chat-page', 'chat')->name('chat');
        Route::get('post-page', 'post')->name('post');
        Route::get('calendar-page', 'calendar')->name('calendar');
        Route::get('crud-data-list-page', 'crudDataList')->name('crud-data-list');
        Route::get('crud-form-page', 'crudForm')->name('crud-form');
        Route::get('users-layout-1-page', 'usersLayout1')->name('users-layout-1');
        Route::get('users-layout-2-page', 'usersLayout2')->name('users-layout-2');
        Route::get('users-layout-3-page', 'usersLayout3')->name('users-layout-3');
        Route::get('profile-overview-1-page', 'profileOverview1')->name('profile-overview-1');
        Route::get('profile-overview-2-page', 'profileOverview2')->name('profile-overview-2');
        Route::get('profile-overview-3-page', 'profileOverview3')->name('profile-overview-3');
        Route::get('wizard-layout-1-page', 'wizardLayout1')->name('wizard-layout-1');
        Route::get('wizard-layout-2-page', 'wizardLayout2')->name('wizard-layout-2');
        Route::get('wizard-layout-3-page', 'wizardLayout3')->name('wizard-layout-3');
        Route::get('blog-layout-1-page', 'blogLayout1')->name('blog-layout-1');
        Route::get('blog-layout-2-page', 'blogLayout2')->name('blog-layout-2');
        Route::get('blog-layout-3-page', 'blogLayout3')->name('blog-layout-3');
        Route::get('pricing-layout-1-page', 'pricingLayout1')->name('pricing-layout-1');
        Route::get('pricing-layout-2-page', 'pricingLayout2')->name('pricing-layout-2');
        Route::get('invoice-layout-1-page', 'invoiceLayout1')->name('invoice-layout-1');
        Route::get('invoice-layout-2-page', 'invoiceLayout2')->name('invoice-layout-2');
        Route::get('faq-layout-1-page', 'faqLayout1')->name('faq-layout-1');
        Route::get('faq-layout-2-page', 'faqLayout2')->name('faq-layout-2');
        Route::get('faq-layout-3-page', 'faqLayout3')->name('faq-layout-3');
        Route::get('register-page', 'register')->name('register');
        Route::get('error-page-page', 'errorPage')->name('error-page');
        Route::get('update-profile-page', 'updateProfile')->name('update-profile');
        Route::get('change-password-page', 'changePassword')->name('change-password');
        Route::get('regular-table-page', 'regularTable')->name('regular-table');
        Route::get('tabulator-page', 'tabulator')->name('tabulator');
        Route::get('modal-page', 'modal')->name('modal');
        Route::get('slide-over-page', 'slideOver')->name('slide-over');
        Route::get('notification-page', 'notification')->name('notification');
        Route::get('tab-page', 'tab')->name('tab');
        Route::get('accordion-page', 'accordion')->name('accordion');
        Route::get('button-page', 'button')->name('button');
        Route::get('alert-page', 'alert')->name('alert');
        Route::get('progress-bar-page', 'progressBar')->name('progress-bar');
        Route::get('tooltip-page', 'tooltip')->name('tooltip');
        Route::get('dropdown-page', 'dropdown')->name('dropdown');
        Route::get('typography-page', 'typography')->name('typography');
        Route::get('icon-page', 'icon')->name('icon');
        Route::get('loading-icon-page', 'loadingIcon')->name('loading-icon');
        Route::get('regular-form-page', 'regularForm')->name('regular-form');
        Route::get('datepicker-page', 'datepicker')->name('datepicker');
        Route::get('tom-select-page', 'tomSelect')->name('tom-select');
        Route::get('file-upload-page', 'fileUpload')->name('file-upload');
        Route::get('wysiwyg-editor-classic', 'wysiwygEditorClassic')->name('wysiwyg-editor-classic');
        Route::get('wysiwyg-editor-inline', 'wysiwygEditorInline')->name('wysiwyg-editor-inline');
        Route::get('wysiwyg-editor-balloon', 'wysiwygEditorBalloon')->name('wysiwyg-editor-balloon');
        Route::get('wysiwyg-editor-balloon-block', 'wysiwygEditorBalloonBlock')->name('wysiwyg-editor-balloon-block');
        Route::get('wysiwyg-editor-document', 'wysiwygEditorDocument')->name('wysiwyg-editor-document');
        Route::get('validation-page', 'validation')->name('validation');
        Route::get('chart-page', 'chart')->name('chart');
        Route::get('slider-page', 'slider')->name('slider');
        Route::get('image-zoom-page', 'imageZoom')->name('image-zoom');
    });
});
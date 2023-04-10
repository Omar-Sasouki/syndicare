<?php

use App\Console\Commands\SendPaymentReminder;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\DevisController;
use App\Http\Controllers\admin\FactureController;
use App\Http\Controllers\admin\ReclamationAdminController;
use App\Http\Controllers\admin\ReclamationSuperAdmin;
use App\Http\Controllers\admin\ResidenceController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\DatereclamtionController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PrintController;
use App\Models\Appartement;
use App\Models\Residence;

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

Route::get('/dashboard', function () {
    return view('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');


//route home page web site
//Route::get('/', function () {
   // return view('frontend.index');

//});
Route::get('/', function () {
   return view('frontend.index');
    
});


/* Route::get('/r', function () {
   $res= Appartement::find(4)->residence;
   return $res;
});
 */

//super admin routes
Route::controller(AdminController::class)->middleware(['auth',/* 'role:superadmin' */ ])->prefix('superadmin')->group(function () {
    Route::get('admin/logout', 'logout')->name('admin.logout');
    Route::get('admin/profile', 'profile')->name('admin.profile');
    Route::get('edit/profile', 'editprofile')->name('edit.profile');
    Route::post('store/profile', 'storeprofile')->name('store.profile');
    Route::get('admin/password', 'editpassword')->name('admin.password');
    Route::post('store/password', 'storepassword')->name('store.Password');
    // affichage user and action role or banne
    Route::get('/users',[UsersController::class,'index'])->name('users.index');
    Route::get('/users/{user}',[UsersController::class,'show'])->name('users.show');
    Route::delete('/users/{user}',[UsersController::class,'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UsersController::class, 'assignRole'])->name('admin.users.roles');
    Route::delete('/users/{user}/roles/{role}', [UsersController::class, 'removeRole'])->name('admin.users.roles.remove');
    //bann
    Route::get('users/ban/{user_id}/{ban_code}',[UsersController::class, 'updateBan'])->name('users.bann');
    //user aproved
    Route::get('users/approved/{user_id}',[UsersController::class, 'approved'])->name('users.approved');
    // set payment
    Route::get('/users/set-payment-syndic/{user_id}', [UsersController::class, 'setPaymentSyndic'])->name('users.setPaymentSyndic')->middleware('auth', 'role:admin');
 

    //reclamtion superAdmin 
    Route::get('reclamtion/superadmin/index',[ReclamationSuperAdmin::class, 'index'])->name('reclamtion.superadmin.index');
    Route::get('reclamtion/superadmin/show/{id}',[ReclamationSuperAdmin::class, 'show'])->name('reclamtion.superadmin.show');
    Route::get('reclamtion/superadmin/destory/{id}',[ReclamationSuperAdmin::class, 'destroy'])->name('reclamtion.superadmin.destroy');

    Route::post('date/reclamtion',[DatereclamtionController::class, 'storedate'])->name('store.datereclamtion');


    //reclamation admin
    Route::get('reclamtion/index',[ReclamationAdminController::class, 'index'])->name('reclamtion.index');
    Route::get('reclamtion/admin/show/{id}',[ReclamationAdminController::class, 'show'])->name('reclamtion.admin.show');
    Route::get('reclamtion/admin/destory/{id}',[ReclamationAdminController::class, 'destroy'])->name('reclamtion.admin.destroy');

//                                  devis
    Route::post('devis/store',[DevisController::class, 'store'])->name('devis.store');
    Route::get('devis/create',[DevisController::class, 'create'])->name('devis.creation');
    Route::get('devis/index',[DevisController::class, 'index'])->name('devis.index');
    Route::get('devis/showall',[DevisController::class, 'showall'])->name('devis.showall');
    Route::get('devis/destory/{id}',[DevisController::class, 'destory'])->name('devis.destory');
    Route::get('devis/show/{id}',[DevisController::class, 'show'])->name('devis.show');
    Route::post('devis/pdf/{id}', [DevisController::class, 'generatePdf'])->name('devis.pdf');

//                          facture
    Route::get('facture/create',[FactureController::class, 'create'])->name('facture.creation');
    Route::get('facture/index',[FactureController::class, 'index'])->name('facture.index');
    Route::post('facture/store',[FactureController::class, 'store'])->name('facture.store');
    
    //              residence
    Route::get('residence/create',[ResidenceController::class, 'create'])->name('residence.creation');
    Route::post('residence/store',[ResidenceController::class, 'store'])->name('residence.store');
    //                  residences events
    Route::get('residence/event',[ResidenceController::class, 'residenceEvent'])->name('residence.event');
    Route::get('/residence/events', [ResidenceController::class, 'residenceEvent'])->name('residence.events');
    Route::post('update-event',[ResidenceController::class, 'updateEvent'])->name('update-event');

    Route::post('residence/store/event1',[ResidenceController::class, 'storevent'])->name('residence.store.event1');
    Route::post('residence/store/event2',[ResidenceController::class, 'storevent2'])->name('residence.store.event2');
    Route::post('residence/store/event3',[ResidenceController::class, 'storevent3'])->name('residence.store.event3');

});



//Home page all route
    Route::controller(HomeSliderController::class)->middleware(['auth', 'role:superadmin'])->prefix('superadmin')->group(function () {
    Route::get('admin/homeslider', 'homeSlider')->name('home.slide');
    Route::post('admin/storehomeslider', 'storehomeSlider')->name('store.homeslider');

    //champ Pub 
    Route::get('admin/champpub', 'indxpub')->name('champ.pub');
    Route::post('admin/champpub', 'storechamp')->name('store.champ');
    
    
});


Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');











require __DIR__ . '/auth.php';

















//profile edit by breeeez
/*Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/

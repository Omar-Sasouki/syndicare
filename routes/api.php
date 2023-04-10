<?php

use App\Http\Controllers\admin\DevisController;
use App\Http\Controllers\admin\ReclamationAdminController;
use App\Http\Controllers\admin\ReclamationSuperAdmin;
use App\Http\Controllers\admin\ResidenceController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DatereclamtionController;
use App\Http\Controllers\FlutterAPI\AuthResidentController;
use App\Http\Controllers\Home\HomeSliderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

// Public route for fetech residence

Route::post('/residence', [AuthResidentController::class, 'fetchresidences']);
Route::get('/appartement', [AuthResidentController::class, 'fetchAppartment']);
Route::get('/type', [AuthResidentController::class, 'fetchtype']);

// Public route for resident

Route::post('/register', [AuthResidentController::class, 'register']);
Route::post('/login', [AuthResidentController::class, 'login']);




//privet Route for residen
Route::group(['middleware' => ['auth:sanctum']], function () {
    //lougout
    Route::post('/logout', [AuthResidentController::class, 'logout']);

    //profil 
    Route::get('/profile', [AuthResidentController::class, 'profile']);
    Route::post('/updateprofile', [AuthResidentController::class, 'storeprofile']);
    Route::post('/storePassword', [AuthResidentController::class, 'storePassword']);

//      reclamtion Personnel
    Route::post('reclamtion/superadmin/store',[ReclamationSuperAdmin::class, 'store']);
    Route::get('date/reclamtion',[DatereclamtionController::class, 'show']);
    Route::post('date/confirmation',[DatereclamtionController::class, 'storedateconfirmation']);

 // reclamation admin
    Route::post('reclamtion/admin/store',[ReclamationAdminController::class, 'store']);

    //chat
    Route::get('/conversation', [ConversationController::class, 'index']);
    Route::post('/conversation', [ConversationController::class, 'store']);
    Route::post('/conversation/read', [MessageController::class, 'makConversationAsReaded']);
    Route::post('/message', [MessageController::class, 'store']);
//liste user
    Route::get('/users',[ConversationController::class,'show']);

    //one user
    Route::get('/users/{user}',[ConversationController::class,'singleUser']);

 

//mobile slide

 Route::get('/champPub',[HomeSliderController::class,'showchamppub']);
 Route::get('residence/show',[ResidenceController::class, 'showevent']);

 //route notification
 Route::get('/notifications', [NotificationController::class, 'indexData']);

 //route devis 
 Route::get('devis/pdf', [DevisController::class, 'getPdfPath']);
 
});











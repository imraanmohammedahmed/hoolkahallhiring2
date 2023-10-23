<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\TeamController;
use App\Http\Controllers\Backend\HallTypeController;
use App\Http\Controllers\Backend\HallController;


//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('/',[UserController::class,'Index']);

Route::get('/dashboard', function () {
    return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/profile/store', [UserController::class, 'UserStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/user/change/password', [UserController::class, 'UserChangePassword'])->name('user.change.password');
    Route::post('/password/change/password', [UserController::class, 'ChangePasswordStore'])->name('password.change.store');
});

require __DIR__.'/auth.php';

//Admin Group mIDDLEWARE

Route::middleware(['auth','roles:admin'])->group(function(){
Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');

Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
;
Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});

//End Admin Group Middleware

Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');


//Admin Group mIDDLEWARE

Route::middleware(['auth','roles:admin'])->group(function(){

    //Team All ROute
    Route::controller(TeamController::class)->group(function (){
        Route::get('/all/team', 'AllTeam')->name('all.team');
        Route::get('/add/team', 'AddTeam')->name('add.team');
        Route::post('/team/store', 'TeamStore')->name('team.store');
        Route::get('/edit/team/{id}', 'EditTeam')->name('edit.team');
        Route::post('/team/update', 'UpdateTeam')->name('team.update');
        Route::get('/delete/team/{id}', 'DeleteTeam')->name('delete.team');
        
    });

    //Book All ROute
    Route::controller(TeamController::class)->group(function (){
        Route::get('/book/area', 'BookArea')->name('book.area');
        Route::post('/book/area/update', 'BookAreaUpdate')->name('book.area.update');

    });

    /// HallType All Route 
 Route::controller(HallTypeController::class)->group(function(){

    Route::get('/hall/type/list', 'HallTypeList')->name('hall.type.list');
    Route::get('/add/hall/type', 'AddHallType')->name('add.hall.type');
    Route::post('/hall/type/store', 'HallTypeStore')->name('hall.type.store'); 
      
});

   /// Room All Route 
 Route::controller(HallController::class)->group(function(){

    Route::get('/edit/hall/{id}', 'EditHall')->name('edit.hall');
    Route::post('/update/hall/{id}', 'UpdateHall')->name('update.hall');
    Route::get('/multi/image/delete/{id}', 'MultiImageDelete')->name('multi.image.delete');

    Route::post('/store/hall/no/{id}', 'StoreHallNumber')->name('store.hall.no');
    Route::get('/edit/hallno/{id}', 'EditHallNumber')->name('edit.hallno');
    Route::post('/update/hallno/{id}', 'UpdateHallNumber')->name('update.hallno');
    Route::get('/delete/hallno/{id}', 'DeleteHallNumber')->name('delete.hallno');

    Route::get('/delete/hall/{id}', 'DeleteHall')->name('delete.hall');
      
});

    });//End Admin Group Middleware
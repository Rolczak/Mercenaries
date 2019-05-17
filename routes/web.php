<?php

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

use App\Ban;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::user() != '') {
        return redirect('home');
    }
    return view('welcome');
})->name('welcome');

Route::group(['middleware' => ['guest']], function () {
    Route::post('/validateLoginEmail', 'LoginController@validateLoginEmail');
});

Route::get('/ban', function () {
    $ban = Ban::all()->where('user_id', request()->user()->id)->where('removed', 0)->where('expired', '>', Carbon::now())->first();
    if ($ban == null)
        return redirect('home');
    return view('banned', compact('ban'));
})->name('ban');
Auth::routes();
Route::group(['middleware' => ['HasBan', 'web', 'auth']], function () {

    Route::post('/start', 'QuestController@start')->name('start')->middleware('HasJob');
    Route::get('/job', function () {
        return view('job');
    });
    //Notification Related
    Route::get('/read/{notif}', 'NotificationController@read')->name('read');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::group(['middleware' => ['MainQuests:1']], function () {//START access after first mission


        Route::get('/show/{id}', function ($id) {
            return view('stats', compact('id'));
        });
        Route::get('/equip', 'HomeController@equip');

        Route::get('/unEquip', 'HomeController@unEquip');

        Route::group(['middleware' => ['MainQuests:3']], function () {//START access after second mission

            Route::group(['middleware' => ['HasJob']], function () {
                Route::get('/work', 'HomeController@work')->name('work');
                Route::post('/work', 'HomeController@working')->name('working');
                Route::post('/training', 'HomeController@train')->name('training');

                Route::get('/training', function () {
                    return view('training');

                });



                Route::group(['middleware' => ['MainQuests:4']], function (){
                    Route::get('/contracts', 'HomeController@contracts')->name('contracts');
                    Route::get('/arena', 'HomeController@arena')->name('arena');
                    Route::post('/fight', 'FightController@fight')->name('fight');
                    Route::post('/fightArena', 'FightController@fightArena')->name('fightArena');

                    //Shop Related
                    Route::get('/shop', 'ShopController@index')->name('ItemShop');
                    Route::post('/buyItem', 'ShopController@buyItem');
                    Route::post('/sellItem', 'ShopController@sellItem');

                });
            });




        });//END access after second mission
    });//END access after first mission
    //Quests Related
    Route::get('/quests', 'QuestController@index')->name('quests')->middleware('HasJob');


    Route::get('/modRest', 'UraniumController@modRest');

    Route::post('/rest', 'UraniumController@speedUpRest');

    Route::post('/addUranium', 'UraniumController@addUranium');

    Route::post('/regenHealth', 'UraniumController@regenHealth');

    Route::post('/regenAction', 'UraniumController@regenAction');

    Route::get('/uranium', function () {
        return view('uranium');
    })->name('shop');

});
Route::group(['middleware' => ['web', 'auth', 'IsAdmin']], function () {
    Route::resource('/admin/logs', 'LogController');
    Route::resource('/admin/items', 'ItemController');
    Route::resource('/admin/bans', 'BanController');
    Route::post('/admin/removeBan', 'BanController@remove');
});

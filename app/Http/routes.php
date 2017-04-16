<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



Route::get('/', 'HomeController@home');
Route::get('/course', 'HomeController@course');
Route::get('/course_teaching', 'HomeController@Teaching');


Route::get('/courseinfo/{id}', 'CourseinfoController@show');

// Password Reset Routes
Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
Route::post('password/reset', 'Auth\PasswordController@reset');

Route::resource('/contact', 'ContactController');

Route::get('/contact_success', function () {
    return view('contact.contact_success');
});

Route::get('/about', function () {
    return view('about.index');
});

Route::get('/live', function () {
    return view('live.index');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/email', function () {
    return view('mails.index');
});

Route::get('/redirect', 'SocialAuthController@redirect');
Route::get('/callback', 'SocialAuthController@callback');

Route::post('login', function()
{
    $credentials = Input::only('email', 'password');

    if ( ! Auth::attempt($credentials))
    {
        return Redirect::back()->withMessage('Invalid credentials');
    }

    if (Auth::user()->is_admin == 1)
    {
        return Redirect::to('/admin/dashboard');
    }

    return Redirect::to('/');
});

Route::group(['middleware' => 'auth'], function () {


  Route::put('/bil_course/{id}', 'CourseinfoController@bil_course');

  Route::resource('comment', 'CommentController');
  Route::resource('profile', 'UserprofileController');
  Route::resource('user_course', 'MycourseController');
  Route::resource('user_confirm', 'UserconfirmController');

  Route::get('/pay_course', 'CourseinfoController@submit_course');
  Route::get('/confirm_course/{id}', 'CourseinfoController@confirm_course');
  Route::get('/checkmycourse/{id}', 'CourseinfoController@checkmycourse');
  Route::post('/submit_course/{id}', 'CourseinfoController@submit_course');
});

Route::group(['middleware' => 'adminRole'], function () {

    Route::resource('admin/dashboard', 'DashboardController');
    Route::resource('admin/user', 'UserController');

    Route::resource('admin/teacher', 'TeacherController');
    Route::resource('admin/student', 'StudentController');
    Route::resource('admin/course', 'CourseController');
    Route::resource('admin/typecourse', 'TypecourseController');

    Route::resource('admin/bank', 'BankController');
    Route::resource('admin/order_shop', 'OrderController');

    Route::group(['prefix' => 'file'],  function(){
    Route::post('post', 'UploadFileController@image');
    });

    Route::get('local/.env');

});

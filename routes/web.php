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
//These routes are for login and registration purpose
Route::Group(['middleware' => 'loginmiddleware'],function(){
	Route::get('/','LoginController@index')->name('ladingpage');
	Route::get('/login','LoginController@loginView')->name('Login.loginView');
	Route::post('/login','LoginController@checkLogin');
	Route::get('/registration','LoginController@registrationView')->name('Login.registerView');
	Route::post('/registration','LoginController@checkRegistration');
});



//These routes for user purpose
Route::Group(['middleware' => ['sessionmiddleware','membertype']],function(){
	Route::get('/home','UserController@index')->name('User.index');
	Route::get('/profile','UserController@showProfile')->name('User.showProfile');
	Route::get('/changepassword','UserController@changePassword')->name('User.changePassword');
	Route::post('/changepassword','UserController@confirmChangePassword');
	Route::get('/logout','UserController@logout')->name('User.logout');

	//These routes for Quiz controll purpose
	Route::get('/createquestion','QuizController@createQuestion')->name('Quiz.createQuestion');
	Route::post('/createquestion','QuizController@setQuestionTitle');
	Route::get('/setquizquestion','QuizController@setQuizQuestion')->name('Quiz.setQuizQuestion');
	Route::post('/setquizquestion','QuizController@saveQuestionLocally');
	Route::get('/finishcreateQuiz','QuizController@finishCreatingQuiz')->name('Quiz.finishCreatingQuiz');
	Route::get('/cancelquizquestion','QuizController@cancelQuizQuestion')->name('Quiz.cancelQuizQuestion');
	Route::get('/deletequestion/{temp_id}','QuizController@deleteQuestion')->name('Quiz.deleteQuestion');
	Route::get('/allexams','QuizController@showAllExams')->name('Quiz.showAllExams');
	Route::get('/updatequestionstatus', 'QuizController@updateQuestionStatus')->name('Quiz.updateQuestionStatus');
	Route::get('/resulthistory/{exam_title}/{question_set_id}','QuizController@showResultHistory')->name('QuizController.showResultHistory');
	//Quiz Controller
	Route::get('/startexam/{examtitle}/{examid}','QuizController@startExam')->name('Quiz.startExam');
	Route::post('/startexam/{examtitle}/{examid}','QuizController@finishQuiz');
	Route::get('/result','QuizController@showResult')->name('Quiz.showResult');

});


//These routes for admin purpose
Route::Group(['middleware' => ['sessionmiddleware','admintype']],function(){
	Route::get('/admin/home','AdminController@index')->name('Admin.index');
	Route::get('/admin/memberdetails','AdminController@memberDetails')->name('Admin.memberDetails');
	Route::get('/admin/edit/{userid}','AdminController@editMemberDetails')->name('Admin.editMemberDetails');
	Route::post('/admin/edit/{userid}','AdminController@updateMemberDetails');
	Route::get('/admin/delete/{userid}','AdminController@deleteMember')->name('Admin.deleteMember');
	Route::get('/admin/confirmdelete/{userid}','AdminController@confirmDeleteMember')->name('Admin.confirmDeleteMember');
	Route::get('/admin/profile','AdminController@showProfile')->name('Admin.showprofile');
	Route::get('/admin/changepassword','AdminController@changePassword')->name('Admin.changePassword');
	Route::post('/admin/changepassword','AdminController@confirmChangePassword');
	Route::get('/admin/logout','AdminController@logout')->name('Admin.logout');
});




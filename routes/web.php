<?php

use App\Models\Company;
use App\Models\Evaluation;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/evaluation')->group(function () {

    Route::get('/{evaluation}', function (Evaluation $evaluation) {
        $evaluation = Evaluation::find($evaluation->id)->with('quizzes')->first();
        return view('prueba', compact('evaluation'));
    });

    Route::post('/{evaluation}/guardada', function(Evaluation $evaluation){
        return redirect()->route('success', ['evaluation' => $evaluation->id]);
    })->name('prueba-completada');

    Route::get('/{evaluation}/completado', function(Evaluation $evaluation){
        return view('prueba-completada', compact('evaluation'));
    })->name('success');



});

Route::get('/test', function () {
    // $company = new Company();
    // $company->name = 'ClusterMX';
    // $company->save();
    // // return $company;

    // $eval = new Evaluation();
    // $eval->company_id = 1;
    // $eval->name = 'Evaluacion de prueba';
    // $eval->save();
    // // return $eval;

    // $quiz = new Quiz();
    // $quiz->evaluation_id = 1;
    // $quiz->question = 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.';
    // $quiz->answer_1 = 'Perspiciatis tenetur';
    // $quiz->answer_2 = 'Explicabo dolores maiores';
    // $quiz->answer_3 = 'Deleniti saepe nesciunt sit';
    // $quiz->answer_4 = 'Esse molestias';
    // $quiz->is_long = false;
    // $quiz->save();

    // return $quiz;

    return Company::with('evaluations')->get();

});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

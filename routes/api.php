<?php

use App\Models\Information;
use App\Models\Participant;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('curp')->group(function () {
    Route::post('/store', function (Request $request) {
        $curpRequest = $request->get('curp');
        $curp = strtr($curpRequest, '|', ',');
        $curpArray = explode(',', $curp);
        $arrayClean = [];
        foreach ($curpArray as $key => $value) {
            if ($value) {
            array_push($arrayClean, $value);
            }
        }

        $searchCurp = Participant::where('curp', $arrayClean[0])->first();
        // return $searchCurp;
        if ($searchCurp) {
            return response($searchCurp, 200);
        }

        $curpModel = new Participant();
        $curpModel->curp = $arrayClean[0];
        $curpModel->apellido_paterno = $arrayClean[1];
        $curpModel->apellido_materno = $arrayClean[2];
        $curpModel->nombre = $arrayClean[3];
        $curpModel->fecha = $arrayClean[4];
        $curpModel->estado = $arrayClean[5];
        $curpModel->codigo_estado = $arrayClean[6];
        $curpModel->save();

        return response($curpModel, 200);
    });

    Route::prefix('/information')->group(function () {
        Route::post('/store', function(Request $request){
            $information                    = new Information();
            $information->participant_id    = $request->get('participant_id');
            $information->whatsapp          = $request->get('whatsapp');
            $information->telefono          = $request->get('telefono');
            $information->correo            = $request->get('correo');
            $information->save();
            return response($information, 200);
        });

        Route::post('/update', function(Request $request){
            $information                    = Information::where('participant_id', $request->get('participant_id'))->first();
            $information->participant_id    = $request->get('participant_id');
            $information->whatsapp          = $request->get('whatsapp');
            $information->telefono          = $request->get('telefono');
            $information->correo            = $request->get('correo');
            $information->save();
            return response($information, 200);
        });
    });



    Route::get('/all', function(){
        $participants = Participant::with('information')->get();
        return response($participants, 200);
    });
});



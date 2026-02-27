<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Schools;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use Illuminate\Http\JsonResponse;
use App\Models\School;
use Exception;

final class SchoolController extends Controller
{
    public function index(): JsonResponse
    {
        $school =  School::all();
        return response()->json([
            'data'=> $school,
            'message'=> "Ecole recupere avec succes "],
            Response::HTTP_OK);
    }

    public function store(SchoolRequest $request){
        try{
            $school =  School::create($request->validated());
            return response()->json([
                'data'=> $school,
                'message'=> 'Ecole cree avec succes'
            ],Response::HTTP_CREATED);
        }catch(Exception $e){
            return response()->json([
                'error'=>"une erreur est survenue"
            ]);
        }

    }

    public function update(){

    }

    public function destroy(){

    }
}

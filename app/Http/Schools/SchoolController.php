<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Schools;

use Symfony\Component\HttpFoundation\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolRequest;
use App\Http\Resources\SchoolResource;
use Illuminate\Http\JsonResponse;
use App\Models\School;
use Exception;

final class SchoolController extends Controller
{
    public function index(): JsonResponse
    {
        $school =  School::all();
        return response()->json([
            'success' => true,
            'message'=> "Ecole recupere avec succes ",
            'data'=> SchoolResource::collection($school)],
            Response::HTTP_OK);
    }

    public function store(SchoolRequest $request){
        try{
            $school =  School::create($request->validated());
            
            return response()->json([
                'success' => true,
                'message'=> 'Ecole cree avec succes',
                'data'=> $school],
                Response::HTTP_CREATED);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'error'=>"une erreur est survenue" .$e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function update(){

    }

    public function destroy(){

    }
}

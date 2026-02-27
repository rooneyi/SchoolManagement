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
use App\Services\TelegramLogger;

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
            (new TelegramLogger())->log('Nouvelle école créée: ' . $school->name);
            return response()->json([
                'success' => true,
                'message'=> 'Ecole cree avec succes',
                'data'=> $school],
                Response::HTTP_CREATED);
        }catch(Exception $e){
            (new TelegramLogger())->log('Erreur création école: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'=>"une erreur est survenue" .$e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }

    }

    public function update(int $id){
        try {
            $school = School::find($id);
            if (!$school) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ecole non trouvée',
                ], Response::HTTP_NOT_FOUND);
            }
            $validated = app(SchoolRequest::class)->validated();
            $school->update($validated);
            (new TelegramLogger())->log('Ecole mise à jour: ' . $school->name);
            return response()->json([
                'success' => true,
                'message' => 'Ecole mise à jour avec succès',
                'data' => new SchoolResource($school),
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            (new TelegramLogger())->log('Erreur update école: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la mise à jour: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(){
        try {
            $id = request('id');
            $school = School::find($id);
            if (!$school) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ecole non trouvée',
                ], Response::HTTP_NOT_FOUND);
            }
            $school->delete();
            (new TelegramLogger())->log('Ecole supprimée: ' . $school->name);
            return response()->json([
                'success' => true,
                'message' => 'Ecole supprimée avec succès',
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            (new TelegramLogger())->log('Erreur suppression école: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => 'Erreur lors de la suppression: ' . $e->getMessage(),
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

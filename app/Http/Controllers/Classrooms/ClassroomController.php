<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Controllers\Classrooms;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClassroomRequest;
use App\Http\Resources\ClassroomResource;
use App\Models\Classroom;
use App\Services\TelegramLogger;
use Exception;
use Symfony\Component\HttpFoundation\Response;

final class ClassroomController extends Controller
{
    public function index()
    {
        $classroom = Classroom::all();

        return response()->json([
            'success' => true,
            'message' => 'Liste des classes récupérée avec succès.',
            'data' => ClassroomResource::collection($classroom),
        ]);
    }

    public function store(StoreClassroomRequest $request)
    {
        $user = auth()->user()->school;
        $data = $request->validated();
        $data['school_id'] = $user->id;

        try {
            $school = Classroom::create($data);
            (new TelegramLogger)->log('Nouvelle classroom créée: '.$school->name);

            return response()->json([
                'success' => true,
                'message' => 'Classe créée avec succès.',
                'data' => $school,
            ]);
        } catch (Exception $e) {
            (new TelegramLogger)->log('Erreur création classroom: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'une erreur est survenue'.$e->getMessage(),
            ], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Classrooms;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Services\TelegramLogger;
use Symfony\Component\HttpFoundation\Response;

class ClassroomController extends Controller
{
    public function index() {
        $school = School::all();
        return response()->json([
            'success' => true,
            'message'=> "Classrooms recupere avec succes ",
            'data'=> $school
        ], Response::HTTP_OK);
    }

    public function store() {
        try{
            $school = School::create([
                'name' => 'Classroom ' . rand(1, 100),
                'address' => 'Address ' . rand(1, 100),
            ]);
            (new TelegramLogger())->log('Nouvelle classroom créée: ' . $school->name);
            return response()->json([
                'success' => true,
                'message'=> 'Classroom cree avec succes',
                'data'=> $school
            ], Response::HTTP_CREATED);
        }
        catch(Exception $e){
            (new TelegramLogger())->log('Erreur création classroom: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'error'=>"une erreur est survenue" .$e->getMessage()
            ],Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

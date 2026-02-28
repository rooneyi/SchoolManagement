<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Controllers\Sections;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionRequest;
use App\Http\Resources\SectionResource;
use App\Models\Section;
use App\Services\TelegramLogger;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class SectionController extends Controller
{
    public function index(Request $request): Response
    {
        $sections = Section::all();

        return response()->json([
            'success' => true,
            'message' => 'Sections recupere avec succes ',
            'data' => SectionResource::collection($sections),
        ], status: Response::HTTP_OK);
    }

    public function store(StoreSectionRequest $request): Response
    {
        $school = auth()->user()->school;
        try {
            $data = $request->validated();
            $data['school_id'] = $school->id;
            $section = Section::create($data);
            (new TelegramLogger)->log('Nouvelle section créée: '.$section->name);

            return response()->json([
                'success' => true,
                'message' => 'Section cree avec succes',
                'data' => $section,
            ], status: Response::HTTP_CREATED);
        } catch (Exception $e) {
            (new TelegramLogger)->log('Erreur création section: '.$e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'une erreur est survenue'.$e->getMessage(),
            ], status: Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

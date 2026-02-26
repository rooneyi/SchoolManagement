<?php

/**
 * @author Rooney Kalumba <22ki129@esisalama.org>
 */

namespace App\Http\Sections;

use App\Http\Controllers\Controller;
use App\Models\Section;

class SectionController extends Controller
{
    public function index() {

        return view('sections.index', [
            'sections' => Section::all()
        ]);
    }
}

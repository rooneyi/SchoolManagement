<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolBibliographySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schools = \App\Models\School::all();
        foreach ($schools as $school) {
            \App\Models\SchoolBibliography::factory()
                ->count(5)
                ->create(['school_id' => $school->id]);
        }
    }
}

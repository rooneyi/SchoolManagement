<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 2 schools
        $school1 = School::create([
            'name' => 'École Primaire A',
            'email' => 'school1@example.com',
            'phone' => '+243123456789',
            'address' => '123 Main Street',
        ]);

        $school2 = School::create([
            'name' => 'École Secondaire B',
            'email' => 'school2@example.com',
            'phone' => '+243987654321',
            'address' => '456 Second Avenue',
        ]);

        foreach ([$school1, $school2] as $school) {
            // Create years
            $year1 = Year::create([
                'school_id' => $school->id,
                'name' => '2025-2026',
                'is_active' => true,
                'start_date' => '2025-01-01',
                'end_date' => '2025-12-31',
            ]);

            // Create sections
            $section1 = Section::create([
                'name' => 'Section A',
                'code' => 'SEC-A',
                'school_id' => $school->id,
            ]);

            $section2 = Section::create([
                'name' => 'Section B',
                'code' => 'SEC-B',
                'school_id' => $school->id,
            ]);

            // Create classrooms
            $classroom1 = Classroom::create([
                'name' => 'Classe 1',
                'code' => 'CLS-1',
                'capacity' => 30,
                'school_id' => $school->id,
                'section_id' => $section1->id,
            ]);

            // Create guardians
            $guardian1 = Guardian::create([
                'first_name' => 'Marie',
                'last_name' => 'Dupont',
                'email' => 'marie@example.com',
                'phone' => '+243123111111',
                'address' => '789 Guardian Lane',
                'school_id' => $school->id,
            ]);

            $guardian2 = Guardian::create([
                'first_name' => 'Jean',
                'last_name' => 'Martin',
                'email' => 'jean@example.com',
                'phone' => '+243123222222',
                'address' => '790 Guardian Lane',
                'school_id' => $school->id,
            ]);

            // Create students
            for ($i = 1; $i <= 5; $i++) {
                $student = Student::create([
                    'matricule' => 'STU' . $school->id . sprintf('%03d', $i),
                    'name' => 'Student ' . $i,
                    'post_name' => 'Last' . $i,
                    'email' => 'student' . $school->id . '_' . $i . '@example.com',
                    'phone' => '+2431231111' . $i,
                    'birth_date' => '2010-01-01',
                    'address' => 'Student Address ' . $i,
                    'photo' => null,
                    'bulletin_file' => null,
                    'school_id' => $school->id,
                    'guardian_id' => ($i % 2 == 0) ? $guardian2->id : $guardian1->id,
                ]);

                // Create registration
                Registration::create([
                    'student_id' => $student->id,
                    'guardian_id' => ($i % 2 == 0) ? $guardian2->id : $guardian1->id,
                    'school_id' => $school->id,
                    'year_id' => $year1->id,
                    'classroom_id' => $classroom1->id,
                    'section_id' => $section1->id,
                    'registration_date' => '2025-01-01',
                    'status' => 'active',
                ]);
            }
        }
    }
}

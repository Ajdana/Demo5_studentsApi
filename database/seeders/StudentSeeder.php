<?php

namespace Database\Seeders;

use App\Models\Student;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //создание 10 студентов , можно поменять количество
    public function run(): void
    {
        Student::factory()->count(10)->create();
    }
}

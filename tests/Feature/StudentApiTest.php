<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentApiTest extends TestCase
{
    use RefreshDatabase; // очищает базу перед каждым тестом

    /** @test */
    public function it_can_get_all_students()
    {
        Student::factory()->count(3)->create();

        $response = $this->getJson('/api/v1/students');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }

    /** @test */
    public function it_can_get_single_student()
    {
        $student = Student::factory()->create();

        $response = $this->getJson("/api/v1/students/{$student->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $student->id,
                'name' => $student->name,
            ]);
    }

    /** @test */
    public function it_returns_404_if_student_not_found()
    {
        $response = $this->getJson('/api/v1/students/999');

        $response->assertStatus(404);
    }

    /** @test */
    public function it_can_create_a_student()
    {
        $data = [
            'name' => 'Айдана',
            'email' => 'aidana@example.com',
            'age' => 20,
            'group' => 'CS101',
        ];

        $response = $this->postJson('/api/v1/students', $data);

        $response->assertStatus(201)
            ->assertJsonFragment(['email' => 'aidana@example.com']);

        $this->assertDatabaseHas('students', ['email' => 'aidana@example.com']);
    }

    /** @test */
    public function it_can_update_a_student()
    {
        $student = Student::factory()->create();

        $response = $this->putJson("/api/v1/students/{$student->id}", [
            'name' => 'Updated Name',
            'email' => $student->email,
            'age' => 22,
            'group' => 'CS102',
        ]);

        $response->assertStatus(200)
            ->assertJsonFragment(['name' => 'Updated Name']);
    }

    /** @test */
    public function it_can_delete_a_student()
    {
        $student = Student::factory()->create();

        $response = $this->deleteJson("/api/v1/students/{$student->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('students', ['id' => $student->id]);
    }

}

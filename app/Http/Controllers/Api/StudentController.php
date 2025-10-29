<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Exception;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // Получить список всех студентов
    public function index()
    {
        try {
            $students = Student::all();
            return response()->json($students, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Error fetching students: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    // Создать нового студента
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name'       => 'required|string|min:2|max:255',
                'age'        => 'required|integer|between:16,100',
                'group'      => 'required|string|max:50',
                'email'      => 'required|email|unique:students,email',
                'avatar_url' => 'nullable|url',
            ]);

            $student = Student::create($data);

            return response()->json($student, Response::HTTP_CREATED);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (QueryException $e) {
            Log::error('Database error: ' . $e->getMessage());
            return response()->json(['message' => 'Database error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            Log::error('Unexpected error: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    // Показать конкретного студента
    public function show(string $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json($student, Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Error fetching student: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    // Обновить данные студента
    public function update(Request $request, string $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
            }

            $data = $request->validate([
                'name'       => 'required|string|min:2|max:255',
                'age'        => 'required|integer|between:16,100',
                'group'      => 'required|string|max:50',
                'email'      => 'required|email|unique:students,email,' . $id,
                'avatar_url' => 'nullable|url',
            ]);

            $student->update($data);

            return response()->json($student, Response::HTTP_OK);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            Log::error('Error updating student: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    // Удалить студента
    public function destroy(string $id)
    {
        try {
            $student = Student::find($id);

            if (!$student) {
                return response()->json(['message' => 'Student not found'], Response::HTTP_NOT_FOUND);
            }

            $student->delete();

            return response()->json(['message' => 'Student deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            Log::error('Error deleting student: ' . $e->getMessage());
            return response()->json(['message' => 'Server error'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

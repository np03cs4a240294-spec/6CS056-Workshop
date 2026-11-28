<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\JsonResponse;

class StudentController extends Controller
{
    // GET /api/students  → list all students (200)
    public function index()
    {
        $students = Student::all();
        return StudentResource::collection($students);
    }

    // POST /api/students  → create a student (201)
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        return (new StudentResource($student))
            ->response()
            ->setStatusCode(201);
    }

    // GET /api/students/{student}  → one student (200)
    public function show(Student $student)
    {
        return new StudentResource($student);
    }

    // PUT/PATCH /api/students/{student}  → update a student (200)
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        return new StudentResource($student->fresh());
    }

    // DELETE /api/students/{student}  → delete a student (204)
    public function destroy(Student $student): JsonResponse
    {
        $student->delete();

        return response()->json(null, 204);
    }
}
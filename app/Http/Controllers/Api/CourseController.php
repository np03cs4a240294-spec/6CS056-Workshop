<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;
use Illuminate\Http\JsonResponse;

class CourseController extends Controller
{
    // GET /api/courses (200)
    public function index()
    {
        return CourseResource::collection(Course::all());
    }

    // POST /api/courses (201)
    public function store(StoreCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return (new CourseResource($course->fresh()))
            ->response()
            ->setStatusCode(201);
    }

    // GET /api/courses/{course} (200)
    public function show(Course $course)
    {
        return new CourseResource($course);
    }

    // PUT/PATCH /api/courses/{course} (200)
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return new CourseResource($course->fresh());
    }

    // DELETE /api/courses/{course} (204)
    public function destroy(Course $course): JsonResponse
    {
        $course->delete();

        return response()->json(null, 204);
    }
}
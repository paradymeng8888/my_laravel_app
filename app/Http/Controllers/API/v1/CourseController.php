<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Exception;

class CourseController extends Controller
{
    /**
     * CREATE COURSE
     * POST /api/course
     */
    public function store(Request $request)
    {
        try {
            $course = Course::create([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Course created successfully',
                'course' => $course,
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course creation failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * GET ALL COURSES
     * GET /api/course
     */
    public function index()
    {
        try {
            $courses = Course::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Courses retrieved successfully',
                'courses' => $courses,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to retrieve courses',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET COURSE BY ID
     * GET /api/course/{id}
     */
    public function show($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course not found',
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Course retrieved successfully',
                'course' => $course,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course retrieval failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * UPDATE COURSE
     * PUT /api/course/{id}
     */
    public function update(Request $request, $id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course not found',
                ], 404);
            }

            $course->update([
                'name' => $request->name,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Course updated successfully',
                'course' => $course,
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course update failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * DELETE COURSE
     * DELETE /api/course/{id}
     */
    public function destroy($id)
    {
        try {
            $course = Course::find($id);

            if (!$course) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Course not found',
                ], 404);
            }

            $course->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Course deleted successfully',
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Course deletion failed',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}

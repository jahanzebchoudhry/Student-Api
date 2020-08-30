<?php

namespace App\Http\Controllers;

use App\StudentApi;
use Illuminate\Http\Request;

class StudentApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStudents()
    {
        $students = StudentApi::all();

        return response()->json($students, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createStudent(Request $request)
    {
        $students = new StudentApi;
        $students->name= $request->name;
        $students->course= $request->course;
        $students->save();

        return response()->json([
            'message'=>'Student successfully Created'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\StudentApi  $studentApi
     * @return \Illuminate\Http\Response
     */
    public function fetchSingleStudent($id)
    {
        if (StudentApi::where('id', $id)->exists()) {
            $student = StudentApi::find($id)->get();
            return response()->json($student, 200);
        } else {
            return response()->json([
                'message'=>'Student Not Found'
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\StudentApi  $studentApi
     * @return \Illuminate\Http\Response
     */
    public function updateStudent(Request $request, $id)
    {
        if (StudentApi::where('id', $id)->exists()) {
            $student = StudentApi::find($id);
            $userdata = $request->all();

            return $userdata;
            StudentApi::where('id', $student->id)->update($userdata);
            return response()->json([
                'message' => 'Student Record Successfully Updated'
            ], 201);
        } else {
            return response()->json([
                'message'=>'Student Not Found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\StudentApi  $studentApi
     * @return \Illuminate\Http\Response
     */
    public function deleteStudent($id)
    {
        if (StudentApi::where('id', $id)->exists()) {
            $student = StudentApi::find($id);
            StudentApi::where('id', $student->id)->delete();

            return response()->json([
                'message' => 'Student Record Successfully Deleted'
            ], 200);
        } else {
            return response()->json([
                'message'=>'Student Not Found'
            ], 404);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Image;
use App\Student;
use App\Gradebook;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $gradebook_id)
    {
        $request->validate([
            'firstName' => 'required|max:255',
            'lastName' => 'required|max:255',
        ]);

        $student = new Student();

        $student->firstName = $request->input('firstName');
        $student->lastName = $request->input('lastName');
        $student->gradebook_id = $gradebook_id;

        $student->save();

        $url = $request->input('url');
        $photo = new Image(['url' => $url]);
        $student->image()->save($photo);

        $gradebook = Gradebook::find($student->gradebook_id);
        $gradebook->students()->save($student);

        return $student;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

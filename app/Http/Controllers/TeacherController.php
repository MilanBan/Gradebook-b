<?php

namespace App\Http\Controllers;

use App\Image;
use App\Teacher;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $term = request()->input('term');

        if ($term) {
            return Teacher::with('gradebook')->search($term)->get();
        } else {
            return Teacher::with('gradebook')->get();
        }
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
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
        ]);

        $teacher = new Teacher();
        $teacher->firstName = $request->input('firstName');
        $teacher->lastName = $request->input('lastName');
        $teacher->gradebook_id = $request->input('gradebook_id');

        $teacher->save();
        
        $urls = $request->input('url');
        
        $images = new Image(['url' => $urls]);

        $teacher->images()->save($images);

        return $teacher;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
     public function show($id)
     {
        return Teacher::with('gradebook', 'images')->find($id);
     }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $teacher)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return new JsonResponse(true);
    }
}

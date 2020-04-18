<?php

namespace App\Http\Controllers;

use App\Gradebook;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GradebookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.jwt')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $term = request()->input('term');
        $skip = request()->input('skip', 0);
        $take = request()->input('take', Gradebook::get()->count());

        if ($term) {
            return Gradebook::with('teacher', 'students')->search($term)->skip($skip)->take($take)->get();
        } else {
            return Gradebook::with('teacher', 'students')->skip($skip)->take($take)->get();
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
            'name' => 'required|min:2|max:255',
        ]);

        $gradebook = new Gradebook();
        $gradebook->name = $request->input('name');
        $gradebook->teacher_id = $request->input('teacher_id');
        
        $gradebook->save();
        
        return $gradebook;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Gradebook::with('teacher', 'students', 'comments.user')->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function edit(Gradebook $gradebook)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gradebook $gradebook)
    {
        $gradebook = Gradebook::find($id);
        $gradebook->name = $request->input('name');
        $gradebook->teacher_id = $request->input('teacher_id');

        $gradebook->save();

        return $gradebook;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gradebook  $gradebook
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gradebook $gradebook)
    {
        $gradebook->delete();
        return new JsonResponse(true);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Task::all();
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
        $rules = array(
            'name' => 'required|max:255|min:3',
            'description' => 'required'
        );

        $data = $request->all();
        // All created tasks are incomplete
        $data['completed'] = 0;
        $v = Validator::make($data, $rules);

        if( ! $v->passes() ) {

            return [
                    'success' => false,
                    'response' => $v->errors()
            ];
        }

        return Task::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);

        if(!$task) {
            return response('Not found', 404);
        }

        return $task;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $rules = array(
            'name' => 'min:3|max:255',
            'completed' =>'required|boolean'
        );

        $v = Validator::make($data, $rules);
        if( ! $v->passes() ) {

            return [
                    'success' => false,
                    'response' => $v->errors()
            ];
        }

        $task = Task::find($id);

        if(!$task) {
            return response('Not found', 404);
        }

        $task->update($data);

        return $task;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        if($task) {
            $task->delete();

            return json_encode(['success' => 'user deleted']);
        }else {
            return response('Not found', 404);
        }

        
    }
}

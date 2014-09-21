<?php

class CourseClassesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id=null)
	{
		if($id){
			return CourseClass::where('group_id', $id)->get();
		}
		return CourseClass::all();
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return CourseClass::create(array(
		'group_id'=> Input::get('group_id'),
		'course_id'=> Input::get('course_id'),
		'day'=> Input::get('day'),
		'start_time'=> Input::get('start_time'),
		'end_time'=> Input::get('end_time'),
		'class_location'=> Input::get('class_location'),
		));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return CourseClass::find($id);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = Input::json();
		$courseClass = courseClass::find($id);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

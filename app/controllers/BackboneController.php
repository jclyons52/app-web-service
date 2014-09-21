<?php

class BackboneController extends BaseController {

	public function programs()
	{
		return View::make('programs.index');
	}

	public function groups()
	{
		return View::make('groups.index');
	}

	public function courseClasses()
	{
		return View::make('courseclasses.index');
	}
}
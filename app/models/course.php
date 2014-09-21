<?php 

class Course extends Eloquent {
	
	public function group(){
		return $this->belongsTo('group');
	}
}
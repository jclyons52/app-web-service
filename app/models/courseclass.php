<?php 

class CourseClass extends Eloquent {
	
	public $table = 'course_classes';
	public $timestamps = false;
	protected $fillable = array('group_id', 'course_id','day','start_time','end_time','class_location');

	public function program() {
		return $this->belongsTo('Program');
	}

	public function courseclasses() {
		return $this->hasMany('CourseClasses');
	}
	
}
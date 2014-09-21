<?php 

class Program extends Eloquent {
	public $table = 'programs';
	public $timestamps = false;
	protected $fillable = array('program_code', 'program_name', 'college');

	public function groups() {
		return $this->hasMany('Group');
	}
}



<?php 

class Group extends Eloquent {

	public $table = 'groups';
	public $timestamps = false;
	protected $fillable = array('group_code', 'program_id');

	public function program(){
		return $this->belongsTo('Program');
	}
}

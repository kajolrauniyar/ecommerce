<?php
class Banner extends Database{
	public function __construct(){
		Database::__construct();
		$this->table('banners');
	}
	public function addBanner($data,$is_die=false){
		return $this->insert($data,$is_die);
	}
	public function getAllBanner($is_die=false){
		return $this->select([],($is_die));//[]->array
		
	}
}

?>
<?php
abstract class Database{
	protected $conn;
	private $stmt = null;
	private $sql = null;
	private $table = null;


	public function __construct(){
		try{
			$this->conn = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME.";", DB_USER, DB_PWD);

			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$this->stmt = $this->conn->prepare("SET NAMES utf8");
			$this->stmt->execute();

		} catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').": (DB Connection): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){			
			error_log(date('Y-m-d h:i:s A').": (DB Connection): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		}
	}

	protected function getDataFromQuery($sql){
		try{
			$this->sql = $sql;
			$this->stmt = $this->conn->prepare($this->sql);
			$this->stmt->execute();
			$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;
		} catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').": (DB GetData): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){			
			error_log(date('Y-m-d h:i:s A').": (DB GetData): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		}
	}


	protected function runQuery($sql){
		try{
			
			$this->stmt = $this->conn->prepare($sql);
			return $this->stmt->execute();

		}  catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').": (DB RunQuery): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){			
			error_log(date('Y-m-d h:i:s A').": (DB RunQuery): ".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		}
	}

	protected function table($_table){
		$this->table = $_table;
	}

	protected final function select($args = array(), $is_die = false){
		try{
			// SELECT fields FROM table
			// JOIN statem
			// WHERE clause
			// GROUP BY clause
			// ORDER BY clause
			// LIMIT start, count
			$this->sql = "SELECT ";

			// Fields Set
			if(isset($args['fields']) && !empty($args['fields'])){
				if(is_array($args['fields'])){
					$this->sql .= " ".implode(", ",$args['fields']);
				} else {
					$this->sql .= " ".$args['fields'];
				}
			} else {
				$this->sql .= " * ";
			}
			// Fields Set


			// Set Table
			if(!isset($this->table) || empty($this->table)){
				throw new Exception("Table not set.");
			}
			$this->sql .= " FROM ".$this->table;
			// SET Table end

			// Join statement
			// Join statement

			// WHERE clause
			if(isset($args['where']) && !empty($args['where'])){
				$this->sql .= " WHERE ";
				if(is_array($args['where'])){
					// array // prepare key: value
					$temp_or = array();
					$temp_and = array();

					if(isset($args['where']['or']) && !empty($args['where']['or'])){

						foreach($args['where']['or'] as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp_or[] = $str;
						}
						$this->sql .= implode(" OR ", $temp_or);
					}

					if(isset($args['where']['and']) && !empty($args['where']['and'])){

						foreach($args['where']['and'] as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp_and[] = $str;
						}

						if(!empty($temp_or)){
							$this->sql .= " AND ";
						}
						$this->sql .= implode(" AND ", $temp_and);

					}

				/*
					$sql = "SELECT * FROM users 
							WHERE 
							email = :key AND status = :key ";
					$stmt = $this->conn->prepare($sql);
					$stmt->bindValue(":key", $email_address, PDO::PARAM_STR);

					echo $sql;
					exit;
				*/ 
				} else {
					$this->sql .= $args['where'];
				}
			}
			// WHERE clause

			$this->stmt = $this->conn->prepare($this->sql);

			if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
			
					if(isset($args['where']['or']) && !empty($args['where']['or']) ){
						foreach($args['where']['or'] as $column_name => $value){
							if(is_int($value)){
								$param = PDO::PARAM_INT;
							} else if(is_bool($value)){
								$param = PDO::PARAM_BOOL;
							} else {
								$param = PDO::PARAM_STR;
							}

							if(isset($param)){
								$this->stmt->bindValue(":".$column_name, $value, $param);
							}
						}

					}
					if(isset($args['where']['and']) && !empty($args['where']['and']) ){
						foreach($args['where']['and'] as $column_name => $value){
							if(is_int($value)){
								$param = PDO::PARAM_INT;
							} else if(is_bool($value)){
								$param = PDO::PARAM_BOOL;
							} else {
								$param = PDO::PARAM_STR;
							}

							if(isset($param)){
								$this->stmt->bindValue(":".$column_name, $value, $param);
							}
						}
					}	
			}

			if($is_die){
				debugger($args);
				echo $this->sql;
				exit;
			}


			$this->stmt->execute();
			$data = $this->stmt->fetchAll(PDO::FETCH_OBJ);
			return $data;

		}catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').": (DB SELECT): (SQL: ".$this->sql.")".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){			
			error_log(date('Y-m-d h:i:s A').": (DB SELECT): (SQL: ".$this->sql.")".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		}
	}


	protected final function update($data = array(), $args = array(), $is_die = false){
		/*
			UPDATE table SET 
				column_name_1 = :key_1,
				column_name_2 = :key_2,
				.....
			WHERE clause
		*/
		try{
			$this->sql = " UPDATE ";

			// Set Table
			if(!isset($this->table) || empty($this->table)){
				throw new Exception("Table not set.");
			}
			$this->sql .= $this->table." SET ";
			// SET Table end

			if(isset($data) && !empty($data)){
				if(is_array($data)){
					$temp = array();
					foreach($data as $column_name => $value){
						$temp[] = $column_name." = :".$column_name;
						// $temp[] = $str;
					}
					$this->sql .= implode(', ', $temp);
				} else {
					$this->sql .= $data;
				}
			} else {
				return -1;
			}


			// WHERE clause
			if(isset($args['where']) && !empty($args['where'])){
				
				$this->sql .= " WHERE ";

				if(is_array($args['where'])){
					// array // prepare key: value
					$temp_or = array();
					$temp_and = array();

					if(isset($args['where']['or']) && !empty($args['where']['or'])){

						foreach($args['where']['or'] as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp_or[] = $str;
						}
						$this->sql .= implode(" OR ", $temp_or);
					}

					if(isset($args['where']['and']) && !empty($args['where']['and'])){

						foreach($args['where']['and'] as $column_name => $value){
							$str = $column_name." = :".$column_name;
							$temp_and[] = $str;
						}

						if(!empty($temp_or)){
							$this->sql .= " AND ";
						}
						$this->sql .= implode(" AND ", $temp_and);

					}

				} else {
					$this->sql .= $args['where'];
				}
			}
			// WHERE clause			

			if($is_die){
				echo $this->sql;
				echo "<br>
					 *************************** DATA ********************";
				debugger($data);
				
				echo "<br>
					 *************************** Arguments ********************";
				debugger($args, true);
			}

			$this->stmt = $this->conn->prepare($this->sql);


			if(isset($data) && !empty($data) && is_array($data)){
				foreach($data as $column_name => $value){
					if(is_int($value)){
						$param = PDO::PARAM_INT;
					} else if(is_bool($value)){
						$param = PDO::PARAM_BOOL;
					} else {
						$param = PDO::PARAM_STR;
					}

					if(isset($param)){
						$this->stmt->bindValue(":".$column_name, $value, $param);
					}
				}
			}



			if(isset($args['where']) && !empty($args['where']) && is_array($args['where'])){
			
					if(isset($args['where']['or']) && !empty($args['where']['or']) ){
						foreach($args['where']['or'] as $column_name => $value){
							if(is_int($value)){
								$param = PDO::PARAM_INT;
							} else if(is_bool($value)){
								$param = PDO::PARAM_BOOL;
							} else {
								$param = PDO::PARAM_STR;
							}

							if(isset($param)){
								$this->stmt->bindValue(":".$column_name, $value, $param);
							}
						}

					}
					if(isset($args['where']['and']) && !empty($args['where']['and']) ){
						foreach($args['where']['and'] as $column_name => $value){
							if(is_int($value)){
								$param = PDO::PARAM_INT;
							} else if(is_bool($value)){
								$param = PDO::PARAM_BOOL;
							} else {
								$param = PDO::PARAM_STR;
							}

							if(isset($param)){
								$this->stmt->bindValue(":".$column_name, $value, $param);
							}
						}
					}	
			}


			return $this->stmt->execute();

		} catch(PDOException $e){
			error_log(date('Y-m-d h:i:s A').": (DB UPDATE): (SQL: ".$this->sql.")".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		} catch(Exception $e){			
			error_log(date('Y-m-d h:i:s A').": (DB UPDATE): (SQL: ".$this->sql.")".$e->getMessage()."\r\n", 3, ERROR_PATH."error.log");
			return false;
		}
	}
}
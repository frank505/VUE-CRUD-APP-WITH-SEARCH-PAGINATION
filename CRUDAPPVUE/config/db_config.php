<?php
class config{
private $host = "localhost";
private $root = "root";
private $password = "";
private $db_name = "crudappvue";
protected $connection;
private $query_db;
private $row_count;
private $fetch_array;
public static $instance;
//the database connection is established in the constructor
public function __construct(){
    $this->connection = mysqli_connect($this->host, $this->root,$this->password,$this->db_name);
      if(!$this->connection){
    throw new Exception("database connection error");
  }
}


//this performs query operations
public  function query($selection){
  $this->query =  mysqli_query($this->connection, $selection);
  return $this->query;
}

//this returns the total row count in a table as demanded
public function rowcount($numrows){
$this->row_count =  mysqli_num_rows($numrows);
return $this->row_count;
}

//this fetches elements from the database in an array
//please note that this was barely used in this code as the developer preffered the foreach loop
public function fetcharray($arrayfetch){
$this->fetch_array =  mysqli_fetch_array($arrayfetch);
return $this->fetch_array;
}

public function insert($table_name,$userData) {
  $count = 0;
@$fields = '';
foreach($userData as $col => $val) {
  if ($count++ != 0) $fields .= ', ';
  if($count==1){
    @$field .= $col;
    @$value .= "'".$val."'";
  }
  else{
     @$field .= ','.$col;
     @$value .= ",'".$val."'";  
      }
  $fields .= "`$col` = $val";
 }
$query = "INSERT INTO $table_name ($field) VALUES ($value)";
return $query;
}

  

public function update($table,$values,$where_clause)
{
  foreach ($values as $key => $val)
  {
    $valstr[] = $key." = '$val'";
  }

 $update_query = 'UPDATE '.$table.' SET '.implode(', ', $valstr)
 ." WHERE ".$where_clause; 
  return $update_query;
}

public function delete( $table,$where_clause=null)
{
  $query = "";
  if($where_clause==null){
    $query =  "DELETE FROM $table"; 
  }else{
    $query = "DELETE FROM $table $where_clause";

  }
    return $query;
}


//end of this class
}

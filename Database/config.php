<?php
class Database{
// specify your own database credentials
private $host = "localhost:3307";
private $db_name = "rts";
private $username = "root";
private $password = "";
public $conn;
private $result=array();
public $sql;
public $res;

    public function __construct(){
        $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->db_name);
    }

    public function insert($table,$para=array()){
        $table_columns = implode(',', array_keys($para));
        $table_value = implode("','", $para);

        $sql="INSERT INTO $table($table_columns) VALUES('$table_value')";

        $this->result = $this->conn->query($sql);
    }

    public function update($table,$para=array(),$column,$id){
        $args = array();

        foreach ($para as $key => $value) {
            $args[] = "$key = '$value'"; 
        }

        $sql="UPDATE $table SET " . implode(',', $args);

        $sql .=" WHERE $column=$id";

        $this->res = $this->conn->query($sql);
        
    }

    public function delete($table,$column,$id){
        $sql="DELETE FROM $table";
        $sql .=" WHERE $column=$id ";
        $sql;
        $result = $this->conn->query($sql);
    }

    public function select($table,$rows="*",$where = null){
        if ($where != null) {
            $sql="SELECT $rows FROM $table WHERE $where";
            
        }else{
            $sql="SELECT $rows FROM $table";
        }
        
        $this->sql = $result = $this->conn->query($sql);
    }

    public function __destruct(){
        $this->conn->close();
    }

}
?>

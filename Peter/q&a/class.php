<?php
class Database {
    public $db_host = "localhost";
    public $db_name = "test"; // you must write your db name
    public $db_user = "root";
    public $db_pw = "";
    public $connection = '';
    // public function chooseDB($dbHost, $dbName, $dbUser, $dbPw){
    //  $this->connection = mysqli_connect($dbHost, $dbUser, $dbPw, $dbName);
    // }
    public function connect() {
        //the @ sign will remove any warnings from mysqli!
        $this->connection = @mysqli_connect($this->db_host,$this->db_user,$this->db_pw,$this->db_name);
    }
// SELECT * FROM TableName $join
// SELECT first_name from users
// SELECT first_name , last_name from users
    public function read($table, $fields='*', $join='',$where='',$orderby='') {
        $this->connect(); // $this->connection;
        //array(first_name, lastname) => firstname , lastname  /////    firstname
        $fields = is_array($fields) ? implode(", ", $fields) : $fields;
        // inner join tableName on --------- inner join table2 on -------------
        $join = is_array($join) ? implode(" ", $join) : $join;
        $sql = "SELECT ".$fields." FROM ".$table." ".$join." ".$where." ".$orderby." ;";
        //echo $sql; //only for testing
        $result = $this->connection->query($sql); // mysqli_query($conn, $sql) <=> $conn->query($sql)
        //$return = $result->fetch_all(MYSQLI_ASSOC);
        if($result->num_rows == 0 ){
            $row = "No result";
    }elseif($result->num_rows == 1){
            $row = $result->fetch_assoc();
    }else {
            $row= $result->fetch_all(MYSQLI_ASSOC);
    }
    mysqli_close($this->connection);
    return $row;
    }
//read("users",array("first_name","last_name"))
//read("users","first_name")
// $set = array('colName'=> value , 'colName2'=>value)
// UPDATE tableName SET colName1 = value1 , colName2 = val2 , colName3 = val3
// WHERE user_id = 1 AND first_name = 'serri'
    public function update($table,$set,$condition) {
        $this->connect();
        $sql = '';
        $where= '';
        // $sql = ''  => $sql = 'first_name = 'serri''
        // 'first_name = 'serri', last_name = value '
        foreach ($set as $key => $value) {
        // $sql = first_name = 'serri', last_name = ghiath
        if($sql != ''){
        $sql .=", ";
    }
    if(is_numeric($value)){
            $sql .= $key . "=".$value;
    }else {
            $sql .= $key . "='".$value."' ";
    }
    }
    foreach ($condition as $key => $value) {
        if($where != ''){
        $where .=" AND ";
    }
    if(is_numeric($value)){
            $where .= $key . "=" . $value ;
    }else {
            $where .= $key . "='" . $value . "'";
    }
    }
    $sql = "UPDATE ".$table." SET ".$sql." WHERE ".$where.";";
    // UPDATE users SET first_name = 'ghiath', last_name = 'serri', age = 30 WHERE user_id = 4
    $this->connection->query($sql);
    mysqli_close($this->connection);
    }
// INSERT INTO tableName (col1, col2 , col3) VALUES ('val1' , 'val2', val3)
    public function insert($table, $fields, $values) {
        $this->connect();
        $fields = is_array($fields) ? implode(", ", $fields) : $fields;
        //$values = implode("','", $values);
        $sql = '';
        // $values 'ghiath', 'serri', 30
        if (is_array($values)){
        foreach ($values as $value) {
        if ($sql !=''){
        $sql .=", ";
    }
    if(is_numeric($value)){
            $sql .= " ".mysqli_real_escape_string($this->connection,$value)." ";
    }else {
            $sql .= "'".mysqli_real_escape_string($this->connection,$value)."'";
    }
    }
    } else {
        $sql = $values;
    }
    $sql = "INSERT INTO ".$table." (".$fields.") VALUES (".$sql.");";
    $res = $this->connection->query($sql);
    echo "success";
    mysqli_close($this->connection);
    }
//delete('users', array('userId'=> $_GET['id'], 'first_name'=>$_POST['first_name']))
// delete from users where userId = 5 AND first_name = 'serri'
//array('userId'=> 5, 'first_name'=>'serri')
    public function delete($table,$condition) {
        $this->connect();
        $sql='';
        foreach ($condition as $key => $value) {
        if($sql != ''){
        $sql .=" AND ";
    }
    if(is_numeric($value)){
            $sql .= $key . "=" . $value ;
    }else {
            $sql .= $key . "='" . $value . "'";
    }
    }
    $sql="DELETE FROM ".$table." WHERE ".$sql;
    $result = $this->connection->query($sql);
    mysqli_close($this->connection);
    }
}
$obj = new Database ();
// read($table, $fields='*', $join='',$where='',$orderby='')
// $result = $obj->read("media", '*', 'INNER JOIN author ON media.FK_author = author.authorId' );
// foreach ($result as $value) {
    //  echo $value['title']. " | ". $value['authorFirstName']. "<br>" ;
    // }
// $obj->insert('employees',array('name','position','salary'),array('acilio','IT',8000));
// $rows = $obj->read('employees');
// foreach ($rows as $row) {
    //  echo $row['name']."<br>";
    // }
//$names = array("first_name","last_name","age");
// $result = is_array($names);
// echo $result;
// $names = implode(' , ',$names);
// echo $names;
 ?>
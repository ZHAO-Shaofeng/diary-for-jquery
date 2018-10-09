<?php

    class Mysql{
        private $host;//服务器地址
        private $root;//用户名
        private $password;//密码
        private $database;//数据库名

        //构造方法
        function __construct($host,$root,$password,$database){
            $this->host = $host;
            $this->root = $root;
            $this->password = $password;
            $this->database = $database;
            $this->connect();
        }

        //创建连接数据库
        function connect(){
            $this->conn = mysqli_connect($this->host,$this->root,$this->password) or die("DB Connnection Error !".mysql_error());
            mysqli_select_db($this->conn,$this->database);
            // mysqli_query($this->conn,"set names utf8");
            mysqli_query($this->conn,"set names utf8mb4");
        }
        //关闭数据库方法
        function dbClose(){
            mysqli_close($this->conn);
        }
        //执行语句
        function query($sql){
            return mysqli_query($this->conn, $sql);
        }

        function myArray($result){
            return mysqli_fetch_array($result);
        }

        function rows($result){
            return mysqli_fetch_row($result);
        }

        function assoc($result){
            return mysqli_fetch_assoc($result);
        }

        //自定义查询数据方法
        function select($tableName,$condition=null){
            return $this->query("SELECT * FROM $tableName $condition");
        }

        //自定义插入数据方法
        function insert($tableName,$fields,$value){
            $this->query("INSERT INTO $tableName $fields VALUES$value");
        }

        //自定义修改数据方法
        function update($tableName,$change,$condition=null){
            $this->query("UPDATE $tableName SET $change $condition");
        }

        //自定义删除数据方法
        function delete($tableName,$condition=null){
            $this->query("DELETE FROM $tableName $condition");
        }
    }

    // $mysql_server="sqld-hk.bcehost.com";
    // $mysql_username="67cb972e192748e09fd329651afebff6";
    // $mysql_password="8dd236dec7be4b43a29bbdb87370ff00";
    // $mysql_database="hnICYGAyEkeDpfZXJbLV";

    //本地测试
   $mysql_server="localhost";
   $mysql_username="root";
   $mysql_password="root";
   $mysql_database="test";
    $db = new Mysql($mysql_server,$mysql_username,$mysql_password,$mysql_database);
?>
<?php
class ConnectModel{
    protected $username="if0_37294526";
    protected $password="U0YiCcu0FzekE";
    protected $host="sql201.infinityfree.com";
    protected $table;
    protected $charset="utf8";
    protected $dbname="if0_37294526_project";
    protected $connect;
    protected $server="mysql";
    protected $dsn;
    protected $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    function __construct(){
        if ($this->server=="mysql") {
         $this->dsn="mysql:host=$this->host;charset=$this->charset;dbname=$this->dbname";
         try {
            $this->connect=new PDO($this->dsn,$this->username,$this->password,$this->options);
         } catch (\PDOException $th) {
            throw new PDOException($th->getMessage(),$th->getCode());
            
         }
        }
       
    }
    function get_users(string $query,array $params=[]){
     $stmt =$this->connect->prepare($query);
     $stmt->execute($params);
     $output=$stmt->fetchAll();
     return $output;
    }
    function get_user(string $query,array $params=[]){
        $stmt =$this->connect->prepare($query);
        $stmt->execute($params);
        $output=$stmt->fetch();
        return $output;
       }
       function get_message(string $query,array $params=[]):array{
           $stmt=$this->connect->prepare($query);
           $stmt->execute($params);
           $output=$stmt->fetch();
           return $output;
       }
       function get_products(string $query,array $params=[]):array{
        $stmt=$this->connect->prepare($query);
        $stmt->execute($params);
        $output=$stmt->fetchAll();
        return $output;
    }
} 
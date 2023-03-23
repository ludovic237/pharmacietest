<?php
class Model{

    static $connections = array();
    public $conf = 'default';
    public $table = false;
    public $db;
    public $primaryKey = 'id';
    public function __construct(){

        //j'initialise qques variables
        if($this->table === false){
            $this->table = strtolower(get_class($this));

        }
        // Jme connecte à la base

        $conf = Conf::$database[$this->conf];
        if(isset(Model::$connections[$this->conf])){
            $this->db = Model::$connections[$this->conf];
            return true;
        }
        try {
            $pdo = new PDO(
                'mysql:host=' . $conf['host'] . ';dbname=' . $conf['database'] . ';',
                $conf['login'],
                $conf['password'],
                array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
            );
            $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            Model::$connections[$this->conf] = $pdo;
            $this->db = $pdo;
        } catch (PDOException $e) {
            if(Conf::$debug >= 1){
                die($e->getMessage());
            }else{
                die('Impossible de se connecter à la base de données');
            }

        }

    }

    public function find($req){
        $sql = 'SELECT ';


        // Sert à préciser les champs à renvoyer
        if(isset($req['fields'])){
            if(is_array($req['fields'])){
                $sql .= implode(', ',$req['fields']);
            }else{
                $sql .= $req['fields'];
            }
        }else{
            $sql .= '*';
        }

        $sql .=' FROM ';

        // Sert à sélectionner les tables à traiter
        if(isset($req['table'])){
            if(is_array($req['table'])){
                $sql .= implode(', ',$req['table']);
            }else{
                $sql .= $req['table'];
            }
        }else{
            $sql .=$this->table.' as '.get_class($this);
        }


        // Construction de la condition
        if(isset($req['conditions'])){
            $sql .= ' WHERE ';
            if(!is_array($req['conditions'])){
                $sql .= $req['conditions'];
            }
            else{
                $cond = array();
                foreach($req['conditions'] as $k=>$v){
                    if(!is_numeric($v)){
                       //$v = '"'.mysql_escape_string($v).'"';
                    }
                    $cond[] = "$k=$v";
                }
                $sql .= implode(' AND ',$cond);
            }
        }

        // Condition ORDER
        if(isset($req['order'])){
            list($field, $action) = explode("-", $req['order']);
            $sql .= ' ORDER BY '.$field.' '.$action;
        }

        // Condition LIMIT
        if(isset($req['limit'])){
            $sql .= ' LIMIT '.$req['limit'];
        }
        //die($sql);
        //echo $sql."\n";
        $pre = $this->db->prepare($sql);
        $pre->execute();
        return $pre->fetchAll(PDO::FETCH_OBJ);
    }

    public function findFirst($req){
        return current($this->find($req)); // current est une fonction qui renvoit uniquement le premier élément du tableau
    }

    public function findCount($condition,$primaryKey,$table){
        $res = $this->findFirst(array(
            'fields' => 'COUNT('.$primaryKey.') as count',
            'table' => $table,
            'conditions' => $condition
        ));
        return $res->count;
    }

    public function delete ($id,$table = null,$nom_id){
        $sql = 'UPDATE '.$table.' SET supprimer = 1 WHERE '.$nom_id.' =  "'.$id.'"';
        //die($sql);
        $pre = $this->db->prepare($sql);
        $pre->execute();
    }

    public function insert_batch($tbl,$insertFieldsArr,$arr){ $sql = array();
        foreach( $arr as $row ) {
            $strVals='';
            $cnt=0;
            foreach($insertFieldsArr as $key=>$val){
                if(is_array($row)){
                    $strVals.="'".addslashes($row[$cnt]).'\',';
                }
                else{
                    $strVals.="'".addslashes($row).'\',';
                }
                $cnt++;
            }
            $strVals=rtrim($strVals,',');
            $sql[] = '('.$strVals.')';
        }

        $fields=implode(',',$insertFieldsArr);
        $sql1 = 'INSERT INTO `'.$tbl.'` ('.$fields.') VALUES '.implode(',', $sql);
        $pre = $this->db->prepare($sql1);
        $pre->execute();

    }



}
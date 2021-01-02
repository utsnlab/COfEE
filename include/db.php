<?php
class dbclass
{
    var $Query;
    var $Connection;
    function mysql($server, $username, $password, $database)
    {
        $this->Connection = mysqli_connect( $server, $username, $password );
//        or die('error connecting :'.mysqli_error());
        mysqli_select_db(  $this->Connection, $database);
//        or die('wrong database: '.mysqli_error($this->Connection));
    }

    function close()
    {
        mysqli_close( $this->Connection ) or die ('Error on close : '.mysqli_error($this->Connection));
    }

    function Query($sql)
    {
        $Q =  mysqli_query($this->Connection, $sql) or die( 'error:'.mysqli_error($this->Connection) );
        return $Q;
    }
    function iquery($table, $data)
    {
        $field = '';
        $value='';
        foreach ($data as $filds => $val) {
            $field .= "`$filds`, ";
            if($val == ""){
                $value .= stripslashes("NULL, ");
            }else{
                $value .= stripslashes("'" .$val . "', ");
            }
        }
        // http_response_code(400);
        // echo "INSERT INTO `".$table."`"."(" . rtrim($field, ', ') . ") VALUES (" . rtrim($value, ', ') . ");";
        // die();
        $insert=$this->Query("INSERT INTO `".$table."`"."(" . rtrim($field, ', ') . ") VALUES (" . rtrim($value, ', ') . ");") or die(mysqli_error($this));
        return $insert;
    }
    function insert_id()
    {
        return mysqli_insert_id($this->Connection);
    }
    function uquery($table, $data, $id = '')
    {
        $foreach = '';
        foreach ($data as $filds => $value) {
            $foreach .= "`$filds`='". stripcslashes($value)."' , ";
        }
        $id = ($id == '') ? '' : ' WHERE '.$id;
        $update = $this->Query("UPDATE `".$table."` SET ". rtrim($foreach, ', ' ) .$id.' ;')  or die(mysqli_error());
        return $update;
    }

    function fetch($query)
    {
        $re = mysqli_fetch_assoc($query);
        return $re;
    }

    function GetRowValue($field, $Q, $raw = false)
    {
        $Q = ($raw) ? $this->Query($Q) : $Q;
        $row = mysqli_fetch_assoc ($Q);
        $row = $row[$field];
        return $row;
    }

    function getrows($query, $raw = false)
    {
        $query = ($raw) ? $this->Query($query) : $query;
        $rows = mysqli_num_rows($query);
        $rows = empty($rows) ? 0 : $rows;
        return $rows;
    }

    function getmax($field, $table)
    {
        $id = $this->Query("SELECT MAX(`$field`) as id FROM `$table`");
        $id = $this->fetch($id);
        $id = $id['id'];
        return $id;
    }
    function affected()
    {
        $r = mysqli_affected_rows($this->Connection);
        return $r;
    }
}

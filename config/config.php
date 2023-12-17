<?php

session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh'); 
// $base_url = 'https://116.118.49.88/'; 
$base_url = 'https://trungkien.phanngochau.online/'; 

//error_reporting(0);
class PNH
{
    private $ketnoi;
    function connect()
    {
        if (!$this->ketnoi)
        {
            // $this->ketnoi = mysqli_connect('localhost', 'root', '', 'trungkien') or die ('Vui lòng kết nối đến DATABASE'); 
            $this->ketnoi = mysqli_connect('localhost', 'sql_trungkien_ph', 'acZpLyiBHHrHCBWB', 'sql_trungkien_ph') or die ('Vui lòng kết nối đến DATABASE'); 
            mysqli_query($this->ketnoi, "set names 'utf8'"); 
        }
    }
    function dis_connect()
    {
        if ($this->ketnoi)
        {
            mysqli_close($this->ketnoi);
        }
    }
    function getUser($username)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `users` WHERE `username` = '$username' ")->fetch_array();
        return $row;
    }
    function site($data)
    {
        $this->connect();
        $row = $this->ketnoi->query("SELECT * FROM `options` WHERE `name` = '$data' ")->fetch_array();
        return $row['value'];
    }
    function query($sql)
    {
        $this->connect();
        $row = $this->ketnoi->query($sql);
        return $row;
    }
    function cong($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` + '$sotien' WHERE $where ");
        return $row;
    }
    function tru($table, $data, $sotien, $where)
    {
        $this->connect();
        $row = $this->ketnoi->query("UPDATE `$table` SET `$data` = `$data` - '$sotien' WHERE $where ");
        return $row;
    }
    function insert($table, $data)
    {
        $this->connect();
        $field_list = '';
        $value_list = '';
        foreach ($data as $key => $value)
        {
            $field_list .= ",$key";
            $value_list .= ",'".mysqli_real_escape_string($this->ketnoi, $value)."'";
        }
        $sql = 'INSERT INTO '.$table. '('.trim($field_list, ',').') VALUES ('.trim($value_list, ',').')';
 
        return mysqli_query($this->ketnoi, $sql);
    }
    function update($table, $data, $where)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value)
        {
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where;
        return mysqli_query($this->ketnoi, $sql);
    }
    function update_value($table, $data, $where, $value1)
    {
        $this->connect();
        $sql = '';
        foreach ($data as $key => $value){
            $sql .= "$key = '".mysqli_real_escape_string($this->ketnoi, $value)."',";
        }
        $sql = 'UPDATE '.$table. ' SET '.trim($sql, ',').' WHERE '.$where.' LIMIT '.$value1;
        return mysqli_query($this->ketnoi, $sql);
    }
    function remove($table, $where)
    {
        $this->connect();
        $sql = "DELETE FROM $table WHERE $where";
        return mysqli_query($this->ketnoi, $sql);
    }
    function get_list($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $return = array();
        while ($row = mysqli_fetch_assoc($result))
        {
            $return[] = $row;
        }
        mysqli_free_result($result);
        return $return;
    }
    function get_row($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
    function num_rows($sql)
    {
        $this->connect();
        $result = mysqli_query($this->ketnoi, $sql);
        if (!$result)
        {
            die ('Câu truy vấn bị sai');
        }
        $row = mysqli_num_rows($result);
        mysqli_free_result($result);
        if ($row)
        {
            return $row;
        }
        return false;
    }
}
/* THUÊ CODE WEBSITE THEO YÊU CẦU VUI LÒNG LIÊN HỆ PNH | ZALO:  | FB.COM/ */
if(isset($_SESSION['username']))
{ 
    $PNH = new PNH;
    $getUser = $PNH->get_row(" SELECT * FROM users WHERE username = '".$_SESSION['username']."' ");
    $my_username = True;
    $my_level = $getUser['level'];
    $my_phone = $getUser['phone'];
    $my_id = $getUser['id'];
    if(!$getUser)
    {
        session_start();
        session_destroy();
        header('location: /');
    }
}
else
{
    $my_level = NULL;
}
function CheckLogin()
{
    global $my_username;
    if($my_username != True)
    {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "'.BASE_URL('Login').'" }, 0);</script>');
    }
}
function CheckAdmin()
{
    global $my_level;
    if($my_level == 'member' || $my_level == 'daily')
    {
        return die('<script type="text/javascript">setTimeout(function(){ location.href = "'.BASE_URL('Login').'" }, 0);</script>');
    }
}
/* THUÊ CODE WEBSITE THEO YÊU CẦU VUI LÒNG LIÊN HỆ PNH | ZALO:  | FB.COM/ */
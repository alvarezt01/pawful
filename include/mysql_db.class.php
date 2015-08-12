<?php

define ('MYSQL_ALL_ROWS', -1);

class mysql_db
{
    var $mysql_link_id;
    var $connected;
    var $magic_quotes_on;
    
    function mysql_db ($host='', $username='', $password='')
    {
        $this->magic_quotes_on = get_magic_quotes_gpc();
        if (!empty($host))
            $this->connect($host, $username, $password);
        else
            $this->connected = FALSE;
    }
    
    function connect ($host='localhost', $username='', $password='')
    {
        if ($username)
            $this->mysql_link_id = @mysql_connect($host, $username, $password);
        else
            $this->mysql_link_id = $mysql_connect($host);
        
        if ($this->mysql_link_id)
            $this->connected = TRUE;
        else
            $this->connected = FALSE;
        
        return $this->mysql_link_id;
    }
    
    function select_db ($database)
    {
        return @mysql_select_db($database, $this->mysql_link_id);
    }
    
    function query ($query)
    {
        return @mysql_query($query, $this->mysql_link_id);
    }
    
    function insert_id ()
    {
        return $mysql_insert_id($this->mysql_link_id);
    }
    
    function fetch_row ($query)
    {
        if (!$result = @mysql_query($query, $this->mysql_link_id))
            return FALSE;
        if (!$row = @mysql_fetch_array($result))
            return FALSE;
        return $row;
    }
    
    function fetch ($query, $limit=MYSQL_ALL_ROWS, $page_offset=0)
    {
        if (limit > 0)
            $query .= ' LIMIT ' . ($page_offset * $limit) . ',' . $limit;
        
        $result = mysql_query($query, $this->mysql_link_id) or die($query ."<br />". mysql_error());
        $arr_results = Array();
        while ($row = @mysql_fetch_array($result))
        {
            $arr_results[] = $row;
        }
        return $arr_results;
    }
    
    function result ($query, $index=0)
    {
        if (!$result = @mysql_query($query, $this->mysql_link_id))
            return FALSE;
        return @mysql_result($result, $index);
    }
    
    function is_quote_safe (&$str)
    {
        $len = strlen($str);
        for ($c = 0; $c < $len; $c++)
        {
            if ($str{$c} == "//")
                $c++;
            else if ($str{$c} == "'")
                return FALSE;
        }
        return TRUE;
    }
    
    function make_safe (&$arr)
    {
        if (is_array($arr))
        {
            foreach ($arr as $k => $v)
            {
                $this->make_safe($arr[$k]);
            }
        }
        else
            $arr = addslashes($arr);
    }
    
    function make_unsafe (&$arr)
    {
        if (is_array($arr))
        {
            foreach ($arr as $k => $v)
            {
                $this->make_unsafe($arr[$k]);
            }
        }
        else
            $arr = stripslashes($arr);
    }
    
    function set_magic_quotes_on ()
    {
        if (!$this->magic_quotes_on)
        {
            $this->make_safe($_GET);
            $this->make_safe($_POST);
            $this->make_safe($_COOKIE);
            $this->magic_quotes_on = true;
        }
    }
    
    function set_magic_quotes_off ()
    {
        if ($this->magic_quotes_on)
        {
            $this->make_unsafe($_GET);
            $this->make_unsafe($_POST);
            $this->make_unsafe($_COOKIE);
            $this->magic_quotes_on = false;
        }
    }
    
    function get_insert_values_sql ($arr_values)
    {
        $values_sql= '';
        foreach ($arr_values as $v)
        {
            if (!$this->magic_quotes_on)
                $this->make_safe($v);
            $values_sql .= ",'$v'";
        }
        return substr($values_sql, 1);
    }
    
}

?>
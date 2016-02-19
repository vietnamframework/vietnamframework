<?php

class VNDB
{

    private $dbh;

    private $in_transaction;

    private $_last_param;
    private $_last_sql;

/**
 * 
 * @param string $target
 */
    public function __construct($target='')
    {
        $dpparm = db_config($target);
        try {
            $this->dbh = new PDO($dpparm['dsn'], $dpparm['username'], $dpparm['password'], $dpparm['driver_options']);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
        
        $this->in_transaction = false;
    }

    protected function begin_transaction() {
        try {
            $this->dbh->beginTransaction();
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
        $this->in_transaction = true;
    }

    protected function commit() {
        try {
            $this->dbh->commit();
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
        $this->in_transaction = false;
    }

    protected function rollback() {
        if ($this->in_transaction == false) {
            return;	
        }
        $this->in_transaction = false;
        try {
            $this->dbh->rollBack();
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
    }

    protected function query($sql, $param=null) {

        VNLog::sql($sql, $param);
        // PREPARE
        $stmt = $this->_internal_prepare($sql);
        // execute
        $this->_internal_execute($stmt, $param);
        // FETCH
        return $this->_internal_fetch($stmt);
    }

    protected function execute($sql, $param=null) {

        VNLog::sql($sql, $param);
        // PREPARE
        $stmt = $this->_internal_prepare($sql);
        // execute
        $this->_internal_execute($stmt, $param);
    }

    protected function execute_procedure($sql, &$out_param, $in_param=null, $out_length=4000) {

        VNLog::sql($sql, $in_param);
        // PREPARE
        $stmt = $this->_internal_prepare($sql);
        try {
            if (is_null($in_param) == false) {
                
                foreach ($in_param as $key => $val) {
                    if ($this->_is_db_null($val) == true) {
                        
                        $stmt->bindValue(':' . $key, null, PDO::PARAM_NULL);
                    } else {
                        $stmt->bindValue(':' . $key, $val);
                    }
                }
            }
            
            foreach ($out_param as $key => $val) {
                if ($this->_is_db_null($val) == true) {
                    $out_param[$key] = null;
                }
                $stmt->bindParam(':' . $key, $out_param[$key], PDO::PARAM_STR|PDO::PARAM_INPUT_OUTPUT, $out_length);
            }

            $stmt->execute(); 
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
    }

    protected function prepare($sql) {
        VNLog::sql_statement($sql);
        return $this->_internal_prepare($sql);
    }

    protected function prepared_execute($stmt, $param=null) {
        
        VNLog::sql('prepared_execute', $param);
        $this->_internal_execute($stmt, $param);
    }

    protected function prepared_query($stmt, $param=null) {

        VNLog::sql('prepared_query', $param);
        $this->_internal_execute($stmt, $param);
        // FETCH
        return $this->_internal_fetch($stmt);
    }

    private function _internal_prepare($sql) {
        try {
            $this->_last_sql = $sql;	
            $this->_last_param = null;	
            $stmt = $this->dbh->prepare($sql);
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
        return $stmt;
    }

    private function _internal_execute($stmt, $param) {
        try {
            if (is_null($param) == false) {
                $this->_last_param = $param;
                foreach ($param as $key => $val) {
                    if ($this->_is_db_null($val) == true) {
                        $stmt->bindValue(':' . $key, null, PDO::PARAM_NULL);
                    } else {
                        $stmt->bindValue(':' . $key, $val);
                    }
                }
            }
            $stmt->execute();
        } catch (PDOException $e) {
            $this->_db_error($e);
        }
    }
    
    private function _internal_fetch($stmt) {
        $all = array();
        try {
            
            for (;;) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($result === false) {
                    break;
                }
                $all[] = $result;
            }
        } catch (PDOException $e) {
            $this->_db_error($e);
        }

        return $all;
    }
    
    private function _is_db_null($value) {
        if (is_null($value)) {
            return true;
        }

        if (is_string($value) == false) {
            settype($value, "string");
        }

        if ($value == '') {
            return true;
        }

        return false;
    }

    private function _db_error($e) {
        if ($this->in_transaction == true) {
            $this->in_transaction = false;
            $this->dbh->rollBack();
        }

        $line = $e->getMessage();
        $line .= $this->_last_sql . "\r\n";
        if (is_null($this->_last_param) == false) {
            $line .= var_export($this->_last_param, true) . "\r\n";
        }
        VNLog::sql_err($line);

        throw $e;
    }
}

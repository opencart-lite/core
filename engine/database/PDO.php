<?php namespace Engine\Database;

use stdClass;
use PDOException;
use Engine\Core\CoreException;

class PDO {
    private $link;

    public function __construct($driver, $hostname, $username, $password, $database) {

        $dsn = "$driver:host=$hostname;dbname=$database";

        try {

            $this->link = new \PDO($dsn, $username, $password);

        } catch (PDOException $e) {
            echo 'PDOException Connection failed: ' . $e->getMessage();
            exit();
        }

        $this->link->exec("SET NAMES 'utf8'");
        $this->link->exec("SET CHARACTER SET utf8");
        $this->link->exec("SET CHARACTER_SET_CONNECTION=utf8");
        $this->link->exec("SET SQL_MODE = ''");
    }

    public function query($sql) {
        if ($this->link) {
            $object = $this->link->query($sql);

            if ($object) {
                if (is_object($object)) {
                    $i = 0;

                    $data = array();

                    while ($row = $object->fetch(\PDO::FETCH_ASSOC)) {
                        $data[$i] = $row;
                        $i++;
                    }

                    $object = null;

                    $query = new stdClass();
                    $query->row = isset($data[0]) ? $data[0] : array();
                    $query->rows = $data;
                    $query->num_rows = $i;

                    unset($data);

                    return $query;
                } else {
                    return true;
                }
            } else {
                try{
                    throw new CoreException("Error Query - (( $sql ))");
                }
                catch (CoreException $e) {exit();}
            }
        }
    }

    public function exec($sql) {
        if ($this->link) {
            return $this->link->exec($sql);
        }
    }

    public function escape($value) {
        if ($this->link) {
            return $this->link->quote($value);
        }
    }

    public function getLastId() {
        if ($this->link) {
            return $this->link->lastInsertId();
        }
    }

    public function __destruct() {
        $this->link = null;
    }
}
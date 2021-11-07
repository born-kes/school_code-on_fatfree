<?php

namespace v1;


use v1\interfaces\ControllerInterface;
use v1\interfaces\IDataBase;

class ControllerDB implements ControllerInterface, IDataBase
{
    private static $instances = [];
    private $serw;
    private $host;
    private $port;
    private $pass;
    private $user;
    private $db_name;
    private $pdo;

    private $options = [
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
        \PDO::ATTR_PERSISTENT => TRUE,
        \PDO::MYSQL_ATTR_COMPRESS => TRUE,
    ];

    private function __construct($f3)
    {
        $this->serw = (string) $f3->get('DB_SERV');
        $this->host = (string) $f3->get('DB_HOST');
        $this->port = (string) $f3->get('DB_PORT');

        $this->db_name = (string) $f3->get('DB_NAME');
        $this->user = (string)$f3->get('DB_USER');
        $this->pass = (string) $f3->get('DB_PASS');

    }

    public static function getInstance($f3): IDataBase
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($f3);
        }
        return self::$instances[$cls];
    }
    /**
     * @param \Base $f3
     * @return string
     */
    public function response(\Base $f3)
    {
        $db = self::getInstance($f3);
        return $db->_connect();
    }

    public function _connect( $options = '') : \DB\SQL
    {
        if (is_null($this->pdo)) {

            try {
                if ($options==='')
                    $options = $this->options;

                 $dsn = "{$this->serw}:host={$this->host};port={$this->port};dbname={$this->db_name}";

                $this->pdo =
                    new \DB\SQL(
                        $dsn,
                        $this->user,
                        $this->pass,
                        $options
                );
            } catch (\PDOException $e) {
                // $err = $e->errorInfo;
                $message = $e->getMessage();
                throw new \Exception($message);
            }
        }
        return $this->pdo;
    }

    protected function __clone() { }
    public function __toString():string { return '';}
    public function __wakeup()
    {
        throw new \Exception("Cannot unserialize a singleton.");
    }
}
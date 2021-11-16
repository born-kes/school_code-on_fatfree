<?php
namespace v1;

use v1\interfaces\IDataBase;

class ControllerDB implements IDataBase
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

    private function __construct($config)
    {
        $this->serw = (string) $config['DB_SERV'];
        $this->host = (string) $config['DB_HOST'];
        $this->port = (string) $config['DB_PORT'];

        $this->db_name = (string) $config['DB_NAME'];
        $this->user = (string) $config['DB_USER'];
        $this->pass = (string) $config['DB_PASS'];
    }

    /**
     * @param $f3
     * @return mixed
     */
    public static function getInstance($config) : IDataBase
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static($config);
        }
        return self::$instances[$cls];
    }

    public static function response(array $config)
    {
        try {
            $db = self::getInstance($config);
            return $db->_connect();
        } catch (\TypeError $e) {
            return Dispaly::error(500, Message::Error_connect_to_DB );
        }
    }

    public function _connect( $options = '') : \DB\SQL
    {
        if (is_null($this->pdo)) {

            try {
                if ($options==='')
                    $options = $this->options;

                 $dsn = "{$this->serw}:host={$this->host};port={$this->port};dbname={$this->db_name}";

                $this->pdo = new \DB\SQL(
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

<?php /** @noinspection ALL */

namespace CloudCastle\Storage\Connections\Ftp;

use CloudCastle\Storage\Disks\Ftp;
use CloudCastle\Storage\Exceptions\FtpException;
use CloudCastle\Storage\Storage;
use FTP\Connection;

final class Connect
{
    private static array $init = [];
    private Connection|false $connect = false;
    private bool $login = false;

    /**
     * @param string $hostname
     * @param string|null $username
     * @param string|null $password
     * @param int $port
     * @param int $timeout
     * @return Connect
     * @throws FtpException
     */
    public static function getInstance(string $hostname, string|null $username=null, string|null $password=null, int $port = 21, int $timeout = 90): self
    {
        $initName = Storage::getMd5Name(Ftp::class, func_get_args());

        if(isset(self::$init[$initName]) && self::$init[$initName]){
            return self::$init[$initName];
        }

        self::$init[$initName] = new self();
        self::$init[$initName]->connect = self::$init[$initName]->connect($hostname, $port, $timeout);
        self::$init[$initName]->login = self::$init[$initName]->login($username, $password);

        return self::$init[$initName];
    }

    /**
     * @param string $hostname
     * @param int $port
     * @param int $timeout
     * @return Connection
     * @throws FtpException
     */
    private function connect(string $hostname, int $port = 21, int $timeout = 90): Connection
    {
        if($this->connect){
            return $this->connect;
        }

        $connect = ftp_connect($hostname, $port, $timeout);

        if($this->connect = $connect){
            return $this->connect;
        }

        throw new FtpException('Не удалось установить соединение с FTP сервером');
    }

    /**
     * @param string|null $username
     * @param string|null $password
     * @return bool
     * @throws FtpException
     */
    private function login(string|null $username, string|null $password): bool
    {
        $login = ftp_login($this->connect, $username, $password);

        if($login){
            return true;
        }

        throw new FtpException('Не удалось авторизоваться на сервере');
    }

    /**
     * @return Connection
     */
    public function getConnection(): Connection
    {
        return $this->connect;
    }

}
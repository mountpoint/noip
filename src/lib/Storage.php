<?php

/**
 * Class Storage
 *
 * @author Andrey Radzihovskiy
 */
class Storage
{
    /**
     * @var
     */
    protected $scheme;

    /**
     * @var
     */
    protected $username;

    /**
     * @var
     */
    protected $password;

    /**
     * @var
     */
    protected $email;

    /**
     * @var
     */
    protected $hostname;

    /**
     * @var
     */
    protected $ip;

    /**
     * @var
     */
    protected $url;

    /**
     * Storage initialization
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @param $scheme
     * @return $this
     */
    public function setScheme($scheme)
    {
        $this->scheme = $scheme;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return integer|string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return string
     */
    public function getHostname()
    {
        return $this->hostname;
    }

    /**
     * @param mixed $hostname
     * @return $this
     */
    public function setHostname($hostname)
    {
        $this->hostname = $hostname;

        return $this;
    }

    /**
     * @return string
     */
    public function getIP()
    {
        return $this->ip;
    }

    /**
     * @param mixed $ip
     * @return $this
     */
    public function setIP($ip)
    {
        $this->ip = $ip;

        return $this;
    }
}

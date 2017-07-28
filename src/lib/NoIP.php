<?php

/**
 * NoIP updater
 *
 * @author Andrey Radzihovskiy
 */
class NoIP
{
    const STATUS_GOOD = 'good';
    const STATUS_NOCHANGED = 'nochg';
    const STATUS_NOHOST = 'nohost';
    const STATUS_BADAUTH = 'badauth';
    const STATUS_BADAGENT = 'badagent';
    const STATUS_NOTDONATOR = '!donator';
    const STATUS_ABUSE = 'abuse';
    const STATUS_911 = '911';

    /**
     * @var Storage
     */
    protected $storage;

    /**
     * @var noip response
     */
    protected $response;

    /**
     * NoIP initialization
     *
     * @param Storage $storage
     */
    public function __construct(Storage $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @return string
     */
    public function getResponse()
    {
        return trim($this->response);
    }

    /**
     * @param $response
     *
     * @return $this
     */
    public function setResponse($response)
    {
        $this->response = $response;

        return $this;
    }

    /**
     * Update IP
     *
     * @return $this
     */
    public function broadcast()
    {
        $url = $this->createUrl();

        $curl = new \Mountpoint\Curl\Curl($url);
        $curl
            ->addOption(CURLOPT_MAXREDIRS, 4)
            ->addOption(CURLOPT_FOLLOWLOCATION, true)
            ->addOption(CURLOPT_USERPWD, $this->storage->getUsername() . ':' . $this->storage->getPassword())
            ->addOption(CURLOPT_RETURNTRANSFER, true)
            ->addOption(CURLOPT_USERAGENT, 'User-Agent: noip/0.1.0 ' . $this->storage->getEmail())
            ->exec()
        ;

        $this->setResponse($curl->getOutput());

        return $this;
    }

    /**
     * URL example https://dynupdate.no-ip.com/nic/update?hostname=mydomain.no-ip.com&myip=1.2.3.4
     *
     * @return string
     */
    public function createUrl()
    {
        return $this->storage->getScheme() . '://' . 'dynupdate.no-ip.com/nic/update?hostname=' . $this->storage->getHostname() . '&myip=' . $this->storage->getIP();
    }

    /**
     * Checks response status and prints it
     */
    public function printResponseStatus()
    {
        $responseParts = explode(' ', $this->getResponse());
        $responseStatus = !empty($responseParts[0]) ? $responseParts[0] : '';
        $responseIP = !empty($responseParts[1]) ? $responseParts[1] : '';
        $timestamp = date('d.m.Y H:i:s', time());

        switch ($responseStatus) {
            case self::STATUS_GOOD:
                $status = sprintf('Status: %s. IP %s has been updated at %s', self::STATUS_GOOD, $responseIP, $timestamp);
                break;
            case self::STATUS_NOCHANGED:
                $status = sprintf('Status: %s. IP %s the same. Timestamp - %s', self::STATUS_NOCHANGED, $responseIP, $timestamp);
                break;
            case self::STATUS_NOHOST:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_NOHOST, $timestamp);
                break;
            case self::STATUS_BADAUTH:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_BADAUTH, $timestamp);
                break;
            case self::STATUS_BADAGENT:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_BADAGENT, $timestamp);
                break;
            case self::STATUS_NOTDONATOR:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_NOTDONATOR, $timestamp);
                break;
            case self::STATUS_ABUSE:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_ABUSE, $timestamp);
                break;
            case self::STATUS_911:
                $status = sprintf('Status: %s. Timestamp - %s', self::STATUS_911, $timestamp);
                break;
            default:
                $status = sprintf('No status. Timestamp - %s', $timestamp);
        }

        echo $status . PHP_EOL;
    }
}

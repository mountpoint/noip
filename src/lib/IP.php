<?php

/**
 * @author Andrey Radzihovskiy
 */
class IP
{
    /**
     * @return string Current external IP
     */
    public static function getExternalIP($ipUrl)
    {
        if (empty($ipUrl)) {
            throw new Exception('IP url cannot be empty');
        }

        return trim(file_get_contents($ipUrl));
    }
}

<?php


namespace App\Libraries;


class Network
{
    static function ping($ip)
    {
        exec('ping ' . $ip . ' -c 1', $out);
        dd($out);
    }
}

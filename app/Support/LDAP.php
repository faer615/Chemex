<?php


namespace App\Support;


use Adldap\Laravel\Facades\Adldap;

class LDAP
{
    public function auth()
    {
        $auth = Adldap::search()->where('mail', '=', 'zhangsan@test.com')->get();
        dd($auth);
    }
}

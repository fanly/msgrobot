<?php
namespace Fanly\Msgrobot\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: yemeishu
 * Date: 2018/2/20
 * Time: 下午8:28
 */

class Msgrobot extends Facade {

    protected static function getFacadeAccessor() {
        return 'msgrobot';
    }
}
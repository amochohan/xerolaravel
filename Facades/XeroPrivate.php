<?php
namespace DrawMyAttention\XeroLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class XeroPublic extends Facade
{
    protected static function getFacadeAccessor() { return 'XeroPublic'; }
}

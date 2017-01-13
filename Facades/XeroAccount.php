<?php
namespace DrawMyAttention\XeroLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class XeroAccount extends Facade
{
    protected static function getFacadeAccessor() { return 'XeroAccount'; }
}

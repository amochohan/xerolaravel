<?php
namespace DrawMyAttention\XeroLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class XeroAttachment extends Facade
{
    protected static function getFacadeAccessor() { return 'XeroAttachment'; }
}

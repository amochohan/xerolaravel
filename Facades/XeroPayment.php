<?php
namespace DrawMyAttention\XeroLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class XeroPayment extends Facade
{
    protected static function getFacadeAccessor() { return 'XeroPayment'; }
}

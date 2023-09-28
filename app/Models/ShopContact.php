<?php

namespace App\Models;

use App\Observers\ShopContactObserver;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;

class ShopContact extends Model
{
    use HasEvents;
    public $timestamps = true;
    public $table      = 'shop_contact';

    public static function boot() {
	    parent::boot();
	
	    
	}
    public static function getContacts()
    {
        return self::where('status', 1)->orderBy('id', 'desc')->orderBy('sort', 'desc')->get();
    }
    
}

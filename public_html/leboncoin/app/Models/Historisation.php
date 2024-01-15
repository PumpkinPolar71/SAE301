<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Historisation extends Model
{
    use HasFactory;
    protected $table = 'historisation';
    protected $primaryKey = 'idhistorisation';
    public $timestamps = false; 


    protected static function boot()
    {
        parent::boot();
    
        static::creating(function ($historisation) {
            Log::info('Creating historisation record.');
            $historisation->updateLastLoginDate();
        });
    
        static::updating(function ($historisation) {
            Log::info('Updating historisation record.');
            $historisation->updateLastLoginDate();
        });
    }
}
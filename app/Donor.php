<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model {
    use SoftDeletes;

    protected $table = 'donations';
    protected $fillable = ['name', 'lastname', 'email', 'amount'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public static $rules = [
        // Validation rules
    ];

    // Relationships
}

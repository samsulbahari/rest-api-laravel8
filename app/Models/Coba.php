<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Coba extends Model
{
    use HasApiTokens, HasFactory;
    use HasFactory;
    public $timestamps = false;
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $connection = 'mysql';
    protected $fillable = ['nama','umur','alamat'];
}

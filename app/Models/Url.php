<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    protected $table = 'urls';

    protected $primaryKey = 'id';

    protected $fillable = ['hash', 'url', 'name', 'access_count', 'user_id'];

    protected $hidden = ['user_id','created_at','updated_at'];
}

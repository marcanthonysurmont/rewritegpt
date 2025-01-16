<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    protected $fillable = ['api_key', 'prompt', 'prompt_id'];
}

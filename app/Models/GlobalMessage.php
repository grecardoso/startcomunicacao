<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalMessage extends Model
{
    protected $fillable = ['title', 'content'];
}

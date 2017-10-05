<?php

namespace Hermes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

use Hermes\User;

class Message extends Model
{
    protected $fillable = [
        'title', 'to', 'from', 'content'
    ];

    public function to() {
        return User::findOrFail( $this->to );
    }

    public function from() {
        return User::findOrFail( $this->from );
    }
}

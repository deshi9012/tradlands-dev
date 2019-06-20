<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InternalError extends Model {
    protected $table = 'internal_errors';
    protected $guarded = ['id'];
}

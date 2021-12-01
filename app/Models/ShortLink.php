<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class ShortLink extends Model
{

    protected $fillable = [
        'code', 'link', 'customUrl', 'lifetime', 'secret', 'user_id'
    ];
}

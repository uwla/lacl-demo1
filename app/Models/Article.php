<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Uwla\Lacl\Traits\Permissionable as IsPermissionable;
use Uwla\Lacl\Contracts\Permissionable as IsPermissionableContract;

class Article extends Model implements IsPermissionableContract
{
    use HasFactory, IsPermissionable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [ 'author', 'body', 'title', ];
}

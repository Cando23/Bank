<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SysInfo extends Model
{
    use HasFactory;
    protected $table = 'sys_infos';
    protected $guarded = false;
}

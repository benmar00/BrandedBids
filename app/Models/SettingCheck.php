<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingCheck extends Model
{
    protected $table = 'setting_checks';

    protected $primaryKey = 'id';

    protected $guarded = [];
}

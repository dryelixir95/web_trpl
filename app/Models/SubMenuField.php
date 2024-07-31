<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenuField extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_field',
        'tag',
        'null',
        'type_field',
        'submenu_id',
    ];

    public function subMenu()
    {
        return $this->belongsTo(SubMenu::class);
    }
}

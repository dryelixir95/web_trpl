<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_menu',
        'kategori',
        'menu_id', 
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function fieldSubMenu()
    {
        return $this->hasMany(SubMenuField::class);
    }
}

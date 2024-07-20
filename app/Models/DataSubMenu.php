<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'submenu_id',
    ];

    public function subMenu()
    {
        return $this->belongsTo(SubMenu::class);
    }

    public function detailDataSubmenu()
    {
        return $this->hasMany(DetailDataSubMenu::class, 'dataSubmenu_id','id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailDataSubMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'value',
        'dataSubmenu_id',
    ];

    public function dataSubMenu()
    {
        return $this->hasMany(DataSubMenu::class);
    }
}

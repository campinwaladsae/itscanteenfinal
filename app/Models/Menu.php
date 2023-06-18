<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menu';

    protected $fillable = [
        'user_id',
        'kategori_id',
        'nama',
        'harga',
        'deskripsi',
        'gambar'
    ];


    /**
     * Get the user associated with the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    /**
     * Get the kategori associated with the Menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kategori()
    {
        return $this->hasOne(Kategori::class, 'id', 'kategori_id');
    }
}

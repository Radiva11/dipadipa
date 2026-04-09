<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $fillable = [
        'siswa_id',
        'kategori_id',
        'lokasi',
        'keterangan',
        'status'
    ];

    public function siswa()
    {
        return $this->belongsTo(User::class, 'siswa_id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // app/Models/Aspirasi.php

    public function feedbacks() 
    {
        return $this->hasMany(Feedback::class, 'aspirasi_id', 'id');
    }
}

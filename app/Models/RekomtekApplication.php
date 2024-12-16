<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RekomtekApplication extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'alamat',
        'instansi',
        'jabatan',
        'nik',
        'no_hp',
        'email',
        'jenis_pemohon',
        'jenis_izin',
        'sub_jenis_izin',
        'nama_pekerjaan',
        'lokasi_pekerjaan',
        'provinsi',
        'kabupaten',
        'latitude',
        'longitude',
        'tujuan',
        'cara_pengambilan',
        'volume_pengambilan',
        'jenis_konstruksi',
        'jadwal_pelaksanaan',
        'rencana_pelaksanaan_mulai',
        'rencana_pelaksanaan_selesai',
        'status',
        'catatan'
    ];

    protected $casts = [
        'rencana_pelaksanaan_mulai' => 'date',
        'rencana_pelaksanaan_selesai' => 'date',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'volume_pengambilan' => 'decimal:2'
    ];

    public function documents(): HasMany
    {
        return $this->hasMany(RekomtekDocument::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedId()
    {
        return sprintf('%03d/RT/SDA-BWS/%d', $this->id, date('Y'));
    }

    public function getTrackingId()
    {
        return sprintf('GNA%05d-%d', $this->id, date('Y'));
    }
}

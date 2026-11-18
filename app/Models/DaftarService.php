<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DaftarService extends Model
{
    protected $table = 'daftar_services';

    protected $primaryKey = 'id_servis';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id_servis',
        'no_plat',
        'id_pelanggan',
        'keluhan_kendaraan',
        'tanggal_servis',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(
            Pelanggan::class,
            'id_pelanggan',
            'id_pelanggan'
        );
    }

    public function kendaraan()
    {
        return $this->belongsTo(
            Kendaraan::class,
            'no_plat',
            'no_plat'
        );
    }

    public function dataService()
    {
        return $this->hasOne(
            DataService::class,
            'id_servis',
            'id_servis'
        );
    }

    public function pembayaran()
    {
        return $this->hasOne(
            Pembayaran::class,
            'id_servis',
            'id_servis'
        );
    }

    public function getRouteKeyName(): string
    {
        return 'id_servis';
    }
}

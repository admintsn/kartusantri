<?php

namespace App\Models;

use App\log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PesanDaftar extends Model
{
    public function walisantri()
    {
        return $this->belongsTo(Walisantri::class);
    }

    public function tahunberjalan()
    {
        return $this->hasOne(TahunBerjalan::class);
    }

    public function waktuDatang()
    {
        return $this->belongsTo(WaktuDatangKembali::class, 'w_datang');
    }

    public function waktuKembali()
    {
        return $this->belongsTo(WaktuDatangKembali::class, 'w_kembali');
    }

    public function menginapTidak()
    {
        return $this->belongsTo(MenginapTidak::class);
    }

    use log;
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'nim',
        'email',
        'bidang_id',
        'perguruan_id',
        'kota_perguruan_id',
        'jenjang',
        'program_studi',
        'whatsapp',
        'password',
        'tempat_lahir',
        'tanggal_lahir',
        'jenis_kelamin',
        'alamat',
        'kecamatan_id',
        'desa_id',
        'tahun_masuk',
        'foto_diri',
        'ktm',
        'linkedin',
        'portofolio',
        'ig',
        'role',
    ];

    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }

    public function desa()
    {
        return $this->belongsTo(Desa::class);
    }

    public function perguruan()
    {
        return $this->belongsTo(Perguruan::class);
    }

    public function bidang()
    {
        return $this->belongsTo(Bidang::class);
    }

    public function kotaPerguruan()
    {
        return $this->belongsTo(KotaPerguruan::class, 'kota_perguruan_id');
    }

    public function getFotoDiriUrlAttribute()
    {
        if ($this->foto_diri) {
            return asset('storage/' . $this->foto_diri);
        }
        // Kalau foto_diri kosong, bisa return placeholder
        return asset('assets/img/decaa.png');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}

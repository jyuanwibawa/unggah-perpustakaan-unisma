<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    protected $primaryKey = 'nim';

    protected $fillable = [
        'no',
        'nim',
        'nama',
        'jk',
        'tanggal_lahir',
        'prodi',
        'angkatan',
        'status',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected function casts(): array
    {
        return [
            'nim' => 'string',
            'tanggal_lahir' => 'date',
        ];
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    protected $table = 'post';
    protected $primaryKey = 'post_id'; 
    public $incrementing = true;
    protected $fillable = [
        'user_id',
        'judul',
        'isi_post',
        'gambar',
        'created_at'
    ];
     public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

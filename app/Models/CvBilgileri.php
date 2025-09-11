<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CvBilgileri extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'cv_bilgileri';

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'birth_date',
        'education',
        'experience',
        'skills',
        'about',
    ];
}

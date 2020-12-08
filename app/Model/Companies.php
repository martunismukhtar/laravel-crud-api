<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Companies extends Model implements HasMedia {
    
    use HasMediaTrait;
    
    protected $table = "companies";
    
    protected $fillable = [
        'name', 'email', 'website'
    ];
    
    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100)
            ->fit(Manipulations::FIT_CROP, 100, 100)->nonQueued();

    }
    
    function employ () {
        return $this->hasMany('App\Model\Employees', 'company_id');
    }
}

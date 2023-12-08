<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function owner(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function images(): Attribute{
        return Attribute::make(
            get: function (){
                return $this->getMedia()->map(function(Media $media){
                    return $media->getTemporaryUrl(Carbon::now()->addDays(7));
                })->toArray();
            },
        );
    }
}

<?php

namespace App\Traits;

use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasImage
{
    use InteractsWithMedia;

    /**
     * get image from polymporfic realationship
     *
     */
    public function image()
    {
        return optional($this->media->first())->getFullUrl('thumbnail') ?? '';
    }

    /**
     * Get Original Image.
     */
    public function originalImage()
    {
        return optional($this->media->first())->getFullUrl() ?? '';
    }

    public function uploadImageIfExists($imageNameFromRequest = 'image')
    {
        !request()->hasFile($imageNameFromRequest) ?? $this->addMediaFromRequest($imageNameFromRequest)
            ->toMediaCollection();
    }

    /**
     * create new image with different dimensions.
     *
     * @param Media|null $media
     * @return void
     */
    public function registerAllMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumbnail')
            ->width(250)
            ->height(250);
    }
}

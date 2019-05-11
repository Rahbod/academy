<?php

namespace Appnegar\Cms\Traits;

trait GetImageAttributesTrait
{
    public function getPhotoAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            $path = '/storage/' . config('system.' . $resource_name . '.photo_destination') . $photo;
            return $path;
        }
        return '/storage/' . config('system.' . $resource_name . '.photo_destination') . 'default.jpg';;

    }

    public function getLogoAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            $path = '/storage/' . config('system.' . $resource_name . '.logo_destination') . $photo;
            return $path;
        }
        return '/storage/' . config('system.' . $resource_name . '.logo_destination') . 'default.jpg';

    }

    public function getImageAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            if(strpos($photo,'http') === false){
                $path = '/storage/' . config('system.' . $resource_name . '.image_destination') . $photo;
                return $path;
//                return $photo;
            }
            else {
                return $photo;
            }

        }
        return '/storage/' . config('system.' . $resource_name . '.image_destination') . 'default.jpg';

    }

    public function getAvatarAttribute($photo)
    {
        $resource_name = str_singular($this->getTable());
        if ($photo) {
            if (strpos($photo,'http') === false) {
                $path = '/storage/' . config('system.' . $resource_name . '.avatar_destination') . $photo;
                return $path;
            }
            return $photo;
        }
        return '/storage/' . config('system.' . $resource_name . '.avatar_destination') . 'default.jpg';

    }
}
<?php

namespace Appnegar\Cms\Traits;

trait SetAndGetDateAttributesTrait
{
    public function getBirthdayAttribute($date)
    {
        if ($date) {
            if ($date) {
                $date = new \Verta($date);
                $dateTime = $date->format('Y/m/d');
                return $dateTime;
            }
            return null;
        }
        return null;

    }

    public function setBirthdayAttribute($value)
    {
        if (is_string($value)) {
            $date = explode('/', $value);
            $date = \Verta::createJalaliDate($date[0], $date[1], $date[2])->DateTime();
            $this->attributes['birthday'] = $date;
        } else {
            $this->attributes['birthday'] = null;
        }
    }

    public function getPublishedAtAttribute($date)
    {

        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;


    }

    public function setPublishedAtAttribute($value)
    {
        if (is_string($value)) {
            $date = explode('/', $value);
            $date = \Verta::createJalaliDate($date[0], $date[1], $date[2])->DateTime();
            $this->attributes['published_at'] = $date;
        } else {
            $this->attributes['published_at'] = null;
        }
    }

    public function getExpiredAtAttribute($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;


    }

    public function setExpiredAtAttribute($date)
    {
        if (is_string($date)) {
            $date = \Verta::createJalaliDate($date[0], $date[1], $date[2])->DateTime();
            $this->attributes['expired_at'] = $date;
        } else {
            $this->attributes['expired_at'] = null;
        }
    }

    public function getActivatedAtAttribute($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;


    }

    public function getAnsweredAtAttribute($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;


    }

    public function getUpdatedAtAttribute($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('H:i - Y/m/d');
            return $dateTime;
        }
        return null;
    }

    public function getCreatedAtAttribute($date)
    {
        if ($date) {
            $date = new \Verta($date);
            $dateTime = $date->format('Y/m/d');
            return $dateTime;
        }
        return null;

    }
}
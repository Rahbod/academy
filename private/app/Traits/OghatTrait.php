<?php namespace App\Traits;

use Appnegar\Cms\Services\OwghatService;

trait OghatTrait
{
    public function oghat($city, $mode = 'day', $month = null)
    {
//        dd($city->country);
        $month = $month ?? app(\Verta::class)->month;
        $day = app(\Verta::class)->day;
//        $city = City::where('name', 'کابل')->with('state.country')->first();
        $longitude = $city->longitude;
        $latitude = $city->latitude;
        $daylight_saving_time = $city->country->daylight_saving_time;
        $time_zone = app(OwghatService::class)->getTimezoneDiffFromGMT($city->country->time_zone);
        $show_seconds = 0;
        $farsi_numbers = false;

        if ($mode == 'month') {
            return app(OwghatService::class)->getMonthOwght($month, $longitude, $latitude, $time_zone, $daylight_saving_time, $show_seconds, $farsi_numbers);
        }
        return app(OwghatService::class)->getDayOwghat($month, $day, $longitude, $latitude, $time_zone, $daylight_saving_time, $show_seconds, $farsi_numbers);
    }
}
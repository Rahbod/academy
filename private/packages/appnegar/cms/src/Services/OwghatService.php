<?php

namespace Appnegar\Cms\Services;

use App\Book;
use ZipArchive;

class OwghatService{

    public function getDayOwghat($month,$day,$longitude,$latitude,$time_zone,$daylight_saving_time=1,$show_seconds=false,$farsi_numbers=false)
    {
        $a_2 = array(107.695, 90.833, 0, 90.833, 94.5, 0);
        $doy_1 = (($month < 7) ? ($month - 1) : 6) + (($month - 1) * 30) + $day;
        for ($h = 0, $i = 0; $i < 6; $i++) {
            if ($i < 5) {
                $doy = $doy_1 + ($h / 24);
                $s_m = 74.2023 + (0.98560026 * $doy);
                $s_lst = 8.3162159 + (0.065709824 * floor($doy)) + (24.06570984 * fmod($doy, 1)) + ($longitude / 15);
                $s_omega = (4.85131 - (0.052954 * $doy)) * 0.0174532;
                $s_ep = (23.4384717 + (0.00256 * cos($s_omega))) * 0.0174532;
                $s_u = $s_m;
                for ($s_i = 1; $s_i < 5; $s_i++) {
                    $s_u = $s_u - (($s_u - $s_m - (0.95721 * sin(0.0174532 * $s_u))) / (1 - (0.0167065 * cos(0.0174532 * $s_u))));
                }
                $s_v = 2 * (atan(tan(0.00872664 * $s_u) * 1.0168) * 57.2957);
                $s_theta = ($s_v - $s_m - 2.75612 - (0.00479 * sin($s_omega)) + (0.98564735 * $doy)) * 0.0174532;
                $s_delta = asin(sin($s_ep) * sin($s_theta)) * 57.2957;
                $s_alpha = 57.2957 * atan2(cos($s_ep) * sin($s_theta), cos($s_theta));
                if ($s_alpha >= 360) $s_alpha -= 360;
                $s_ha = $s_lst - ($s_alpha / 15);
                $s_zohr = fmod($h - $s_ha, 24);
                $loc2hor = ((acos(((cos(0.0174532 * $a_2[$i]) - sin(0.0174532 * $s_delta) * sin(0.0174532 * $latitude)) / cos(0.0174532 * $s_delta) / cos(0.0174532 * $latitude))) * 57.2957) / 15);
                $azan[$i] = fmod((($i < 2) ? ($s_zohr - $loc2hor) : (($i > 2) ? $s_zohr + $loc2hor : $s_zohr)), 24);
            } else {
                $azan[$i] = ($azan[0] + $azan[3] + 24) / 2;
            }

            $x=$this->setTimeZone($azan[$i],$time_zone);

            if ($daylight_saving_time == 1 and $doy_1 > 1 and $doy_1 < 186) {
                $x++;
            } else {
                $daylight_saving_time = 0;
            }
            if ($x < 0) {
                $x += 24;
            } elseif ($x >= 24) {
                $x -= 24;
            }
            $hor = (int)($x);
            $ml = fmod($x, 1) * 60;
            $min = (int)($ml);
            $mr = round($ml);

            if ($mr == 60) {
                $mr = 0;
                $hor++;
            }
            $sec = (int)(fmod($ml, 1) * 60);
            $a_1[$i] = (($hor < 10) ? '0' : '') . $hor . ':' . (($show_seconds == false) ? ((($mr < 10) ? '0' : '') . $mr) : ((($min < 10) ? '0' : '') . $min . ':' . (($sec < 10) ? '0' : '') . $sec));
            if ($h == 0) {
                $h = $azan[$i];
                $i--;
            } else {
                $h = 0;
            }
        }
        $out = array(
            's' => $a_1[0],
            't' => $a_1[1],
            'z' => $a_1[2],
            'g' => $a_1[3],
            'm' => $a_1[4],
            'n' => $a_1[5],
            'month' => $month,
            'day' => $day,
            'longitude' => $longitude,
            'latitude' => $latitude,
            'show_seconds' => $show_seconds,
            'daylight_saving_time' => $daylight_saving_time,
            'farsi_numbers' => $farsi_numbers
        );
        if ($farsi_numbers == true) $out = str_replace(array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'), array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', '٫'), $out);
        return $out;
    }

    protected function setTimeZone($x,$time_zone){
        $default=floatval(3+(30/60));

        list($h,$m)=explode(':',$time_zone);
        $difference=floatval(intval($h)+(intval($m)/60));

        $x+=$difference-$default;
        return $x;
    }

    public function getMonthOwght($month,$longitude,$latitude,$time_zone,$daylight_saving_time=true,$show_seconds=false,$farsi_numbers=false)
    {
        $month = intval($month);
        $start = 1;
        if ($month < 7) {
            $end = $start + 31;
        } else {
            if ($this->isKabiseh() && $month == 12) {
                $end = $start + 29;
            } else {
                $end = $start + 30;
            }
        }

        $owghat=[];
        for ( $i = $start; $i < $end; $i++) {
            $owghat[]=$this->getDayOwghat($month,$i,$longitude,$latitude,$time_zone,$daylight_saving_time,$show_seconds,$farsi_numbers);
        }
        return $owghat;
    }

    protected function isKabiseh($year=null){
        if($year == null){
            $year= app(\verta::class)->year;
        }
        $kab=(((($year%33)%4)-1)==((int)(($year%33)*0.05)))?true:false;
        return $kab;
    }

    public function getTimeZones()
    {
        $default_time_zone= date_default_timezone_get ( );
        $zones_array = array();
        $timestamp = time();
        foreach(timezone_identifiers_list() as  $zone) {
            date_default_timezone_set($zone);
            $zones_array[$zone] = date('P', $timestamp);
        }
        date_default_timezone_set($default_time_zone);
        return $zones_array;
    }

    public function getTimezoneDiffFromGMT($key){
        $zones_array=$this->getTimeZones();
        return $zones_array[$key];
    }
}
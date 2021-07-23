<?php


namespace App\Repositories;


class OrderRepository
{
    /*
     * @param string $dates_string
     * return array
    */
    public function parseDates($dates_string)
    {
        $dates_arr = explode(" - ", $dates_string);
        if (count($dates_arr) < 2) return false;

        $date_from_arr = explode(".", $dates_arr[0]);
        $date_till_arr = explode(".", $dates_arr[1]);

        $date_from = $date_from_arr[2] . "-" . $date_from_arr[1] . "-". $date_from_arr[0];
        $date_till = $date_till_arr[2] . "-" . $date_till_arr[1] . "-". $date_till_arr[0];

        $result = ["date_from" => $date_from, "date_till" => $date_till];
        return $result;
    }

}

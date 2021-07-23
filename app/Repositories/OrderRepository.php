<?php


namespace App\Repositories;


class OrderRepository
{
    /*
     * Calculate cost for
     * @param int $hotel_id
     * @param string $date_from
     * @param string $date_till
     * @param int $qty
     * return float
     */
    public function calculateCost($hotel_id, $date_from, $date_till, $qty)
    {
        $cost = 0;

        //получить базовую цену
        $base_price = $this->getBasePrice($hotel_id);

        //получим даты проживания
        $array_dates = [];
        $date_u = strtotime("$date_from 00:00:00");
        while($date_u <  strtotime("$date_till 23:59:59"))
        {
            $date_day = date("Y-m-d",$date_u);
            $season_price =  $this->getSeasonPricesForDay($hotel_id, $date_day);
            $array_dates[] = ["date"=> $date_day, "season_price" => $season_price];
            $date_u += 3600*24;
        }

        $count_days = count($array_dates);

        $discount = $this->getDiscount($hotel_id, $count_days);

        foreach ($array_dates as $key=> $val)
        {
            $cost_date = $base_price;

            $season_price = $val["season_price"];
            if ($season_price) {
                if ($season_price->value > 0) {
                $cost_date = $season_price->value;
                }

                if ($season_price->add_value_per_human > 0) {
                    $cost_date += ($qty-1) * $season_price->add_value_per_human;
                }
            }
            $cost +=  $cost_date;
        }

        //расчет скидки
        if ($discount)
        {
            //процентная
            if ($discount->percent > 0) {
                $cost -= $cost * $discount->percent/100;
            }
            // в абсолютном значении
            elseif ($discount->value > 0 ) {
                $cost -= $discount->value;
            }
        }



        return $cost;
    }

    /*
     * Get discount
     * @param int $hotel_id
     * @param int $min days
     */
    public function getDiscount($hotel_id, $min_days)
    {
        $discount = \DB::table('discount')
            ->select(['percent', 'value'])
            ->where('hotel_id', $hotel_id)
            ->where('min_days', '<=', $min_days)
            ->orderBy('min_days','desc')
            ->first();
        return $discount;
    }

    /*
     * Get season price
     * @param int $hotel_id
     * @param string $date_day
     * return array
    */
    public function getSeasonPricesForDay($hotel_id, $date_day)
    {
        $prices_season = \DB::table('price_season')
            ->select(['value', 'add_value_per_human'])
            ->where('hotel_id', $hotel_id)
            ->where('date_from', '<=', $date_day)
            ->where('date_till', '>=', $date_day)
            ->first();

        return $prices_season;
    }

    /*
     * Get base price
     * @param int $hotel_id
     * return flat
    */
    public function getBasePrice($hotel_id)
    {
        $base_price = \DB::table('price_base')
            ->where('hotel_id', $hotel_id)
            ->value('value');
        return $base_price;
    }
    /*
     * Parse dates from string format: 20.08.2021 - 05.09.2021
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

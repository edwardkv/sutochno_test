<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\OrderRepository;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->orderRepository = app(OrderRepository::class);
    }

    public function index()
    {
        $hotel_id = 1;
        $data["hotel_id"] = $hotel_id;
        $data["qty"] = 1;
        $data["select_dates"] = "";
        return view('order.index', $data);
    }


    public function calculate(Request $request)
    {
        $select_dates = $request->input('select_dates');
        $qty = $request->input('qty');
        $hotel_id = $request->input('hotel_id');

        $dates_array = $this->orderRepository->parseDates($select_dates);

        $errors = "";
        if (!$dates_array)
        {
            $errors.=" Выберите даты заезда и отъезда ";
        }
        else
        {
            $data["date_from"] = $dates_array["date_from"];
            $data["date_till"] = $dates_array["date_till"];
        }

        $data["select_dates"] = $select_dates;
        $data["qty"] = $qty;
        $data["hotel_id"] = $hotel_id;
        $data["errors"] = $errors;

        return view('order.index', $data);
    }

}

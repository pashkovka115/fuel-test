<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::paginate();

        return view('admin.pages.order.index', ['orders' => $orders]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function edit($id)
    {
        $order = Order::where('id', $id)->firstOrFail();

        return view('admin.pages.order.edit', ['order' => $order]);
    }

    /*
    "fuel" => "Бензин"
    "code" => "92"
    "volume" => "10.00"
    "price" => "394.50"
    */

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_column' => 'numeric',
            'name_column' => 'not_regex:/[<>]+/',
            "fuel" => "not_regex:/[<>]+/",
            "code" => "regex:/[a-zA-Zа-яА-Я0-9\s]+/iu",
            "volume" => "numeric",
            "price" => "numeric",
        ]);

        Order::where('id', $id)->update([
            'id_column' => $request->input('id_column'),
            'name_column' => $request->input('name_column'),
            "fuel" => $request->input('fuel'),
            "code" => $request->input('code'),
            "volume" => $request->input('volume'),
            "price" => $request->input('price'),
        ]);

        return back();
    }


    public function destroy($id)
    {
        Order::where('id', $id)->delete();

        return back();
    }
}

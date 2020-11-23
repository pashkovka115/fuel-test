<?php

namespace App\Http\Controllers\Cashbox;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Fuel;
use App\Models\Order;
use Illuminate\Http\Request;

class CashboxController extends Controller
{
    public function index($id = null)
    {
        $types = Fuel::distinct()->get('fuel');
        $codes = Fuel::distinct()->get('code');
        $columns = Column::with('fuels')->get();

        $data = [
            'types' => $types,
            'codes' => $codes,
            'columns' => $columns,
        ];

        if ($id){
            $order = Order::where('id', $id)->first();
            if ($order){
                $data['order'] = $order;
            }
        }

        return view('pages.cashbox.index', $data);
    }


    private function create($order)
    {

        return view('pages.cashbox.create_order', ['order' => $order]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'id_column' => 'required|numeric',
            'name_column' => 'required|not_regex:/[<>]+/',
            'fuel' => 'required|not_regex:/[<>]+/',
            'code' => 'required|regex:/[a-zA-Zа-яА-Я0-9\s]+/iu',
            'volume' => 'nullable|numeric',
            'sum' => 'nullable|numeric',
        ]);

        $order = new Order($request->toArray());
        $order->save();

        return redirect()->route('cashbox.index', ['id' => $order->id]);
    }


    public function show(Request $request)
    {
        $request->validate([
            'column' => 'required|numeric',
            'fuel' => 'required|not_regex:/[<>]+/',
            'code' => 'required|regex:/[a-zA-Zа-яА-Я0-9\s]+/iu',
            'volume' => 'nullable|numeric',
            'sum' => 'nullable|numeric',
        ]);
        if (is_null($request->input('sum')) and is_null($request->input('volume'))){
            return back()->withErrors('Необходимо указать литры или рубли');
        }

        $input_column = $request->input('column');
        $input_fuel = $request->input('fuel');
        $input_code = $request->input('code');
        $input_volume = $request->input('volume');
        $input_sum = $request->input('sum');

        $column = Column::with('fuels')->where('id', $input_column)
            ->whereHas('fuels', function ($query) use ($input_fuel, $input_code){
            return $query->where('fuel', $input_fuel)->where('code', $input_code);
        })->first();


        if (is_null($column)){
            return redirect()->back()->withErrors('Неправильно указано "Колонка/Тип/Марка"');
        }

        // литры есть, рублей нет
        if (is_null($request->input('sum'))){
            foreach ($column->fuels as $fuel){
                if ($fuel->fuel == $input_fuel and $fuel->code == $input_code){
                    $input_sum = round($input_volume * $fuel->price, 2);
                    break;
                }
            }
            // рубли есть, литров нет
        }elseif (is_null($request->input('volume'))){
            foreach ($column->fuels as $fuel){
                if ($fuel->fuel == $input_fuel and $fuel->code == $input_code){
                    $input_volume = round($input_sum / $fuel->price, 2);
                    break;
                }
            }
        }

        return $this->create([
            'id_column' => $input_column,
            'name_column' => $column->column,
            'fuel' => $input_fuel,
            'code' => $input_code,
            'volume' => $input_volume,
            'sum' => $input_sum
        ]);
    }
}

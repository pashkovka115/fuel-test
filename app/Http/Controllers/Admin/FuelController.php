<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Fuel;
use Illuminate\Http\Request;

class FuelController extends Controller
{
    public function index()
    {
        $fuels = Fuel::paginate();
        return view('admin.pages.fuel.index', ['fuels' => $fuels]);
    }


    public function create()
    {
        return view('admin.pages.fuel.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'fuel' => 'not_regex:/[<>]+/',
            'code' => 'regex:/[a-zA-Zа-яА-Я0-9\s]+/iu',
            'volume' => 'regex:/[0-9]+/',
            'price' => 'regex:/[0-9\.]+/',
        ]);

        try {
            $fuel = new Fuel();
            $fuel->fuel = $request->input('fuel');
            $fuel->code = $request->input('code');
            $fuel->volume = $request->input('volume');
            $fuel->price = $request->input('price');
            $fuel->save();

            return redirect()->route('admin.fuel.edit', ['fuel' => $fuel->id]);

        }catch (\Exception $e){
            return redirect()->back()->withErrors('Произошла ошибка, возможно это топливо уже существует.');
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $id = $id * 1;
        $fuel = Fuel::where('id', $id)->firstOrFail();

        return view('admin.pages.fuel.edit', ['fuel' => $fuel]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'fuel' => 'not_regex:/[<>]+/',
            'code' => 'regex:/[a-zA-Zа-яА-Я0-9\s]+/iu',
            'volume' => 'regex:/[0-9]+/',
            'price' => 'regex:/[0-9\.]+/',
        ]);

        Fuel::where('id', $id)->update([
            'fuel' => $request->input('fuel'),
            'code' => $request->input('code'),
            'volume' => $request->input('volume'),
            'price' => $request->input('price'),
        ]);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $fuel = Fuel::with('columns')->where('id', $id)->firstOrFail();
        $columns = Column::all(['id'])->toArray();
        $fuel->columns()->detach($columns);
        $fuel->delete();

        return back();
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Column;
use App\Models\Fuel;
use Illuminate\Http\Request;

class ColumnController extends Controller
{
    public function index()
    {
        $columns = Column::with('fuels')->paginate();

        return view('admin.pages.column.index', ['columns' => $columns]);
    }


    public function create()
    {
        $fuels = Fuel::all();

        return view('admin.pages.column.create', ['fuels' => $fuels]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'column' => 'required|not_regex:/[<>]/'
        ]);

        $ids_fuels = [];
        foreach ($request->all() as $field => $value){
            if (strpos($field, 'fuel_') === 0){
                $id_fuel = explode('_', $field)[1];
                $ids_fuels[] = (integer)$id_fuel;
            }
        }

        try {
            $column = new Column();
            $column->column = $request->input('column');
            $column->save();

            $column->fuels()->attach($ids_fuels);

            return redirect()->route('admin.column.edit', ['column' => $column->id]);

        }catch (\Exception $e){
            return redirect()->back()->withErrors('Опсс! Непредвиденная ошибка');
        }
    }


    public function edit($id)
    {
        $column = Column::with('fuels')->where('id', $id)->firstOrFail();
        $fuels = Fuel::all();

        return view('admin.pages.column.edit', ['column' => $column, 'fuels' => $fuels]);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'column' => 'not_regex:/[<>]/'
        ]);

        $ids_fuels = [];
        foreach ($request->all() as $field => $value){
            if (strpos($field, 'fuel_') === 0){
                $id_fuel = explode('_', $field)[1];
                $ids_fuels[] = (integer)$id_fuel;
            }
        }

        $column = Column::with('fuels')->where('id', $id)->firstOrFail();

        $column->update([
            'column' => $request->input('column')
        ]);

        $fuels = Fuel::all(['id'])->toArray();

        $column->fuels()->detach($fuels);
        $column->fuels()->attach($ids_fuels);

        return redirect()->back();
    }


    public function destroy($id)
    {
        $fuels = Fuel::all(['id'])->toArray();
        $column = Column::with('fuels')->where('id', $id)->firstOrFail();
        $column->fuels()->detach($fuels);
        $column->delete();

        return back();
    }
}

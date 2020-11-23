@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-12">
                <h4>Колонки / Топливо</h4>
                <table>
                    @foreach($columns as $col)
                        <tr>
                            <td>{{ $col->column }}</td>
                            <td>
                                @foreach($col->fuels as $fuel)
                                    <span class="badge badge-success">{{ $fuel->code }}</span>
                                @endforeach
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h1>Формирование чека</h1>
                <form action="{{ route('cashbox.show') }}" method="get">
                    <div class="form-group">
                        <select name="column" class="form-control">
                            <option>Колонка</option>
                            @foreach($columns as $column)
                                <option value="{{ $column->id }}">{{ $column->column }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <select name="fuel" class="form-control">
                                    <option>Вид топлива</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->fuel }}">{{ $type->fuel }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <select name="code" class="form-control">
                                    <option>Разновидность (марка)</option>
                                    @foreach($codes as $code)
                                        <option value="{{ $code->code }}">{{ $code->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <input name="volume" type="text" class="form-control" placeholder="Количество литров">
                        </div>
                        <div class="col">
                            <input name="sum" type="text" class="form-control" placeholder="Сумма">
                        </div>
                    </div>

                    <div class="row my-3">
                        <div class="col">
                            <button type="submit" class="btn btn-primary">Рассчитать</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>

        @isset($order)
            @if(!is_null($order))
                <div class="row my-3">
                    <div class="col-md-12">
                        <h5>Колонка: {{ $order->name_column }}</h5>
                        <h5>Итого к оплате: {{ $order->price }}</h5>
                        <h5>Литров: {{ $order->volume }}</h5>
                    </div>
                </div>
            @endif
        @endisset

    </div>
@endsection

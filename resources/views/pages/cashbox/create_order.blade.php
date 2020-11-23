@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('cashbox.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>ID колонки</label>
                        <input type="text" class="form-control" value="{{ $order['id_column'] }}" disabled>
                        <input type="hidden" name="id_column" class="form-control" value="{{ $order['id_column'] }}">
                    </div>

                    <div class="form-group">
                        <label>Наименование колонки</label>
                        <input type="text" class="form-control" value="{{ $order['name_column'] }}" disabled>
                        <input type="hidden" name="name_column" class="form-control" value="{{ $order['name_column'] }}">
                    </div>

                    <div class="form-group">
                        <label>Топливо</label>
                        <input type="text" class="form-control" value="{{ $order['fuel'] }}" disabled>
                        <input type="hidden" name="fuel" class="form-control" value="{{ $order['fuel'] }}">
                    </div>

                    <div class="form-group">
                        <label>Марка</label>
                        <input type="text" class="form-control" value="{{ $order['code'] }}" disabled>
                        <input type="hidden" name="code" class="form-control" value="{{ $order['code'] }}">
                    </div>

                    <div class="form-group">
                        <label>Литры</label>
                        <input type="text" class="form-control" value="{{ $order['volume'] }}" disabled>
                        <input type="hidden" name="volume" class="form-control" value="{{ $order['volume'] }}">
                    </div>

                    <div class="form-group">
                        <label>Сумма</label>
                        <input type="text" class="form-control" value="{{ $order['sum'] }}" disabled>
                        <input type="hidden" name="price" class="form-control" value="{{ $order['sum'] }}">
                    </div>


                    <button type="submit" class="btn btn-primary">Всё верно</button>
                </form>
            </div>
            <div class="col-md-12 my-3">
                <a href="{{ route('cashbox.index') }}" class="btn btn-secondary">Отменить</a>
            </div>
        </div>
    </div>
@endsection



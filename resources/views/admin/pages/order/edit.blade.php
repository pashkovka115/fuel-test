@extends('admin.layouts.master')

@section('content')
    <?php $title_page = 'Чеки'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.order.update', ['order'=>$order->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name1">ID колонки</label>
                                <input type="text" class="form-control" id="name1" name="id_column"
                                       value="{{ $order->id_column }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name2">Наименование колонки</label>
                                <input type="text" class="form-control" id="name2" name="name_column"
                                       value="{{ $order->name_column }}" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Топливо</label>
                                <input type="text" class="form-control" id="name" name="fuel"
                                       value="{{ $order->fuel }}" required>
                            </div>

                            <div class="form-group">
                                <label for="email">Марка</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="code"
                                       value="{{ $order->code }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Объём</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="volume"
                                       value="{{ $order->volume }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Цена</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                       value="{{ $order->price }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('admin.layouts.master')

@section('content')<?php $title_page = 'Топливо'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.fuel.update', ['fuel'=>$fuel->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Топливо</label>
                                <input type="text" class="form-control" id="name" name="fuel"
                                       value="{{ $fuel->fuel }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Марка</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="code"
                                       value="{{ $fuel->code }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Объём</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="volume"
                                       value="{{ $fuel->volume }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Цена</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="price"
                                       value="{{ $fuel->price }}">
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

@extends('admin.layouts.master')

@section('content')
    <?php $title_page = 'Колонки'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.column.update', ['column'=>$column->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">№</label>
                                <input type="text" class="form-control" id="name" name="column"
                                       value="{{ $column->column }}" required>
                            </div>
                        </div>

                        <div class="card-footer">

                            <div class="form-group">
                                <div class="custom-control custom-checkbox" style="padding-left: 2.5rem;">
                                    @php
                                        $current_fuels = $column->fuels->keyBy('code')->toArray();
                                    @endphp
                                    @foreach($fuels as $fuel)
                                        @php
                                            if (isset($current_fuels[$fuel->code])){
                                                $checked = ' checked';
                                            }else{$checked = '';}
                                        @endphp
                                        <div style="display: inline-block; margin-right: 30px;">
                                            <input class="custom-control-input" type="checkbox"
                                                   id="Checkbox{{$loop->index}}" name="fuel_{{ $fuel->id }}"
                                                   value="{{ $fuel->fuel }}"{{ $checked }}>
                                            <label for="Checkbox{{$loop->index}}" title="{{ $fuel->fuel }}"
                                                   class="custom-control-label">{{ $fuel->code }}</label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>


                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary">Сохранить</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

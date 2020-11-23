@extends('admin.layouts.master')

@section('content')
    <?php $title_page = 'Топливо'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('admin.fuel.create') }}" class="btn btn-success">Добавить новое</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Тип</th>
                                <th>Марка</th>
                                <th>Объём</th>
                                <th>Цена за литр</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fuels as $fuel)
                                <tr>
                                    <td>{{ $fuel->id }}</td>
                                    <td>{{ $fuel->fuel }}</td>
                                    <td>{{ $fuel->code }}</td>
                                    <td>{{ $fuel->volume }}</td>
                                    <td>{{ round($fuel->price, 2) }}</td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('admin.fuel.edit', ['fuel' => $fuel->id]) }}"
                                           data-toggle="tooltip" data-placement="top" title="Редактировать"><i
                                                    class="fas fa-pencil-alt"></i>&nbsp;Edit</a>

                                        <a id="a_delete_{{ $fuel->id }}" class="btn btn-danger btn-sm"
                                           href="{{ route('admin.fuel.destroy', ['fuel' => $fuel->id]) }}"
                                           data-toggle="tooltip" data-placement="top" title="Удалить"
                                        onclick="del({{ $fuel->id }}); return false;">
                                            <i class="fas fa-trash"></i>&nbsp;Delete</a>

                                        <form id="form_delete_{{ $fuel->id }}"
                                              action="{{ route('admin.fuel.destroy', ['fuel'=>$fuel->id]) }}"
                                              method="post" style="display: none">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @verbatim
                                <script>
                                    function del(index) {
                                        $('#form_delete_' + index).submit();
                                    }

                                </script>
                            @endverbatim
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{ $fuels->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
@extends('admin.layouts.master')

@section('content')
    <?php $title_page = 'Колонки'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 mb-3">
                <a href="{{ route('admin.column.create') }}" class="btn btn-success">Добавить новую</a>
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
                                <th>№</th>
                                <th>Топливо</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($columns as $column)
                                <tr>
                                    <td>{{ $column->id }}</td>
                                    <td>{{ $column->column }}</td>
                                    <td>
                                        @foreach($column->fuels as $fuel)
                                            <span class="badge badge-success">{{ $fuel->code }}</span>
                                        @endforeach
                                    </td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('admin.column.edit', ['column' => $column->id]) }}"
                                           data-toggle="tooltip" data-placement="top" title="Редактировать"><i
                                                    class="fas fa-pencil-alt"></i>&nbsp;Edit</a>

                                        <a id="a_delete_{{ $loop->index }}" class="btn btn-danger btn-sm"
                                           href="{{ route('admin.column.destroy', ['column'=>$column->id]) }}"
                                           title="Удалить" onclick="del({{ $loop->index }}); return false;">
                                            <i class="fas fa-trash"></i>&nbsp;Delete</a>
                                        <form id="form_delete_{{ $loop->index }}"
                                              action="{{ route('admin.column.destroy', ['column'=>$column->id]) }}"
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
                    {{ $columns->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
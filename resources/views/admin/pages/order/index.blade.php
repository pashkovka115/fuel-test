@extends('admin.layouts.master')

@section('content')
    <?php $title_page = 'Чеки'; ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>ID колонки</th>
                                <th>Наименование</th>
                                <th>Топливо</th>
                                <th>Марка</th>
                                <th>Объём</th>
                                <th>Стоимость</th>
                                <th>Создано</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->id_column }}</td>
                                    <td>{{ $order->name_column }}</td>
                                    <td>{{ $order->fuel }}</td>
                                    <td>{{ $order->code }}</td>
                                    <td>{{ $order->volume }}</td>
                                    <td>{{ round($order->price, 2) }}</td>
                                    <td>{{ date('d.m.Y H:i:s', $order->created_at->timestamp) }}</td>

                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm"
                                           href="{{ route('admin.order.edit', ['order' => $order->id]) }}"
                                           data-toggle="tooltip" data-placement="top" title="Редактировать"><i
                                                    class="fas fa-pencil-alt"></i>&nbsp;Edit</a>

                                        <a id="a_delete_{{ $order->id }}" class="btn btn-danger btn-sm"
                                           href="{{ route('admin.order.destroy', ['order' => $order->id]) }}"
                                           data-toggle="tooltip" data-placement="top" title="Удалить"
                                        onclick="del({{ $order->id }}); return false;">
                                            <i class="fas fa-trash"></i>&nbsp;Delete</a>

                                        <form id="form_delete_{{ $order->id }}"
                                              action="{{ route('admin.order.destroy', ['order'=>$order->id]) }}"
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
                    {{ $orders->links() }}
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
@endsection
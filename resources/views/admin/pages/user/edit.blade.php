@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card card-primary">
                    <form role="form" action="{{ route('admin.user.update', ['user'=>$user->id]) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Имя</label>
                                <input type="text" class="form-control" id="name" name="name"
                                       value="{{ $user->name }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email адрес</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                       value="{{ $user->email }}" required>
                            </div>
                            <div class="form-group">
                                <label for="password1">Новый пароль</label>
                                <input type="password" class="form-control" id="password1" name="password"
                                       placeholder="Оставьте пустым если не надо менять">
                            </div>
                            <div class="form-group">
                                <label for="password2">Повторите пароль</label>
                                <input type="password" class="form-control" id="password2" name="password_confirmation"
                                       placeholder="Оставьте пустым если не надо менять">
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

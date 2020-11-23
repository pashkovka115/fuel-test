<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public $title = 'Пользователи';

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $users = User::paginate();
        return view('admin.pages.user.index', ['users' => $users, 'title' => $this->title, 'title_page' => 'Список пользователей']);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('admin.pages.user.create', ['title' => $this->title, 'title_page' => 'Новый пользователь']);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'gender' => 'string'
        ]);
        User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'gender' => $request->input('gender', "NULL")
        ]);

        return redirect()->back();
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();

        return view('admin.pages.user.show', ['title' => $this->title, 'title_page' => 'Просмотр пользователя', 'user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        if (!$user)
            return redirect()->route('admin.user.index');

        return view('admin.pages.user.edit', ['title' => $this->title, 'title_page' => 'Редактирование пользователя', 'user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ];
        $arr = $request->toArray();
        if (!empty($arr['password']) and $arr['password'] == $arr['password_confirmation']) {
            $data['password'] = Hash::make($arr['password']);
        }

        User::where('id', $id)->update($data);

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index');
    }
}

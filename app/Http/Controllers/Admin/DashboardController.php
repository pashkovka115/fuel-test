<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Routing\Controller;



class DashboardController extends Controller
{
    public $title = 'Панель администратора';


    public function index()
    {
        return view('admin.pages.dashboard.index', ['title' => $this->title, 'title_page' => 'Виджеты']);
    }
}

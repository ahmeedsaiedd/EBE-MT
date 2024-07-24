<?php

namespace App\Http\Controllers;

use App\Services\ProjectService;
use App\Services\UsersService;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct(
        private ProjectService $projectSerivce,
        private UsersService $usersService
        )
        {
        }
    public function view_userstory()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        return view('admin.userstory', compact('projects','users'));
    }
    public function View()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        return view('admin.userstory', compact('projects','users'));
    }

    public function view_board()
    {
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();

        return view('admin.board', compact('projects','users'));

    }

    public function view_calender()
    {
$users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();

        return view('admin.calender', compact('projects','users'));    }

    public function view_createproject()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        return view('admin.createproject', compact('projects'));
    }

   public function userstory(Request $request)
{
    dd("sdfsdfsd");
}
}

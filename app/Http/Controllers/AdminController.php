<?php

namespace App\Http\Controllers;

use App\Services\{ProjectService, UsersService, StatusService};
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function __construct(
        private ProjectService $projectSerivce,
        private UsersService $usersService,
        private StatusService $statusService
    ) {
    }
    public function view_userstory()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        return view('admin.userstory', compact('projects', 'users'));
    }
    public function View()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        return view('admin.userstory', compact('projects', 'users'));
    }

    public function view_board()
    {
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();
        $statuses = $this->statusService->getAllStatuses();

        return view('admin.board', compact('projects', 'users', 'statuses'));
    }

    public function view_calender()
    {
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();

        return view('admin.calender', compact('projects', 'users'));
    }

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

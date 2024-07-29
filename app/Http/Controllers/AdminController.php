<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
    public function Timeline()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        $statuses = $this->statusService->getAllStatuses();

        return view('admin.userstory', compact('projects', 'users', 'statuses'));

    }
    public function View()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->usersService->getAllUsers();
        $statuses = $this->statusService->getAllStatuses();

        return view('admin.userstory', compact('projects', 'users', 'statuses'));
    }

    public function Board()
    {
        $tasks= Task::all();
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();
        $statuses = $this->statusService->getAllStatuses();

        return view('admin.kanban', compact('projects', 'users', 'statuses','tasks'));
    }

    public function Calender()
    {
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();
        $statuses = $this->statusService->getAllStatuses();

        return view('admin.calender', compact('projects', 'users' , 'statuses'));
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

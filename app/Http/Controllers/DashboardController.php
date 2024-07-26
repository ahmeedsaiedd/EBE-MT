<?php

namespace App\Http\Controllers;

use App\Services\{UsersService, ProjectService, StatusService};

class DashboardController extends Controller
{
    public function __construct(
        private UsersService $userService,
        private ProjectService $projectSerivce,
        private StatusService $statusService,

    ) {
    }

    public function index()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->userService->getAllUsers();
        $statues = $this->statusService->getAllStatuses();
        $usersNo = $users->count();
        $projectsNo = $projects->count();

        return view('admin.home', compact('users', 'usersNo', 'projectsNo', 'projects', 'statues'));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Services\{UsersService,ProjectService};

class DashboardController extends Controller
{
    public function __construct(
    private UsersService $userService,
    private ProjectService $projectSerivce,
    )
    {
    }

    public function index() {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->userService->getAllUsers();
        $usersNo = $users->count();
        $projectsNo = $projects->count();

        return view('admin.home', compact('users','usersNo', 'projectsNo','projects'));
    }
}

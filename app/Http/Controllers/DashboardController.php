<?php

namespace App\Http\Controllers;

use App\Services\{IssueService, UsersService, ProjectService, StatusService};

class DashboardController extends Controller
{
    public function __construct(
        private UsersService $userService,
        private ProjectService $projectSerivce,
        private StatusService $statusService,
        private IssueService $issueService,

    ) {
    }

    public function index()
    {
        $projects = $this->projectSerivce->getAllProjetcs();
        $users = $this->userService->getAllUsers();
        $issue = $this->issueService->getAllIssuees();
        $statuses = $this->statusService->getAllStatuses();
        $usersNo = $users->count();
        $projectsNo = $projects->count();
        $issueNo = $issue->count();

        return view('admin.home', compact('users', 'usersNo', 'projectsNo', 'projects', 'statuses' , 'issueNo'));
    }
}

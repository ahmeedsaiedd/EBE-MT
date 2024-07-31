<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
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
    public function Issue()
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
        $cards = Card::all();
        return view('admin.userstory', compact('projects', 'users', 'statuses','cards'));
    }

    public function Board()
    {
        $tasks= Task::all();
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();
        $statuses = $this->statusService->getAllStatuses();
        $cards = Card::all();

        

        return view('admin.kanban', compact('projects', 'users', 'statuses','tasks','cards'));
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

    public function projects()
    {
        $projects = Project::all(); // Retrieve projects or any other data needed
        $users = $this->usersService->getAllUsers();
        $projects = $this->projectSerivce->getAllProjetcs();
        $statuses = $this->statusService->getAllStatuses();
        return view('admin.projects', compact('projects','users' , 'statuses')); // Return the view with the data

        // return view('admin.calender', compact('projects', 'users' , 'statuses'));
    }
}

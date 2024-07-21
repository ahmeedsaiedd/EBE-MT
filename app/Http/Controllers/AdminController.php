<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStory;

class AdminController extends Controller
{
    public function view_userstory()
    {
        return view('admin.userstory');
    }

    public function view_board()
    {
        return view('admin.board');
    }

    public function view_calender()
    {
        return view('admin.calender');
    }

    public function view_createproject()
    {
        return view('admin.createproject');
    }

    public function UserStory(Request $request)
    {
        $request->validate([
            'userStoryName' => 'required|array',
            'asField' => 'required|array',
            'iWantField' => 'required|array',
            'soThatField' => 'required|array',
        ]);

        $userStoryNames = $request->input('userStoryName');
        $asFields = $request->input('asField');
        $iWantFields = $request->input('iWantField');
        $soThatFields = $request->input('soThatField');

        foreach ($userStoryNames as $index => $userStoryName) {
            UserStory::create([
                'user_story_name' => $userStoryName,
                'as_field' => $asFields[$index],
                'i_want_field' => $iWantFields[$index],
                'so_that_field	' => $soThatFields[$index],
            ]);
        }

        return redirect()->back()->with('success', 'User stories added successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserStory;

class UserStoryController extends Controller
{
    // Other methods...

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'userStoryName.*' => 'required|string|max:255',
            'asField.*' => 'required|string',
            'iWantField.*' => 'required|string',
            'soThatField.*' => 'required|string',
        ]);

        try {
            // Loop through each set of inputs and save to database
            foreach ($validatedData['userStoryName'] as $key => $value) {
                UserStory::create([
                    'user_story_name' => $validatedData['userStoryName'][$key],
                    'as_field' => $validatedData['asField'][$key],
                    'i_want_field' => $validatedData['iWantField'][$key],
                    'so_that_field' => $validatedData['soThatField'][$key],
                    // Add any other fields here as needed
                ]);
            }

            // Redirect back or to a success page
            return redirect()->back()->with('success', 'User stories added successfully!');
        } catch (\Exception $e) {
            // Handle exceptions if any
            return redirect()->back()->with('error', 'Failed to add user stories: ' . $e->getMessage());
        }
    }
}

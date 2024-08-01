<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Services\IssueService;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function __construct(
        private IssueService $issueService,
    ) {
    }

    public function index()
    {
        $issues = $this->issueService->getAllIssuees();
        return view('issues.index', compact('issues'));
    }

    public function create()
    {
        return view('issues.create');
    }

    public function store(Request $request)
    {
        $this->issueService->storeNewIssue($request);
        // Validate the request
    $request->validate([
        'project_id' => 'required|exists:projects,id',
        'status_id' => 'required|exists:statuses,id',
        'summary' => 'required|string|max:255',
        'description' => 'nullable|string',
        'attachments' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'assignee_id' => 'nullable|exists:users,id',
    ]);

    

    // Redirect to the specified route after storing data
    return redirect()->route('admin.userstory')->with('success', 'Issue created successfully!');
    
}


    


    public function edit($id)
    {
        $issue = issue::findOrFail($id);
        return view('issues.edit', compact('issue'));
    }

    public function update(Request $request, $id)
    {
        $issue = issue::findOrFail($id);
        $issue->update($request->all());
        return redirect('issues')->with('success', 'issue updated successfully.');
    }

    public function destroy($id)
    {
        $issue = issue::findOrFail($id);
        $issue->delete();
        return redirect('issues')->with('success', 'issue deleted successfully.');
    }
}

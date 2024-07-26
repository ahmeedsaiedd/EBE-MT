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
        return redirect('/')->with('success', 'issue created successfully.');
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

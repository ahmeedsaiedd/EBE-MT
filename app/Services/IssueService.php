<?php

namespace App\Services;

use App\Models\Issue;

class IssueService
{
    public function getAllIssuees()
    {
        return Issue::all();
    }

    public function storeNewIssue($request)
    {
        $issue = Issue::create($request->only(
            'project_id',
            'status_id',
            'summary',
            'description'
        ));
        if ($request->hasFile('attachments')) {
            $file = $request->file('attachments');
            $path = $file->store('', 'attachments');
            $issue->attachments()->create([
                'file_path' => $path,
            ]);
        }
    }
}

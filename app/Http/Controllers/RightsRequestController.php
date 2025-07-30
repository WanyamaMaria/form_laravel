<?php

namespace App\Http\Controllers;

use App\Http\Requests\rightsrequestFormRequest;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class RightsRequestController extends Controller
{
    public function index()
    {
        $requests = RightsRequest::with('user')->get();
        return view('admin.requests', compact('requests'));
    }

    public function create()
    {
        return view('rights_request_form');
    }

    public function store(rightsrequestFormRequest $request)
    {
        $data = $request->validated();

        // Map checkbox values
        $data['initiate_payments'] = in_array('initiate', $request->rights ?? []) ? true : false;
        $data['review_payments'] = in_array('review', $request->rights ?? []) ? true : false;
        $data['approve_payments'] = in_array('approve', $request->rights ?? []) ? true : false;

        // Prevent form users from injecting signatures manually
        unset($data['rights'], $data['hod_signature'], $data['finance_head_signature']);

        Auth::user()->rightsRequests()->create($data);

        return redirect()->route('rights-requests.showAll')->with('success', 'Request added successfully.');
    }

    public function show($id)
    {
        $data = RightsRequest::findOrFail($id);
        return view('rights-requests.show', compact('data'));
    }

    public function edit($id)
    {
        $data = RightsRequest::findOrFail($id);
        return view('rights-requests.edit', compact('data'));
    }

    public function update(rightsrequestFormRequest $request, $id)
    {
        $data = RightsRequest::findOrFail($id);
        $validated = $request->validated();

        // Map checkbox values
        $validated['initiate_payments'] = in_array('initiate', $request->rights ?? []) ? true : false;
        $validated['review_payments'] = in_array('review', $request->rights ?? []) ? true : false;
        $validated['approve_payments'] = in_array('approve', $request->rights ?? []) ? true : false;

        // Prevent requester from altering signature fields
        unset($validated['rights'], $validated['hod_signature'], $validated['finance_head_signature']);

        $data->update($validated);

        return redirect()->route('rights-requests.showAll')->with('success', 'Request updated successfully.');
    }

    public function destroy($id)
    {
        $data = RightsRequest::findOrFail($id);
        $data->delete();

        return redirect()->route('rights-requests.showAll')->with('success', 'Request deleted successfully.');
    }

    public function restore($id)
    {
        $data = RightsRequest::withTrashed()->findOrFail($id);
        $data->restore();

        return redirect()->route('rights-requests.index')->with('success', 'Request restored successfully.');
    }

    public function trashed()
    {
        $trashed = RightsRequest::onlyTrashed()->get();
        return view('rights-requests.trashed', compact('trashed'));
    }

    public function showAll()
    {
        $requests = Auth::user()->rightsRequests()->get();
        return view('rights-requests.show', compact('requests'));
    }
}

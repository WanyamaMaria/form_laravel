<?php

namespace App\Http\Controllers;
use App\Models\RightsRequest;
use Illuminate\Http\Request;

/**
 * RightsRequestController handles the rights request form submission and management.
 */
class RightsRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    
        public function create()
        {
            //$posts = RightsRequest::all();
            return view('rights_request_form');
        }
    

    /**
     * Store a newly created resource in storage.
     */
   
   



    public function store(Request $request)
    {
$data = $request->validate([
    'date' => 'required|date',
    'staff_name' => 'required|string',
    'department' => 'required|string',
    'section' => 'required|string',
    'job_title' => 'required|string',
    'rights' => 'required|array|min:1',
    'urgency' => 'required|string',
    'section_manager_name' => 'required|string',
    'section_manager_job_title' => 'required|string',
    'section_manager_signature' => 'required|string',
    'section_manager_date' => 'required|date',
    'hod_name' => 'required|string',
    'hod_job_title' => 'required|string',
    'hod_signature' => 'required|string',
    'hod_date' => 'required|date',
    'finance_head_name' => 'required|string',
    'finance_head_job_title' => 'required|string',
    'finance_head_signature' => 'required|string',
    'finance_head_date' => 'required|date',
]);
$requestData = RightsRequest::create($data);

return redirect()->route('rights-requests.show', $requestData->id);
    }




    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    $data = RightsRequest::findOrFail($id);

    return view('rights-requests.show', compact('data'));


    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $data = RightsRequest::findOrFail($id);
    return view('rights-requests.edit', compact('data'));
}

    

    /**
     * Update the specified resource in storage.
     */
   
    public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'date' => 'required|date',
        'staff_name' => 'required|string|max:255',
        'department' => 'required|string|max:255',
        'section' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'rights' => 'nullable|array',
        'rights.*' => 'in:initiate,review,approve',
        'urgency' => 'required|in:low,medium,high',
        
        'section_manager_name' => 'nullable|string|max:255',
        'section_manager_job_title' => 'nullable|string|max:255',
        'section_manager_signature' => 'nullable|string|max:255',
        'section_manager_date' => 'nullable|date',

        'hod_name' => 'nullable|string|max:255',
        'hod_job_title' => 'nullable|string|max:255',
        'hod_signature' => 'nullable|string|max:255',
        'hod_date' => 'nullable|date',

        'finance_head_name' => 'nullable|string|max:255',
        'finance_head_job_title' => 'nullable|string|max:255',
        'finance_head_signature' => 'nullable|string|max:255',
        'finance_head_date' => 'nullable|date',
    ]);

    $data = RightsRequest::findOrFail($id);
    $data->update($validatedData);

    return redirect()->route('rights-requests.show', $data->id)->with('success', 'Request updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = RightsRequest::findOrFail($id);
        $data->delete(); // Soft delete

        return redirect()->route('rights-requests.create')->with('success', 'Request deleted successfully.');
    }

    // Restore a soft deleted request
    public function restore($id)
    {
        $data = RightsRequest::withTrashed()->findOrFail($id);
        $data->restore();

        return redirect()->route('rights-requests.index')->with('success', 'Request restored successfully.');
    }

    // Show only trashed (soft deleted) requests
    public function trashed()
    {
        $trashed = RightsRequest::onlyTrashed()->get();
        return view('rights-requests.trashed', compact('trashed'));
    }
}

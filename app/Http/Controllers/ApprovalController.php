<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RightsRequest;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function department()
    {
        $requests = RightsRequest::whereNull('hod_signature')->get();
        return view('approvals.department', compact('requests'));
    }

    public function finance()
    {
        $requests = RightsRequest::whereNotNull('hod_signature')
            ->whereNull('finance_head_signature')
            ->get();
        return view('approvals.finance', compact('requests'));
    }

    public function approve(Request $request, $id)
    {
        $data = RightsRequest::findOrFail($id);

        if (Auth::user()->isDepartmentHead()) {
            $data->hod_signature = 'approved';
            $data->hod_name = Auth::user()->name;
            $data->hod_date = now();
        }

        if (Auth::user()->isFinanceHead()) {
            $data->finance_head_signature = 'approved';
            $data->finance_head_name = Auth::user()->name;
            $data->finance_head_date = now();
        }

        $data->save();
        return redirect()->back()->with('success', 'Request approved successfully.');
    }
}


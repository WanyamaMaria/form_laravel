<h2>Submitted Rights Request</h2>

<ul>
    <li><strong>Staff Name:</strong> {{ $data->staff_name }}</li>
    <li><strong>Department:</strong> {{ $data->department }}</li>
    <li><strong>Section:</strong> {{ $data->section }}</li>
    <li><strong>Job Title:</strong> {{ $data->job_title }}</li>
    
    <li><strong>Initiate Payments:</strong> {{ $data->initiate_payments ? 'Yes' : 'No' }}</li>
    <li><strong>Review Payments:</strong> {{ $data->review_payments ? 'Yes' : 'No' }}</li>
    <li><strong>Approve Payments:</strong> {{ $data->approve_payments ? 'Yes' : 'No' }}</li>

    <li><strong>Urgency:</strong> {{ ucfirst($data->urgency) }}</li>

    <li><strong>Section Manager Name:</strong> {{ $data->section_manager_name ?? 'N/A' }}</li>
    <li><strong>Section Manager Job Title:</strong> {{ $data->section_manager_job_title ?? 'N/A' }}</li>

    <li><strong>HOD Name:</strong> {{ $data->hod_name ?? 'N/A' }}</li>
    <li><strong>HOD Job Title:</strong> {{ $data->hod_job_title ?? 'N/A' }}</li>

    <li><strong>Finance Head Name:</strong> {{ $data->finance_head_name ?? 'N/A' }}</li>
    <li><strong>Finance Head Job Title:</strong> {{ $data->finance_head_job_title ?? 'N/A' }}</li>
</ul>

<a href="{{ route('rights-requests.index') }}">View All Requests</a>

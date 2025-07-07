<!DOCTYPE html>
<html>
<head>
    <title>Submitted Rights Request</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            font-family: Arial, sans-serif;
            font-size: 15px;
        }
         th, td {
            border: 1px solid #bdbdbd;
            padding: 10px 16px;
            text-align: center;
        }
        th {
            background-color: #e0e0e0;
        }
        tr:nth-child(even) {
            background-color: #f8f8f8;
        } 
        h2 {
            text-align: center;
            font-family: Arial, sans-serif;
        }  
    </style>
</head>
<body>
     @if(session('success'))
        <div style="color: green; margin-bottom: 15px;">
            {{ session('success') }}
        </div>
    @endif
<h2>Submitted Rights Request</h2>

<table>
    <tr>
        <th>Staff Name</th>
        <th>Department</th>
        <th>Section</th>
        <th>Job Title</th>
        <th>Initiate Payments</th>
        <th>Review Payments</th>
        <th>Approve Payments</th>
        <th>Urgency</th>
        <th>Section Manager Name</th>
        <th>Section Manager Job Title</th>
        <th>HOD Name</th>
        <th>HOD Job Title</th>
        <th>Finance Head Name</th>
        <th>Finance Head Job Title</th>
        <th> Action</th>
    </tr>
    <tr>
        <td>{{ $data->staff_name }}</td>
        <td>{{ $data->department }}</td>
        <td>{{ $data->section }}</td>
        <td>{{ $data->job_title }}</td>
        <td>{{ in_array('initiate', $data->rights ?? []) ? 'Yes' : 'No' }}</td>
        <td>{{ in_array('review', $data->rights ?? []) ? 'Yes' : 'No' }}</td>
        <td>{{ in_array('approve', $data->rights ?? []) ? 'Yes' : 'No' }}</td>
        <td>{{ ucfirst($data->urgency) }}</td>
        <td>{{ $data->section_manager_name ?? 'N/A' }}</td>
        <td>{{ $data->section_manager_job_title ?? 'N/A' }}</td>
        <td>{{ $data->hod_name ?? 'N/A' }}</td>
        <td>{{ $data->hod_job_title ?? 'N/A' }}</td>
        <td>{{ $data->finance_head_name ?? 'N/A' }}</td>
        <td>{{ $data->finance_head_job_title ?? 'N/A' }}</td>
        <td>
            <div style="display: flex; flex-direction: column; align-items: center; gap: 8px;">
                <a href="{{ route('rights-requests.edit', $data->id) }}" 
                   style="padding: 8px 12px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 4px; display: block; width: 80px; text-align: center;">
                    Edit
                </a>
                <form action="{{ route('rights-requests.destroy', $data->id) }}" method="POST" style="display: block; width: 80px;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            onclick="return confirm('Are you sure you want to delete this request?')" 
                            style="padding: 8px 12px; background-color: #f44336; color: white; border: none; border-radius: 4px; width: 80px;">
                        Delete
                    </button>
                </form>
            </div>
        </td>
    </tr>


</table>





</body>
</html>

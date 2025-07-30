<!DOCTYPE html>
<html>
<head>
    <title>Requests Awaiting Department Head Approval</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1em;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 0.6em;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        form {
            margin-bottom: 0;
        }
        input[type="text"] {
            width: 120px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Requests Awaiting Department Head Approval</h2>

        @if(session('success'))
            <div style="color: green; margin-bottom: 1em;">{{ session('success') }}</div>
        @endif

        @if($requests->isEmpty())
            <p>No requests found.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Staff Name</th>
                        <th>Department</th>
                        <th>Section</th>
                        <th>Job Title</th>
                        <th>Urgency</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($requests as $request)
                    <tr>
                        <td>{{ $request->staff_name }}</td>
                        <td>{{ $request->department }}</td>
                        <td>{{ $request->section }}</td>
                        <td>{{ $request->job_title }}</td>
                        <td>{{ ucfirst($request->urgency) }}</td>
                        <td>{{ $request->status ?? 'Pending' }}</td>
                        <td>
                            <!-- Approve Form -->
                            <form method="POST" action="{{ route('approvals.department.approve', $request->id) }}" style="display:inline;">
                                @csrf
                                <input type="text" name="hod_signature" placeholder="Signature" required>
                                <button type="submit">Approve</button>
                            </form>

                            <!-- Deny Form -->
                            <form method="POST" action="{{ route('approvals.department.deny', $request->id) }}" style="display:inline; margin-left: 8px;">
                                @csrf
                                <button type="submit" style="background-color: red; color: white;">Deny</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</body>
</html>

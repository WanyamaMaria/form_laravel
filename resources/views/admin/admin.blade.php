<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - All Requests</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>All Rights Requests</h1>

    @foreach($requests as $request)
        <div style="border: 1px solid #ddd; padding: 10px; margin: 10px 0;">
            <p><strong>Requester:</strong> {{ $request->user->name }}</p>
            <p><strong>Email:</strong> {{ $request->user->email }}</p>
            <p><strong>Purpose:</strong> {{ $request->purpose }}</p>

            <p><strong>Department Approval:</strong> 
                {{ $request->hod_signature ? 'Approved by ' . $request->hod_name : 'Pending' }}
            </p>

            <p><strong>Finance Approval:</strong> 
                {{ $request->finance_head_signature ? 'Approved by ' . $request->finance_head_name : 'Pending' }}
            </p>
        </div>
    @endforeach
</body>
</html>

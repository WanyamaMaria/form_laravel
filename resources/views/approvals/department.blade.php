<!DOCTYPE html>
<html>
<head>
    <title>Department Head Approvals</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <h1>Pending Requests (Department Head)</h1>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif

    @foreach($requests as $request)
        <div style="border: 1px solid #ccc; padding: 10px; margin: 10px 0;">
            <p><strong>User:</strong> {{ $request->user->name }}</p>
            <p><strong>Purpose:</strong> {{ $request->purpose }}</p>
            <p><strong>Date:</strong> {{ $request->created_at->format('Y-m-d') }}</p>

            <form method="POST" action="{{ route('approvals.department.approve', $request->id) }}">
                @csrf
                <button type="submit">Approve</button>
            </form>
        </div>
    @endforeach
</body>
</html>

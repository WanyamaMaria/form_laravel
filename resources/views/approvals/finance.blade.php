<!DOCTYPE html>
<html>
<head>
    <title>Department Head Approvals</title>
    <link rel="stylesheet" href="{{ asset('css/approval.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
         <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="logout-btn">
        <i class="fas fa-sign-out-alt"></i> Logout
    </button>
        </form>
        

    <div class="container">
          @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif
        <h2>Requests Awaiting Finance Head Approval.</h2>

    

        @if($requests->isEmpty())
            <p>No requests found.</p>
        @else
      @php $current = request('status'); @endphp

<a href="{{ route('approvals.finance') }}" style="{{ $current === null ? 'font-weight:bold' : '' }}">All</a> |
<a href="{{ route('approvals.finance', ['status' => 'pending']) }}" style="{{ $current === 'pending' ? 'font-weight:bold' : '' }}">Pending</a> |
<a href="{{ route('approvals.finance', ['status' => 'approved']) }}" style="{{ $current === 'approved' ? 'font-weight:bold' : '' }}">Approved</a>


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
                                <form method="POST" action="{{ route('approvals.finance.approve', $request->id) }}" style="display:inline;">
                                    @csrf
                                    <input type="text" name="finance_head_signature" placeholder="Signature" required>
                                    <button type="submit">Approve</button>
                                </form>

                                <!-- Deny Form -->
                                <form method="POST" action="{{ route('approvals.finance.deny', $request->id) }}" style="display:inline; margin-left: 6px;">
                                    @csrf
                                    <button type="submit" class="deny-btn">Deny</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
        @endif
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var successMessage = document.querySelector('.success-message');
                if (successMessage) {
                    setTimeout(function() {
                        successMessage.style.display = 'none';
                    }, 2000); // Hide after 4 seconds
                }
            });
        </script>
       
</script>
    </div>
</body>
</html>

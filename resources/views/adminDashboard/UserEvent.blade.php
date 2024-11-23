<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{ asset('adminDashboard/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminDashboard/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>User Event Management</title>
    <style>
        html, body {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Montserrat', sans-serif;
        }
        nav{
            font-family: 'Montserrat', sans-serif;
        }
        .container-fluid {
            max-width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
        }
        .content-body {
            padding: 10px; /* Reduced padding for more compact content */
            margin: 0 !important;
        }
        .button-group {
            display: flex;
            align-items: center;
            gap: 5px; /* Reduced gap for more compact buttons */
        }
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
        }
        @media (max-width: 768px) {
            .table {
                white-space: nowrap;
            }
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
        .card-body {
            padding: 10px; /* Reduced padding inside the card */
        }
        .modal-header, .modal-body, .modal-footer {
            padding: 10px; /* Reduced padding inside modal */
        }
        .modal-content {
            padding: 10px; /* Reduced padding for modal content */
        }
        .form-group {
            margin-bottom: 10px; /* Reduced margin between form groups */
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav__header1">
                <div class="nav__logo1">
                    <a href="{{ url('/') }}">Al'Jisr</a>
                </div>
            </div>
            <ul class="nav__links1" id="nav-links1">
                <li><a href="/events-admin">EVENTS</a></li>
                <li><a href="/admin/customers">CUSTOMERS</a></li>
                <li><a href="/user-event">USER EVENT</a></li>
                <li><a href="/admin/comments">COMMENTS</a></li>
                <li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">LOGOUT</a>
                </li>
            </ul>
        </nav>
    </header>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="content-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserEventModal">Add User to Event</button>
                            <a href="{{ route('user-event.downloadCsv') }}" class="btn btn-primary">Download CSV</a>
                            <div class="table-responsive">
                                <table class="table table-responsive-lg mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Event Name</th>
                                            <th>Subscription Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($userEvents as $userEvent)
                                            <tr>
                                                <td>{{ $userEvent->user_name }}</td>
                                                <td>{{ $userEvent->user_email }}</td>
                                                <td>{{ $userEvent->user_phone }}</td>
                                                <td>{{ $userEvent->event_name }}</td>
                                                <td>{{ $userEvent->created_at }}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <form action="{{ route('user-event.destroy', [$userEvent->user_id, $userEvent->event_id]) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger event-button">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @foreach ($guestEvents as $guestEvent)
                                            <tr>
                                                <td>{{ $guestEvent->username }}</td>
                                                <td>{{ $guestEvent->email }}</td>
                                                <td>{{ $guestEvent->phone }}</td>
                                                <td>{{ $guestEvent->event->title }}</td>
                                                <td>{{ $guestEvent->created_at }}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <form action="{{ route('user-event.destroyGuest', [$guestEvent->id]) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger event-button">Delete</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add User to Event Modal -->
    <div class="modal fade" id="addUserEventModal" tabindex="-1" role="dialog" aria-labelledby="addUserEventModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserEventModalLabel">Add User to Event</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('user-event.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_id">Select User</label>
                            <select class="form-control" id="user_id" name="user_id" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="event_id">Select Event</label>
                            <select class="form-control" id="event_id" name="event_id" required>
                                @foreach ($events as $event)
                                    <option value="{{ $event->id }}">{{ $event->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user from the event?');
        }
    </script>

    <script src="{{ asset('adminDashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/deznav-init.js') }}"></script>
</body>
</html>

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
    <title>Event Management</title>
    <style>
    html, body {
        width: 100%;
        margin: 0;
        padding: 0;
        overflow-x: hidden;
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
        padding: 20px;
        margin: 0 !important;
    }

    header {
        font-family: 'Montserrat', sans-serif;
    }

    .event-button {
        width: 100px;
        height: 60px;
        padding: 8px 12px;
        font-size: 14px;
        line-height: normal;
        text-align: center;
        display: inline-block;
        vertical-align: middle;
    }

    .button-group {
        display: flex;
        align-items: center;
        gap: 10px;
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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addEventModal">Add Event</button>
                            <div class="table-responsive">
                                <table class="table table-responsive-lg mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>Event Name</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Event Address</th>
                                            <th>Description</th>
                                            <th>Status</th>
                                            <th>Subscribers</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($events as $event)
                                        <tr>
                                            <td>{{ $event->title }}</td>
                                            <td><img src="{{ asset($event->image_path) }}" alt="{{ $event->title }}" width="50"></td>
                                            <td>{{ $event->event_date }}</td>
                                            <td>{{ $event->location }}</td>
                                            <td>{{ Str::limit($event->description, 20) }}</td>
                                            <td>{{ $event->closed ? 'Closed' : 'Open' }}</td>
                                            <td>{{ $event->getSubscribersCountAttribute() }} / {{ $event->max_subscribers }}</td>
                                            <td>
                                                <div class="button-group">
                                                    <a href="{{ route('event-admin.detail', $event->id) }}" class="btn btn-primary event-button">View Details</a>
                                                    <form action="{{ route('event-admin.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
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

        <div class="modal fade" id="addEventModal" tabindex="-1" role="dialog" aria-labelledby="addEventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addEventModalLabel">New Event</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('event-admin.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="title">Event Name</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="Type_de_billet">Type of Ticket</label>
                                <input type="text" class="form-control" id="Type_de_billet" name="Type_de_billet" required>
                            </div>
                            <div class="form-group">
                                <label for="event_date">Date</label>
                                <input type="datetime-local" class="form-control" id="event_date" name="event_date" required>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" class="form-control" id="location" name="location" required>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="max_subscribers">Max Subscribers</label>
                                <input type="number" class="form-control" id="max_subscribers" name="max_subscribers" required>
                            </div>
                            <div class="form-group">
                                <label for="duration">Duration (minutes)</label>
                                <input type="number" class="form-control" id="duration" name="duration" required>
                            </div>
                            <div class="form-group">
                                <label for="map_url">Map URL</label>
                                <input type="text" class="form-control" id="map_url" name="map_url" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Event Image</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('adminDashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/deznav-init.js') }}"></script>
</body>
</html>

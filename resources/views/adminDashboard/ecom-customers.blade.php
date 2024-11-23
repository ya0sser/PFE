<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{ asset('adminDashboard/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('adminDashboard/css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <title>Customers</title>
    <style>
        html, body {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        .button-group {
    display: flex;
    align-items: center;
    gap: 10px; /* Adjust the gap between buttons as needed */
}


        nav {
            width: 100%;
            padding-bottom: 0;
            font-family: 'Montserrat', sans-serif;
        }

        header {
            width: 100%;
            margin-top: 0;
            padding-bottom: 0;
        }

        .container-fluid {
            width: 100%;
            padding-right: 0;
            padding-left: 0;
            margin-right: auto;
            margin-left: auto;
        }

        .content-body {
            width: 100%;
            padding: 20px;
            margin: 0 !important;
        }

        .alert {
            margin-top: 20px;
        }

        .event-button {
            width: auto;
            height: auto;
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

        .card-header {
            padding: 10px 20px;
            margin-bottom: 0;
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
                        <div class="card-header">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addUserModal">
                                Add User
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-lg mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Password (Change)</th>
                                            <th>Joined Date</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            @if(!$user->is_admin)
                                                <tr>
                                                    <td>
                                                        <input type="text" name="name" form="updateForm{{ $user->id }}" value="{{ $user->name }}" class="form-control" style="width: 100%; max-width: 150px;">
                                                    </td>
                                                    <td>
                                                        <input type="email" name="email" form="updateForm{{ $user->id }}" value="{{ $user->email }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="phone" form="updateForm{{ $user->id }}" value="{{ $user->phone }}" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="password" name="password" form="updateForm{{ $user->id }}" placeholder="Enter new password" class="form-control">
                                                    </td>
                                                    <td>
                                                        {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                                    </td>
                                                    <td>
                                                        <div class="button-group">
                                                            <form id="updateForm{{ $user->id }}" method="POST" action="{{ route('admin.customers.update', $user->id) }}" style="display: inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                            </form>
                                                            <form action="{{ route('admin.customers.destroy', $user->id) }}" method="POST" style="display: inline;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger" onclick="return confirmDelete();">Delete</button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                    
                                                </tr>
                                            @endif
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


    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.customers.store') }}">
                        @csrf
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Email:</label>
                            <input type="email" name="email" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Phone:</label>
                            <input type="text" name="phone" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password:</label>
                            <input type="password" name="password" required class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this user?');
        }
    </script>

    <script src="{{ asset('adminDashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/deznav-init.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/highlightjs/highlight.pack.min.js') }}"></script>
</body>

</html>

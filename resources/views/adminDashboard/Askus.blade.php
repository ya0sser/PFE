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
    <title>Admin Comment Management</title>
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
            padding: 10px;
            margin: 0 !important;
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

        .card-body {
            padding: 10px;
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
                            <div class="table-responsive">
                                <table class="table table-responsive-lg mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Content</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($comments as $comment)
                                            <tr>
                                                <td>{{ $comment->name }}</td>
                                                <td>{{ $comment->email }}</td>
                                                <td>{{ $comment->content }}</td>
                                                <td>
                                                    <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger event-button">Delete</button>
                                                    </form>
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

    <script src="{{ asset('adminDashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/deznav-init.js') }}"></script>
</body>
</html>

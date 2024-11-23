<!-- resources/views/adminDashboard/machines/index.blade.php -->

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
    <title>Manage Machines</title>
    <style>
        html, body {
            width: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        nav {
            width: 100%;
            padding-bottom: 0;
            font-family: 'Poppins', sans-serif; 
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
                <li><a href="/admin/machines">MACHINES</a></li>
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
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addMachineModal">
                                Add Machine
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-responsive-lg mb-0 table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%;">Name</th>
                                            <th>Brand</th>
                                            <th>Capacity</th>
                                            <th>Power</th>
                                            <th>Materials</th>
                                            <th>Image</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($machines as $machine)
                                            <tr>
                                                <td>{{ $machine->name }}</td>
                                                <td>{{ $machine->brand }}</td>
                                                <td>{{ $machine->capacity }}</td>
                                                <td>{{ $machine->power }}</td>
                                                <td>{{ $machine->materials }}</td>
                                                <td><img src="{{ asset('images/' . $machine->image_path) }}" alt="{{ $machine->name }}" style="width: 100px; height: auto;"></td>
                                                <td>
                                                    <form action="{{ route('admin.machines.destroy', $machine->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete();">Delete</button>
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

    <div class="modal fade" id="addMachineModal" tabindex="-1" role="dialog" aria-labelledby="addMachineModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMachineModalLabel">New Machine</h5>
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
                    <form method="POST" action="{{ route('admin.machines.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Name:</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Brand:</label>
                            <input type="text" name="brand" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Capacity:</label>
                            <input type="text" name="capacity" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Power:</label>
                            <input type="text" name="power" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Materials:</label>
                            <input type="text" name="materials" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Image:</label>
                            <input type="file" name="image" required class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Machine</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this machine?');
        }
    </script>

    <script src="{{ asset('adminDashboard/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/custom.min.js') }}"></script>
    <script src="{{ asset('adminDashboard/js/deznav-init.js') }}"></script>
    <script src="{{ asset('adminDashboard/vendor/highlightjs/highlight.pack.min.js') }}"></script>
</body>

</html>

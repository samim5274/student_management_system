<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Student Management Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f8f9fa;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            flex-shrink: 0;
            transition: transform 0.3s ease;
        }

        .sidebar h4 {
            padding: 1rem;
            text-align: center;
            background-color: #23272b;
            margin-bottom: 0;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li a {
            display: block;
            padding: 12px 20px;
            color: #adb5bd;
            text-decoration: none;
            transition: background-color 0.2s ease;
        }

        .sidebar ul li a:hover {
            background-color: #495057;
            color: #fff;
        }

        .content {
            flex-grow: 1;
        }

        .topbar {
            background-color: #fff;
            padding: 1rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .dashboard-cards {
            padding: 2rem;
        }

        .dashboard-card {
            border-radius: 0.5rem;
            padding: 1.5rem;
            background: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: #343a40;
        }

        /* Mobile responsive sidebar */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100%;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                z-index: 1000;
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 999;
            }

            .overlay.show {
                display: block;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.menu')

        <!-- Main Content -->
        <div class="content">
            <!-- Top Navbar -->
            @include('layouts.message')
            <div class="topbar">
                <button class="toggle-btn d-md-none" onclick="toggleSidebar()">☰</button>
                <h5 class="mb-0">Announcement Details</h5>
                <a href="/logout"><button class="btn btn-outline-primary btn-sm">Logout</button></a>
            </div>

            <!-- Dashboard Cards -->
            <div class="dashboard-cards container-fluid">
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="dashboard-card">
                            <h5 class="mb-3">Add New Announcement</h5>
                            <form action="/create-announcement" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="txtTitle" id="title"
                                            placeholder="Title" required />
                                        <label for="title">Title</label>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="discription" class="form-label">Discription</label>
                                    <textarea class="form-control" id="discription" name="txtDiscription" placeholder="Task discription" rows="5"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Photo</label>
                                    <input type="file" class="form-control" id="photo" name="photo[]"
                                        accept="image/*" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="dashboard-card">
                            <h5 class="mb-3">Announcement List</h5>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th class="d-flex justify-content-around">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announcement as $val)
                                        <tr>
                                            <td>#</td>
                                            <td><a
                                                    href="{{ url('/view-announcement-specific/' . $val->id) }}">{{ $val->title }}</a>
                                            </td>
                                            <td>{{ $val->description }}</td>
                                            <td><img src="{{ asset('/img/uploads/' . $val->image) }}" alt="Loading.."
                                                    style="width:3rem; height:2rem;"></td>
                                            <td class="d-flex justify-content-around">
                                                <a href="{{ url('/announcement-edit/' . $val->id) }}"
                                                    class="btn btn-warning btn-sm">Edit</a>
                                                <form action="{{ url('/announcement-delete/' . $val->id) }}"
                                                    method="GET" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm delete-confirm">Delete</button>
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

        <!-- Bootstrap Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Sidebar Toggle Script -->
        <script>
            function toggleSidebar() {
                document.getElementById('sidebar').classList.toggle('show');
                document.getElementById('overlay').classList.toggle('show');
            }

            document.querySelectorAll('.delete-confirm').forEach(button => {
                button.addEventListener('click', function(event) {
                    if (!confirm('Are you sure you want to delete this announcement?')) {
                        event.preventDefault();
                    }
                });
            });
        </script>
</body>

</html>

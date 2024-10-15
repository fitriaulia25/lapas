<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar {
            width: 250px;
            background-color: #f8f9fa;
            position: fixed;
            height: 100%;
            padding-top: 20px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 16px;
            color: #333;
            display: block;
        }
        .sidebar a:hover {
            background-color: #e2e6ea;
        }
        .top-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            background-color: #343a40;
            color: white;
        }
        .logo {
            width: 30px;
            height: auto;
            margin-right: 10px;
        }
        .search-bar {
            flex: 1;
            margin-left: 10px;
        }
    </style>
</head>
<body>
        <!-- Main Content -->
        <div class="container mt-5 ms-3" style="margin-left: 250px;">
            <h2>Profile</h2>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                    @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}?{{ time() }}" alt="Profile Photo" class="img-fluid img-thumbnail" style="width: 150px; height: 150px;">
                @else
               <img src="{{ asset('default-profile.png') }}" alt="Default Profile Photo" class="img-fluid img-thumbnail" style="width: 150px; height: 150px;">
              @endif
                    </div>
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="old_password" class="form-label">Old Password</label>
                            <input type="password" name="old_password" class="form-control" id="old_password">
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" name="new_password" class="form-control" id="new_password">
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="form-label">Change Profile Photo</label>
                            <input type="file" name="photo" class="form-control" id="photo">
                        </div>
                        <button type="submit" class="btn btn-primary">Update Profile</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali ke Dashboard</a>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

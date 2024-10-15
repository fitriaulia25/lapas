<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Link to Font Awesome for profile icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .profile-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background-color: #e9ecef;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 80px;
            color: #6c757d;
        }
        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        .view-section p {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 10px;
        }
        .edit-section {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h2 class="card-title mb-4">Profile</h2>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Tampilan informasi profil (sebelum edit) -->
                <div class="row mb-3 view-section">
                    <div class="col-md-3 text-center">
                        @if($user->photo)
                            <img id="profileImage" src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="img-fluid profile-img">
                        @else
                            <div id="profileIcon" class="profile-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <p>{{ $user->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address:</label>
                            <p>{{ $user->email }}</p>
                        </div>
                        <button id="editBtn" class="btn btn-primary">Edit Profile</button>
                        <a href="{{ route('index') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>

                <!-- Form edit profil (disembunyikan) -->
                <div class="row mb-3 edit-section">
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-3 text-center">
                            @if($user->photo)
                               <img src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('default-profile.png') }}" alt="Profile Photo" class="img-fluid profile-img">

                            @else
                                <div id="profileIcon" class="profile-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
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
                                <input type="file" name="photo" class="form-control" id="photo" accept="image/*">
                                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
                            </div>
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                            <button id="cancelBtn" type="button" class="btn btn-secondary">Cancel</button>
                            </form>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const editBtn = document.getElementById('editBtn');
        const cancelBtn = document.getElementById('cancelBtn');
        const viewSection = document.querySelector('.view-section');
        const editSection = document.querySelector('.edit-section');

        // Ketika tombol edit diklik
        editBtn.addEventListener('click', function() {
            viewSection.style.display = 'none'; // Sembunyikan tampilan profil
            editSection.style.display = 'block'; // Tampilkan form edit
        });

        // Ketika tombol cancel diklik
        cancelBtn.addEventListener('click', function() {
            viewSection.style.display = 'block'; // Tampilkan kembali profil
            editSection.style.display = 'none'; // Sembunyikan form edit
        });
    </script>
</body>
</html>

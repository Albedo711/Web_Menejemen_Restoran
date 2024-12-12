<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .profile-icon {
      font-size: 100px;  
      color: #6c757d;    
    }
  </style>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    
    <a href="{{ url()->previous() }}" class="btn btn-primary mb-3">
      <i class="fas fa-arrow-left"></i> Kembali
    </a>

    <div class="card mx-auto shadow-sm" style="max-width: 400px;">
      <div class="card-body text-center">
        
        <i class="fas fa-user-circle profile-icon mb-3"></i> 
        
      
        <h3 class="fw-bold mb-1">{{ $user->name }}</h3>
        
        
        <p class="text-muted">{{ $user->role ?? 'User' }}</p>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <title>Task Planner</title>
</head>
<body>
<style>
  /* Custom Modal Header for Pink Theme */
.modal-header.custom-modal-header {
    background-color: #FEA4AA; /* Lighter pink, similar to your gradient middle */
    color: #D4536C; /* Darker pink for text */
    border-bottom: 1px solid #FEA4AA; /* Match border to background */
}

.modal-header.custom-modal-header .btn-close {
    filter: invert(20%) sepia(80%) saturate(2400%) hue-rotate(320deg) brightness(90%) contrast(100%); /* Makes Bootstrap's close icon pink */
}

/* Logout Icon Styling */
.logout-icon {
    font-size: 3rem; /* Large icon */
    color: #D4536C; /* Dark pink color for the icon */
    display: block; /* Ensures margin-bottom works */
}

/* Custom Button Styles for Pink Theme */
.btn-primary-pink {
    background-color: #D4536C; /* Main dark pink */
    border-color: #D4536C;
    color: #F8F8F9; /* White text */
    font-weight: bold;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-primary-pink:hover {
    background-color: #B04257; /* Slightly darker pink on hover */
    border-color: #B04257;
    color: #F8F8F9;
}

.btn-secondary-pink {
    background-color: #ffdce0; /* Lighter pink, similar to your btn-login */
    border-color: #ffdce0;
    color: #D4536C; /* Dark pink text */
    font-weight: bold;
    transition: background-color 0.3s ease, border-color 0.3s ease;
}

.btn-secondary-pink:hover {
    background-color: #f8c9cf; /* Slightly darker light pink on hover */
    border-color: #f8c9cf;
    color: #D4536C;
}
</style>
    

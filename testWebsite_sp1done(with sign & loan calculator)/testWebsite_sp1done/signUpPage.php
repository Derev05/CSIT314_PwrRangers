
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="assets/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="assets/bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <style>
        /* Center the card both horizontally and vertically */
        body {
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f8f9fa; /* Optional: Set a background color */
        }
        .signup {
            width: 400px;
            margin-left: auto;
            margin-right: auto;
            margin-top: 10%;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <div class="card signup bg-primary-subtle">
        <form id="signUpForm" action="UserCreation.php" method="POST">
            <div class="card-header text-center fw-bold fs-3">
                <h3>Sign Up</h3>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
            </div>
            <div class="mb-3">
                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
            </div>
            <div class="mb-3">
                <input type="text" class="form-control" id="contactno" placeholder="Contact Number" name="contactno">
            </div>
            <div class="mb-3">
                <input type="email" class="form-control" id="email" placeholder="Email Address" name="email" required>
            </div>
            <div class="mb-3">
                <input type="date" class="form-control" id="dob" placeholder="Date of Birth" name="dob">
            </div>
            <div class="mb-3">
                <select class="form-control" id="role" name="role" required>
                    <option value="">Select</option>
                    <option value="Agent">Agent</option>
                    <option value="Buyer">Buyer</option>
                    <option value="Seller">Seller</option>
                </select>
               </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </div>
        </form>
    </div>
</body>
</html>

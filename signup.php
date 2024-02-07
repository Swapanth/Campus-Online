<<<<<<< HEAD
=======
<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "campusonline"; // Your database name

// Create connection
$connection = new mysqli($servername, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Function to send OTP using Twilio
function sendOTP($mobileNumber, $otp)
{
    // Your Twilio credentials and other configurations
    require_once 'Twilio/autoload.php';

    // Twilio account credentials
    $sid = "AC5c473de347005dcc885efd5affed455b"; // Your Twilio SID
    $token = "ccb3a3ab16e99433dc783c5f45e389d0"; // Your Twilio Auth Token
    $twilioNumber = "+16598883893"; // Your Twilio phone number

    // Prepend "91" to the mobile number
    $mobileNumber = "+91" . $mobileNumber;

    // Construct OTP message
    $message = "Your OTP is: $otp";

    // Initialize Twilio client
    $client = new Twilio\Rest\Client($sid, $token);

    // Send OTP message
    $client->messages->create(
        $mobileNumber,
        [
            'from' => $twilioNumber,
            'body' => $message
        ]
    );
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // If OTP verification is requested
    if (isset($_POST['verify'])) {
        $user_otp = $_POST['otp'];
        $stored_otp = $_SESSION['otp'];

        // Compare the user-entered OTP with the stored OTP
        if ($stored_otp == $user_otp) {
            // If OTP matches, display a success message
            $successMessage = "Login Successful";
        } else {
            // If OTP does not match, display an error message
            $error = "Wrong OTP";
        }
    } else {
        // If registration number form is submitted
        $regNumber = $_POST['regNumber'];
        if (empty($regNumber)) {
            $error = "Please enter a registration number.";
        } else {
            // Execute a query to retrieve mobile number based on registration number
            $query = "SELECT mobile FROM verification WHERE registration = ?";
            if ($stmt = $connection->prepare($query)) {
                $stmt->bind_param("s", $regNumber);
                if ($stmt->execute()) {
                    $stmt->bind_result($mobileNumber);
                    if ($stmt->fetch()) {
                        // Generate OTP
                        $otp = rand(1000, 9999);

                        // Send OTP to the mobile number
                        sendOTP($mobileNumber, $otp);

                        // Store OTP in session for verification
                        $_SESSION['otp'] = $otp;

                        // Store registration number in session for verification
                        $_SESSION['regNumber'] = $regNumber;

                        // Display OTP entry form
                        $showOTPForm = true;
                    } else {
                        $error = "No mobile number found for the provided registration number.";
                    }
                } else {
                    $error = "Error executing query: " . $stmt->error;
                }
                $stmt->close();
            } else {
                $error = "Error preparing statement: " . $connection->error;
            }
        }
    }
}

// Close connection
$connection->close();
?>






>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<<<<<<< HEAD
    <title>Document</title>
=======
    <link id="googleFonts" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800%7CShadows+Into+Light&display=swap" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="vendor/animate/animate.compat.css">
    <link rel="stylesheet" href="vendor/simple-line-icons/css/simple-line-icons.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/owl.carousel/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="vendor/magnific-popup/magnific-popup.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-star-rating/css/star-rating.min.css">
    <link rel="stylesheet" href="vendor/bootstrap-star-rating/themes/krajee-fas/theme.min.css">



    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="css/theme-elements.css">
    <link rel="stylesheet" href="css/theme-blog.css">
    <link rel="stylesheet" href="css/theme-shop.css">

    <!-- Current Page CSS -->
    <link rel="stylesheet" href="vendor/circle-flip-slideshow/css/component.css">

    <!-- Skin CSS -->
    <link id="skinCSS" rel="stylesheet" href="css/skins/default.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.17.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- latest css -->
    <link rel="stylesheet" href="css/latest.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
    <style>
        body::after {
            content: "";
            display: table;
            clear: both;


        }
    </style>
</head>

<body>
<<<<<<< HEAD
    <?php include 'header.php'; ?> <!-- Check that 'header.php' is properly formatted -->

    <div class="row justify-content-md-center">
        <div class="#" style="width: 600px; margin:45px; height:900px !important;">
            <div class="featured-box featured-box-primary text-start mt-0">
                <div class="box-content">
                <div class="row">
                <div class="col-md-6 mb-3">
=======
    <!-- Check that 'header.php' is properly formatted -->

    <div class="row justify-content-md-center" style="margin-top:50px !important;">
        <div class="#" style="width: 600px; margin:45px;margin-top:150px; height:900px !important;">
            <div class="featured-box featured-box-primary text-start mt-0">
                <div class="box-content">
                    <div class="row">
                        <div class="col-md-6 mb-3">
>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
                            <h4 class="color-primary font-weight-semibold text-4 text-uppercase mb-3">Registering An Account</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="login.php" style="text-decoration: none; ">
                                <h4 class="font-weight-semibold text-4 text-uppercase mb-3" style="color: green; margin-left:-35px;"> Login ?</h4>
                            </a>


                        </div>

                    </div>
<<<<<<< HEAD
                    <form action="/" id="frmSignUp" method="post" class="needs-validation">
=======

                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation">
>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
                        <div class="row">
                            <div class="form-group col">
                                <label class="form-label">Register Number</label>
                                <div class="input-group">
<<<<<<< HEAD
                                    <input type="text" class="form-control form-control-lg" required>
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary">Send OTP</button>
                                    </div>


                                </div>

=======
                                    <input type="text" id="regNumber" name="regNumber" class="form-control form-control-lg" required value="<?php echo isset($regNumber) ? htmlspecialchars($regNumber) : ''; ?>">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Send OTP</button>
                                    </div>
                                </div>
>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
                            </div>
                        </div>
                    </form>

<<<<<<< HEAD

                    <style>
                        .otp-input {
                            width: 2.5em;
                            height: 2.5em;
                            text-align: center;
                            margin-left: 15px;
                            border-radius: 5px;
                            border-color: #ced4da;
                        }
                    </style>
                    <script>
                        function moveToNext(input) {
                            var maxLength = parseInt(input.getAttribute('maxlength'));
                            var currentLength = input.value.length;

                            if (currentLength >= maxLength) {
                                var nextInput = input.nextElementSibling;

                                while (nextInput) {
                                    if (nextInput.tagName.toLowerCase() === 'input') {
                                        nextInput.focus();
                                        break;
                                    }
                                    nextInput = nextInput.nextElementSibling;
                                }
                            }
                        }
                    </script>
                    <form action="/" id="SignUp" method="post" class="needs-validation">
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                        <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                        <input type="text" style="margin-bottom: 10px;" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />




                        <div class="row">
                            <div class="form-group col-lg-9">

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="terms" class="custom-control-input" id="terms" required>
                                    <label class="custom-control-label text-2" for="terms">I have read and agree to the <a href="#">terms of service</a></label>
                                </div>
                            </div>
                            <div class="form-group col-lg-3">
                                <a id="boxcontent">
                                <button type="submit" class="btn btn-primary btn-modern float-endy">Verify</button>
                                </a> <!-- <button class="btn btn-primary btn-modern float-endy" style="bottom:0 !important; right:0;" type="submit">Submit form</button> -->
                            </div>
                        </div>
                    </form>

                    <!-- id="boxcontent" -->


                    <script>
                        document.getElementById('boxcontent').addEventListener('click', function() {
                            var boxarea = document.querySelector('.box-content');

                            // Modify the content dynamically using insertAdjacentHTML
                            boxarea.innerHTML = `
        <div class="row">
    <div class="">
        <h3 style="text-align: left; color: #0088cc; text-transform: none; margin: bottom -10px !important;">Welcome to Campus Online</h3> 
    </div>
    <div class="col-md-6 mb-3 mt-3">
       
    </div>
</div>

				
				<form id="myForm" class="needs-validation">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="validationDefault01">First name</label>
                <input type="text" class="form-control" name="firstname" id="validationDefault01" value="" required>
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationDefault02">Last name</label>
                <input type="text" class="form-control" name="lastname" id="validationDefault02" value="" required>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="validationDefault03">Email</label>
                <input type="email" class="form-control" name="email" id="validationDefault03" required>
            </div>

			
			<div class="col-md-3 mb-3">
				<label for="validationDefault05">Phone Number</label>
				<input type="text" class="form-control" name="phonenumber" id="validationDefault05" required>
			</div>
            <div class="col-md-3 mb-3">
                <label for="validationDefault04">Academic Year</label>
                <select class="form-select form-control" name="year" id="validationDefault04" required>
                    <option  value="">1 Year</option>
                    <option>2 Year</option>
					<option>3 Year</option>
					<option>4 Year</option>
                </select>
            </div>
			<div class="col-md-6 mb-3">
    <label for="validationDefault03">Register Number</label>
    <input type="text" class="form-control" name="registernumb" id="validationDefault05" required>
</div>
<div class="col-md-6 mb-3">
    <label for="validationDefault03">Password</label>
    <input type="text" class="form-control" name="password" id="validationDefault06" required>
</div>


           
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                <label class="form-check-label" style="text-align:left !important; cursor: pointer;" for="invalidCheck2" id="termsLabel" >
                    Agree to terms and conditions
                </label>
                <button type="register" name="register" class="btn btn-primary btn-modern float-endy" style="margin-left:30px; width:150px">Register</button>
            </div>
        </div>
    
       
       
    </form>

    
    <div class="modal fade" id="termsModal" tabindex="-1" role="dialog" aria-labelledby="termsModalLabel" aria-hidden="true">
    
</div>
            
        `;
                        });
                    </script>


                </div>
            </div>
        </div>
    </div>
</body>

</html>
<?php
// Step 1: Handle form submission
if (isset($_POST['register'])) {

    // Step 2: Establish a connection to your database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "campusonline";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Step 3: Retrieve form data
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $academicyear = mysqli_real_escape_string($conn, $_POST['academicyear']);
    $registernumber = mysqli_real_escape_string($conn, $_POST['registernumb']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Step 5: Prepare SQL INSERT statement
    $sql = "INSERT INTO register (firstname, lastname, email, phonenumber, year, registernumb, password) 
            VALUES ('$firstname', '$lastname', '$email', '$phonenumber', '$academicyear', '$registernumber', '$password')";

    // Step 6: Execute INSERT statement
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Step 7: Close database connection
    mysqli_close($conn);
}
?>

=======
                    <div id="result"></div>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <style>
                    .otp-input {
                        width: 2.5em;
                        height: 2.5em;
                        text-align: center;
                        margin-left: 15px;
                        border-radius: 5px;
                        border-color: #ced4da;
                    }
                </style>
                <script>
                    function moveToNext(input) {
                        var maxLength = parseInt(input.getAttribute('maxlength'));
                        var currentLength = input.value.length;

                        if (currentLength >= maxLength) {
                            var nextInput = input.nextElementSibling;

                            while (nextInput) {
                                if (nextInput.tagName.toLowerCase() === 'input') {
                                    nextInput.focus();
                                    break;
                                }
                                nextInput = nextInput.nextElementSibling;
                            }
                        }
                    }
                </script>
                <!-- <form action="/" id="SignUp" method="post" class="needs-validation">
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                    <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                    <input type="text" style="margin-bottom: 10px;" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />

                    <div class="row">
                        <div class="form-group col-lg-9">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="terms" class="custom-control-input" id="terms" required>
                                <label class="custom-control-label text-2" for="terms">I have read and agree to the <a href="#">terms of service</a></label>
                            </div>
                        </div>
                        <div class="form-group col-lg-3">
                            <button type="submit" class="btn btn-primary btn-modern float-endy" name="verify">Verify</button>
                        </div>
                    </div>
                </form> -->
                <?php if (isset($showOTPForm) && $showOTPForm) : ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="needs-validation" style="margin-top: -30px;">
        <label class="form-label" style="margin-left: 30px;">Enter OTP</label>

        <div class="row">
            <div class="form-group col" style="margin-left: 10px;">
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                <input type="text" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />
                <input type="text" style="margin-bottom: 10px;" class="otp-input" maxlength="1" oninput="moveToNext(this)" required />

                <!-- Hidden input field to store concatenated OTP -->
                <input type="hidden" name="otp" id="otp">
            </div>
        </div>

        <div class="row">
            <div class="form-group col-lg-9">
                <div class="custom-control custom-checkbox" style="margin-left: 10px;">
                    <input type="checkbox" name="terms" class="custom-control-input" id="terms" required style="margin-left: 10px;">
                    <label class="custom-control-label text-2" style="margin-left: 20px;" for="terms">I have read and agree to the <a href="#">terms of service</a></label>
                </div>
            </div>
            <div class="form-group col-lg-3">
                <button type="submit" class="btn btn-primary btn-modern float-endy" name="verify">Verify</button>
            </div>
        </div>
    </form>
    <?php endif; ?>
    <?php if (isset($successMessage)) : ?>
    <script>
        // Function to display box content
        function displayBoxContent() {
            var boxarea = document.querySelector('.box-content');

            // Modify the content dynamically using insertAdjacentHTML
            boxarea.innerHTML = `
                <div class="row">
                    <div class="">
                        <h3 style="text-align: left; color: #0088cc; text-transform: none; margin-bottom: -10px !important;">Welcome to Campus Online</h3> 
                    </div>

                </div>

                <form id="myForm" class="needs-validation">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault01">First name</label>
                            <input type="text" class="form-control" id="validationDefault01" value="" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault02">Last name</label>
                            <input type="text" class="form-control" id="validationDefault02" value="" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">Email</label>
                            <input type="email" class="form-control" id="validationDefault03" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault05">Phone Number</label>
                            <input type="text" class="form-control" id="validationDefault05" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="validationDefault04">Academic Year</label>
                            <select class="form-select form-control" id="validationDefault04" required>
                                <option selected disabled value="">1 Year</option>
                                <option>2 Year</option>
                                <option>3 Year</option>
                                <option>4 Year</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationDefault03">Set Password</label>
                            <input type="text" class="form-control" id="validationDefault05" required>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label for="validationDefault03"> Confirm Password</label>
                            <input type="text" class="form-control" id="validationDefault04" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                            <label class="form-check-label" style="text-align:left !important; cursor: pointer;" for="invalidCheck2" id="termsLabel" >
                                Agree to terms and conditions
                            </label>
                            <button type="submit" class="btn btn-primary btn-modern float-endy" style="margin-left:30px; width:150px">Register</button>
                        </div>
                    </div>
                </form>
            `;
        }

        // Call the function to display box content
        displayBoxContent();
    </script>
<?php elseif (isset($error)) : ?>
    <div class='alert alert-danger'><?php echo $error; ?></div>
<?php endif; ?>



<script>
    function moveToNext(input) {
        var maxLength = parseInt(input.getAttribute('maxlength'));
        var currentLength = input.value.length;

        if (currentLength >= maxLength) {
            var nextInput = input.nextElementSibling;

            while (nextInput) {
                if (nextInput.tagName.toLowerCase() === 'input') {
                    nextInput.focus();
                    break;
                }
                nextInput = nextInput.nextElementSibling;
            }
        }

        // Concatenate the input values
        var otpInputs = document.querySelectorAll('.otp-input');
        var concatenatedOTP = "";
        otpInputs.forEach(function(input) {
            concatenatedOTP += input.value;
        });

        // Assign the concatenated value to the hidden input field named "otp"
        document.getElementById('otp').value = concatenatedOTP;
    }
</script>




            </div>
        </div>
    </div>
    </div>
</body>

</html>
>>>>>>> 9cb4a12501f294c61429d9d25d86424a3d1fe8fe
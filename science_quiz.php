 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Kider Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@600&family=Lobster+Two:wght@700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5 py-lg-0">
            <a href="index.php" class="navbar-brand">
                <h1 class="m-0 text-primary"><i class="fa fa-book-reader me-3"></i>Kider</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About Us</a>
                    <a href="classes.php" class="nav-item nav-link">Classes</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown">Pages</a>
                        <div class="dropdown-menu rounded-0 rounded-bottom border-0 m-0">
                        <a href="Asmrs.php" class="dropdown-item">Asmr Video</a>
                            <a href="appointment.php" class="dropdown-item">Make Appointment</a>
                            <a href="404.php" class="dropdown-item active">Kids Game</a>
                        </div>
                    </div>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                    
                </div>
                <?php if(isset($user_data) && !empty($user_data)): ?>
    <?php if(isset($user_data['name']) && !empty($user_data['name'])): ?>
        <div class="navbar-nav">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $user_data['name']; ?></a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php else: ?>
    <a href="login.php" class="btn btn-primary rounded-pill px-3 d-none d-lg-block">Join Us<i class="fa fa-arrow-right ms-3"></i></a>
<?php endif; ?>

            </div>
        </nav>
        <!-- Navbar End -->


        <!-- Page Header End -->
        <div class="container-xxl py-5 page-header position-relative mb-5">
            <div class="container py-5">
                <h1 class="display-2 text-white animated slideInDown mb-4">Kids Game</h1>
                <nav aria-label="breadcrumb animated slideInDown">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pages</a></li>
                        <li class="breadcrumb-item text-white active" aria-current="page">Games</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!-- Page Header End -->


        <!-- 404 Start -->
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kids Game</title>
    <!-- Add your CSS stylesheets here -->
    <style>
        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            color: #007bff;
        }

        .game {
            margin-top: 20px;
        }

        .question {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .answer-btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        #result {
            margin-top: 20px;
        }

        #score {
            margin-top: 20px;
            font-weight: bold;
        }

        #motivation {
            margin-top: 20px;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include 'navbar.php'; ?>

    <!-- Page Content -->
    <div class="container">
        <h1>Kids Game</h1>
        <div class="game">
            <div class="question" id="question"></div>
            <button class="answer-btn" onclick="checkAnswer('A')" id="optionA"></button>
            <button class="answer-btn" onclick="checkAnswer('B')" id="optionB"></button>
            <button class="answer-btn" onclick="checkAnswer('C')" id="optionC"></button>
        </div>
        <div id="result"></div>
        <div id="score">Score: 0</div>
        <div id="motivation"></div>
    </div>

    <script>
        var score = 0;
        var questions = [
            { question: 'What is the color of the sky during the day?', options: ['A) Blue', 'B) Red', 'C) Green'], answer: 'A' },
            { question: 'What is the shape of the Earth?', options: ['A) Flat', 'B) Round', 'C) Square'], answer: 'B' },
            { question: 'What do plants need to make food?', options: ['A) Water and sunlight', 'B) Air and soil', 'C) Rocks and minerals'], answer: 'A' },
            { question: 'What is the source of energy for the Sun?', options: ['A) Wind', 'B) Coal', 'C) Nuclear fusion'], answer: 'C' },
            { question: 'What is the process by which water changes from a liquid to a gas?', options: ['A) Freezing', 'B) Condensation', 'C) Evaporation'], answer: 'C' },
            { question: 'What causes the tides?', options: ['A) The Earth spinning on its axis', 'B) The Moon\'s gravitational pull', 'C) The Sun\'s heat'], answer: 'B' },
            { question: 'What is the hardest natural substance on Earth?', options: ['A) Wood', 'B) Diamond', 'C) Steel'], answer: 'B' },
            { question: 'What is the process by which plants make their own food?', options: ['A) Photosynthesis', 'B) Respiration', 'C) Decomposition'], answer: 'A' },
            { question: 'What type of animal lives both on land and in water?', options: ['A) Bird', 'B) Fish', 'C) Amphibian'], answer: 'C' },
            { question: 'What gas do plants absorb during photosynthesis?', options: ['A) Oxygen', 'B) Carbon dioxide', 'C) Nitrogen'], answer: 'B' },
            { question: 'What is the study of living organisms called?', options: ['A) Biology', 'B) Chemistry', 'C) Physics'], answer: 'A' },
            { question: 'What is the closest star to Earth?', options: ['A) The Moon', 'B) The Sun', 'C) Proxima Centauri'], answer: 'B' },
            { question: 'What is the main component of air?', options: ['A) Oxygen', 'B) Nitrogen', 'C) Carbon dioxide'], answer: 'B' },
            { question: 'What is the process by which liquid water turns into a gas?', options: ['A) Melting', 'B) Evaporation', 'C) Sublimation'], answer: 'B' },
            { question: 'Which animal is known for its ability to camouflage?', options: ['A) Cheetah', 'B) Chameleon', 'C) Gorilla'], answer: 'B' },
            { question: 'What is the process by which plants release water vapor into the air?', options: ['A) Transpiration', 'B) Precipitation', 'C) Filtration'], answer: 'A' },
            { question: 'What is the largest planet in our solar system?', options: ['A) Earth', 'B) Jupiter', 'C) Mars'], answer: 'B' },
            { question: 'What is the study of stars and galaxies called?', options: ['A) Geology', 'B) Astronomy', 'C) Meteorology'], answer: 'B' },
            { question: 'What is the process by which rocks are broken down into smaller pieces by water, wind, or ice?', options: ['A) Erosion', 'B) Volcanism', 'C) Sedimentation'], answer: 'A' },
            { question: 'What gas do humans breathe out?', options: ['A) Oxygen', 'B) Carbon dioxide', 'C) Nitrogen'], answer: 'B' }
        ];

        var currentQuestionIndex = 0;

        function checkAnswer(answer) {
            var correctAnswer = questions[currentQuestionIndex].answer;
            if (answer === correctAnswer) {
                score++;
                document.getElementById('result').innerText = 'Correct!';
            } else {
                document.getElementById('result').innerText = 'Incorrect!';
            }
            updateScore();
            currentQuestionIndex++;
            if (currentQuestionIndex < 5) {
                nextQuestion();
            } else {
                showResult();
            }
        }

        function updateScore() {
            document.getElementById('score').innerText = 'Score: ' + score;
        }

        function nextQuestion() {
            var randomIndex = Math.floor(Math.random() * (questions.length - currentQuestionIndex)) + currentQuestionIndex;
            var currentQuestion = questions[randomIndex];
            questions[randomIndex] = questions[currentQuestionIndex];
            questions[currentQuestionIndex] = currentQuestion;

            document.querySelector('.question').innerText = currentQuestion.question;
            document.getElementById('result').innerText = '';
            document.getElementById('optionA').innerText = currentQuestion.options[0];
            document.getElementById('optionB').innerText = currentQuestion.options[1];
            document.getElementById('optionC').innerText = currentQuestion.options[2];
        }

        function showResult() {
            document.getElementById('score').innerText = 'Final Score: ' + score;
            document.getElementById('motivation').style.display = 'block';
            if (score === 5) {
                document.getElementById('motivation').innerText = 'Congratulations! You got all the answers correct!';
            } else {
                document.getElementById('motivation').innerText = 'You did your best! Keep practicing!';
            }
        }

        // Call nextQuestion function to start the game
        nextQuestion();
    </script>
    <button onclick="location.reload();" style="margin-top: 20px;">Restart Quiz</button>

</body>

</html>


        <!-- 404 End -->


        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
            <div class="container py-5">
                <div class="row g-5">
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Get In Touch</h3>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>123 Street, New York, USA</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>+012 345 67890</p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@example.com</p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                            <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Quick Links</h3>
                        <a class="btn btn-link text-white-50" href="">About Us</a>
                        <a class="btn btn-link text-white-50" href="">Contact Us</a>
                        <a class="btn btn-link text-white-50" href="">Our Services</a>
                        <a class="btn btn-link text-white-50" href="">Privacy Policy</a>
                        <a class="btn btn-link text-white-50" href="">Terms & Condition</a>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Photo Gallery</h3>
                        <div class="row g-2 pt-2">
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-1.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-2.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-3.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-4.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-5.jpg" alt="">
                            </div>
                            <div class="col-4">
                                <img class="img-fluid rounded bg-light p-1" src="img/classes-6.jpg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <h3 class="text-white mb-4">Newsletter</h3>
                        <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                        <div class="position-relative mx-auto" style="max-width: 400px;">
                            <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text" placeholder="Your email">
                            <button type="button" class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">SignUp</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            &copy; <a class="border-bottom" href="#">Your Site Name</a>, All Right Reserved. 
							
							<!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
							Designed By <a class="border-bottom" href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <div class="footer-menu">
                                <a href="">Home</a>
                                <a href="">Cookies</a>
                                <a href="">Help</a>
                                <a href="">FQAs</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>

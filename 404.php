 
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
            <div class="navbar-nav">
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><?php echo $user_data['name']; ?></a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="profile.php">Profile</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Logout</a>

                    </div>
                </div>
            </div>
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
    <title>Kids Game </title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

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
        <div id="quiz-container">
            <h1>Kids Game</h1>
            <p class="question"></p>
            <input type="text" id="answer" placeholder="Your Answer" style="padding: 8px; border: 1px solid #ccc; border-radius: 20px; width: 200px;">

<button onclick="checkAnswer()" style="background-color: #007bff; color: #fff; border: none; border-radius: 20px; padding: 10px 20px; cursor: pointer;">Submit</button>

            <p id="result"></p>
            <p id="score">Score: 0</p>
            <p id="motivation" style="display: none;"></p>
        </div>
    </div>

    <script>
        var score = 0;
        var questions = [
            { question: 'What comes after 2?', answer: '3' },
            { question: 'What comes after C?', answer: 'D' },
            { question: 'What comes after 8?', answer: '9' },
            { question: 'What comes after F?', answer: 'G' },
            { question: 'Complete the sequence: 1, 3, 5, _', answer: '7' },
            { question: 'What is the capital of France?', answer: 'Paris' },
            { question: 'What is 2 + 2?', answer: '4' },
            { question: 'What is the color of the sky?', answer: 'Blue' },
            { question: 'What is the opposite of hot?', answer: 'Cold' },
            { question: 'What animal barks?', answer: 'Dog' },
            { question: 'What is the opposite of up?', answer: 'Down' },
            { question: 'What comes after Monday?', answer: 'Tuesday' },
            { question: 'What is the largest planet in our solar system?', answer: 'Jupiter' },
            { question: 'What is the opposite of dark?', answer: 'Light' },
            { question: 'What is the color of an apple?', answer: 'Red' },
            { question: 'What comes after Z?', answer: 'AA' },
            { question: 'What is the opposite of big?', answer: 'Small' },
            { question: 'What is the capital of the United States?', answer: 'Washington, D.C.' },
            { question: 'What is 5 multiplied by 2?', answer: '10' },
            { question: 'What is the opposite of fast?', answer: 'Slow' },
            { question: 'What is the color of grass?', answer: 'Green' },
            { question: 'What is the opposite of love?', answer: 'Hate' },
            { question: 'What is the capital of Japan?', answer: 'Tokyo' },
            { question: 'What is the opposite of inside?', answer: 'Outside' },
            { question: 'What is the color of the sun?', answer: 'Yellow' },
            { question: 'What is the opposite of old?', answer: 'New' },
            { question: 'What is the capital of Italy?', answer: 'Rome' },
            { question: 'What is the opposite of wet?', answer: 'Dry' },
            { question: 'What is the color of the moon?', answer: 'White' },
            { question: 'What is the opposite of easy?', answer: 'Difficult' }
        ];

        var currentQuestionIndex = 0;
        var questionsPerRound = 5;

        // Shuffle questions
        questions.sort(() => Math.random() - 0.5);

        function checkAnswer() {
            var userAnswer = document.getElementById('answer').value.trim().toLowerCase();
            var correctAnswer = questions[currentQuestionIndex].answer.toLowerCase();
            var resultDisplay = document.getElementById('result');
            if (userAnswer === correctAnswer) {
                score++;
                 resultDisplay.textContent = 'Correct!';
            } else {
                resultDisplay.textContent = 'Incorrect!';
            }
            updateScore();
            currentQuestionIndex++;
            if (currentQuestionIndex < questionsPerRound) {
                nextQuestion();
            } else {
                showResult();
            }
            document.getElementById('answer').value = ''; // Clear input field
        }

        function updateScore() {
            document.getElementById('score').textContent = 'Score: ' + score;
        }

        function nextQuestion() {
            var currentQuestion = questions[currentQuestionIndex];
            document.querySelector('.question').textContent = currentQuestion.question;
            document.getElementById('result').textContent = '';
        }

        function showResult() {
            document.getElementById('score').textContent = 'Final Score: ' + score;
            document.getElementById('motivation').style.display = 'block';
            var motivationText = '';
            if (score === questionsPerRound) {
                motivationText = 'Perfect score! Congratulations!';
            } else if (score >= questionsPerRound / 2) {
                motivationText = 'Well done! You passed!';
            } else {
                motivationText = 'Keep practicing to improve your score!';
            }
            document.getElementById('motivation').textContent = motivationText;
        }

        // Call nextQuestion function to start the game
        nextQuestion();
    </script>

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

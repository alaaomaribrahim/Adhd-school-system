-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2022 at 07:56 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33
--
-- Database: `pre_db`
--

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Table structure for table `Users`
--

CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Role ENUM('Admin', 'Teacher', 'Parent', 'Student') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Users table
INSERT INTO `Users` (`Username`, `Password`, `Role`) VALUES
('admin', 'password', 'Admin'),
('teacher', 'teacher', 'Teacher'),
('parent', 'parent', 'Parent'),
('student', 'student', 'Student');


CREATE TABLE Courses (
    CourseID INT AUTO_INCREMENT PRIMARY KEY,
    CourseName VARCHAR(255) NOT NULL,
    TeacherID INT NOT NULL,
    FOREIGN KEY (TeacherID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Courses table
INSERT INTO Courses (CourseName, TeacherID) VALUES ('Math', 1);


CREATE TABLE Lessons (
    LessonID INT AUTO_INCREMENT PRIMARY KEY,
    LessonName VARCHAR(255) NOT NULL,
    CourseID INT NOT NULL,
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Lessons table
INSERT INTO Lessons (LessonName, CourseID) VALUES ('Algebra', 1);


CREATE TABLE Quizzes (
    QuizID INT AUTO_INCREMENT PRIMARY KEY,
    QuizName VARCHAR(255) NOT NULL,
    LessonID INT NOT NULL,
    TeacherID INT NOT NULL,
    FOREIGN KEY (LessonID) REFERENCES Lessons(LessonID),
    FOREIGN KEY (TeacherID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Quizzes table
INSERT INTO Quizzes (QuizName, LessonID, TeacherID) VALUES ('Algebra Quiz 1', 1, 1);


CREATE TABLE Tasks (
    TaskID INT AUTO_INCREMENT PRIMARY KEY,
    TaskName VARCHAR(255) NOT NULL,
    LessonID INT NOT NULL,
    TeacherID INT NOT NULL,
    FOREIGN KEY (LessonID) REFERENCES Lessons(LessonID),
    FOREIGN KEY (TeacherID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Tasks table
INSERT INTO Tasks (TaskName, LessonID, TeacherID) VALUES ('Algebra Homework 1', 1, 1);


CREATE TABLE Children (
    ChildID INT AUTO_INCREMENT PRIMARY KEY,
    ChildName VARCHAR(255) NOT NULL,
    ParentID INT NOT NULL,
    FOREIGN KEY (ParentID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Children table
INSERT INTO Children (ChildName, ParentID) VALUES ('John Doe', 3);


CREATE TABLE Enrollments (
    EnrollmentID INT AUTO_INCREMENT PRIMARY KEY,
    ChildID INT NOT NULL,
    CourseID INT NOT NULL,
    FOREIGN KEY (ChildID) REFERENCES Children(ChildID),
    FOREIGN KEY (CourseID) REFERENCES Courses(CourseID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into Enrollments table
INSERT INTO Enrollments (ChildID, CourseID) VALUES (1, 1);


CREATE TABLE QuizSubmissions (
    SubmissionID INT AUTO_INCREMENT PRIMARY KEY,
    QuizID INT NOT NULL,
    ChildID INT NOT NULL,
    SubmissionDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Grade DECIMAL(5,2),
    FOREIGN KEY (QuizID) REFERENCES Quizzes(QuizID),
    FOREIGN KEY (ChildID) REFERENCES Children(ChildID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into QuizSubmissions table
INSERT INTO QuizSubmissions (QuizID, ChildID) VALUES (1, 1);


CREATE TABLE ProgressTracking (
    ProgressID INT AUTO_INCREMENT PRIMARY KEY,
    ChildID INT NOT NULL,
    LessonID INT NOT NULL,
    ProgressStatus ENUM('Not Started', 'In Progress', 'Completed') NOT NULL,
    FOREIGN KEY (ChildID) REFERENCES Children(ChildID),
    FOREIGN KEY (LessonID) REFERENCES Lessons(LessonID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into ProgressTracking table
INSERT INTO ProgressTracking (ChildID, LessonID, ProgressStatus) VALUES (1, 1, 'Not Started');


CREATE TABLE Feedback (
    FeedbackID INT AUTO_INCREMENT PRIMARY KEY,
    SubmissionID INT NOT NULL,
    TeacherID INT NOT NULL,
    FeedbackText TEXT,
    FOREIGN KEY (SubmissionID) REFERENCES QuizSubmissions(SubmissionID),
    FOREIGN KEY (TeacherID) REFERENCES Users(UserID)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Execute SQL queries
if ($conn->multi_query($sql) === TRUE) {
    echo "Tables created and data inserted successfully\n";
} else {
    echo "Error executing SQL queries: ". $conn->error;
}
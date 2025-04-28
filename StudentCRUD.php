<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Students CRUD Opration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen p-6">

<div class="grid grid-cols-1 md:grid-cols-2 gap-8">

    <!-- Left Side (Forms) -->
    <div class="space-y-8">

        <!-- Create Table Form
        <form method="post" autocomplete="off" class="bg-white p-6 rounded-xl shadow-md space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">Create Table</h2>
            <textarea name="tableQuery" id="tableQuery" placeholder="Enter Table Query" required
                class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                rows="4"></textarea>
            <button type="submit" name="createTable"
                class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition">
                Create Table In Database
            </button>
        </form> -->

        <!-- Insert Student Form -->
        <form method="post" autocomplete="off" class="bg-white p-6 rounded-xl shadow-md space-y-4">
            <h2 class="text-2xl font-bold text-gray-800">Insert Student</h2>
            <input type="text" required name="name" placeholder="Student Name" pattern="^[a-zA-Z\s]{3,20}$"
                title="Student name should only contain letters and spaces with more than 3 characters."
                class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">

            <input type="email" name="email" placeholder="Email Address" required
                class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">

            <input type="text" required name="course" placeholder="Course" pattern="^[a-zA-Z\s]{3,20}$"
                title="Course name should only contain letters and spaces with more than 3 characters."
                class="w-full border border-gray-300 p-3 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">

            <button type="submit" name="insert"
                class="w-full bg-green-500 text-white py-2 rounded-md hover:bg-green-600 transition">
                Insert Student
            </button>
        </form>

        <!-- Show All Students Button -->
        <form method="post" autocomplete="off" class="bg-white p-6 rounded-xl shadow-md text-center">
            <button type="submit" name="select"
                class="w-full bg-purple-500 text-white py-2 rounded-md hover:bg-purple-600 transition">
                Show All Students
            </button>
        </form>

    </div>


    <?php
    require('./Database.php');
    require_once 'Functions.php';


    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // create table
        if (isset($_POST["createTable"])) {
            try {
                $tablequery = $_REQUEST["tableQuery"];
                $pdo->exec($tablequery);
                success("table created successfully");
            } catch (PDOException $e) {
                error($e);
            }
        }

        // insert data

        $insertQuery = "insert into students(NAME,EMAIL,COURSE) VALUES (:name ,:email ,:course)";
        btnFunctionality($pdo, "insert", $insertQuery, "Data inserted");

        // Select Data
        if (isset($_POST["select"])) {
            showDataInTable($pdo);
        }
        // update Data

        $updateQuery = "update students set NAME=:name , EMAIL=:email , COURSE=:course WHERE ID = :id";
        btnFunctionality($pdo, "update", $updateQuery, "Data updated");


        // Delete Data
        $deleteQuery = "delete from students where ID = :id" ; 
        btnFunctionality($pdo,"delete",$deleteQuery,"Data Deleted");
        
    }
    ?>
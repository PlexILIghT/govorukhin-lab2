<?php
if (!isset($_COOKIE['User'])) {
    header('location: /login.php');
    exit();
}

require_once('db.php');
$link = mysqli_connect('127.0.0.1', 'root', 'kali', 'app');

if(isset($_POST['submit'])) {
    $title = $_POST['postTitle'];
    $main_text = $_POST['postContent'];

    if (!$title || !$main_text) die("no data post");

    if(!empty($_FILES["file"])) {

        $allowedTypes = ["image/gif", "image/jpeg", "image/jpg", "image/pjpeg", "image/x-png", "image/png"];
        if (in_array($_FILES["file"]["type"], $allowedTypes) && $_FILES["file"]["size"] < 1024000) {
            $targetDir = "upload/";

            if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

            $imageName = basename($_FILES["file"]["name"]);
            move_uploaded_file($_FILES["file"]["tmp_name"], $targetDir . $imageName);

        } else {
            echo "upload failed! (Wrong type or size)";
        }
    }

    $sql = "INSERT INTO posts (title, main_text, image) VALUES ('$title', '$main_text', '$imageName')";

    if (!mysqli_query($link,$sql)) die("error insert data post: " . mysqli_error($link));
    
    header("Location: index.php");
    exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Govorukhin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark p-3">
        <div class="container-fluid">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <img src="Лого_120_40.png" alt="логотип сайта" class="me-2">
                <span class="text-light">History</span>
            </a>
            <?php if (isset($_COOKIE['User'])): ?>
            <form action="/logout.php" method="POST" class="d-flex">
                <button class="btn btn-outline-danger" type="submit">Logout</button>
            </form>
            <?php endif; ?>
        </div>
    </nav>
    <div class="container mt-5">
        <div class="story-container">
            <div class="story-text">
                <h2>Decensus Ad Nihilum</h2>
                <p>
[Verse 1]
A shooting star falls through the sea
Floating down into my dream
Your echo cries from far away
Oblivion calls out my name
Never mind what I became

[Chorus]
Meet me by the broken gates
Bid the light one last embrace
God it feels good to pretend
Until we meet again

[Verse 2]
Reaching through the static
Feel my hands go numb
The nightmares are breathing
I don't know where they're coming from
Your echo cries from far away
Oblivion calls out my name

[Chorus]
Meet me by the broken gates
Bid the light one last embrace
God it feels good to pretend
Don't look down, don't look down
Just leave time to suspend
We're safe right here until we meet again

[Outro]
(Yet when I stare into the darkness)
(The void begins to speak)</p>
            </div>
            <img src="mr-robot-edit-mr-robot.gif" alt="H4CKKKK" class="hacker-img">
        </div>
        <div class="text-center mt-4">
            <button id="toggleButton" class="btn btn-primary">Open</button>
        </div>
        <div id="extraImage" class="mt-3 text-center" style="display: none;">
            <img class="hacker-img" src="mornye_600.jpg" alt="h4ck3r">
        </div>
        <div class="mt-5">
            <h2 class="text-center mb-4">Add New Post <?php $username1 = $_COOKIE['User']; echo "$username1";?></h2>
            <form action="profile.php" id="postForm" class="d-flex flex-column gap-3" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label class="form-label" for="postTitle">Post Title</label>
                    <input type="text" name="postTitle" class="form-control hacker-input" id="postTitle" placeholder="Enter post Title" required>
                </div>
                <div class="form-group">
                    <label class="form-label" for="postContent">Post Content</label>
                    <textarea name="postContent" class="form-control hacker-input" id="postContent" placeholder="Enter post Content" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label" for="file">Upload file</label>
                    <input type="file" name="file" class="form-control hacker-input" id="file">
                </div>
                <button class="btn btn-primary" type="submit" name="submit">Save Post</button>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    document.getElementById('toggleButton').addEventListener("click", function(){
    var extraImage = document.getElementById('extraImage');
    if (extraImage.style.display === 'none'){
        extraImage.style.display = 'block';
        this.textContent = 'Close';
    } else {
        extraImage.style.display = 'none';
        this.textContent = 'Open';
    }
});
</script>
<?php

// Target dirs
$target_dir1 = "uploads/";
$target_dir2 = "uploads/images";
$target_dir3 = "uploads/music";
$target_dir4 = "uploads/movies";

// Target = dir + filename
$target_file = $target_dir1 . basename($_FILES["fileToUpload"]["name"]);
$fileName = basename($_FILES["fileToUpload"]["name"]);

// no error on init
$uploadOk = 1;
// fileType var
$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

// FILE CHECK
// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    // Allow certain file formats
    if ($imageFileType != "jpg"
        && $imageFileType != "png"
        && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Erlaubt: JPG, JPEG, PNG & GIF";
        $uploadOk = 0;
    }
}


// Check if $uploadOk is set to 0 by an error

// if error
if ($uploadOk == 0) {
    echo "die Datei wurde nicht hochgeladen";
} // if no error
else {
    // move ok
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    } // move error
    else {
        echo "Sorry, es gab einen Fehler beim Upload";
    }
}
?>

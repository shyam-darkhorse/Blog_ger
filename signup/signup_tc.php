<html>
<body>
<?php
 
// Create connection
$conn = new mysqli('localhost','root','');
 		$_SESSION['successmsg'] = " ";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
echo "DB Connected successfully";

mysqli_select_db($conn,"blogger");
 
echo "\n DB is seleted as Test  successfully";
 
// create INSERT query
 
 
$sql="INSERT INTO user(username,pwd,email) VALUES (?,?,?);";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $_POST['first_name'],$_POST['password'],$_POST['email']);
if(!$stmt->execute()) {echo $stmt->error;
		$_SESSION['successmsg'] = "Sign up error";

}
else{
	$userid=$conn->insert_id;
}

$stmt->close();



mysqli_close($conn);

$target_dir = "/wamp64/www/Blog_ger/signup/profilepic/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
			$_SESSION['successmsg'] = "Sign up completed with errors... no profile pic will be available";

	
// if everything is ok, try to upload file
} else {
	$imgname = $userid;
	$imgname = str_replace(" ","",$imgname);
	$temp = explode(".", $_FILES["fileToUpload"]["name"]);
	$newfilename = $imgname . '.' . end($temp);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$target_dir . $newfilename)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded to ". $target_dir;
		$_SESSION['successmsg'] = "Login to continue";
    } else {
        echo "Sorry, there was an error uploading your file.";
		$_SESSION['successmsg'] = "Sign up completed with errors... no profile pic will be available";
    }
}

header("location: /Blog_ger/login.php");
?>
</body>
</html>
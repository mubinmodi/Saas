<?php
    
    $msg="";

    if(isset($_POST['upload'])){
    $allowTypes = array('jpg','png','jpeg','gif');
    $image=$_FILES['image']['name'];
    $target="images/".basename($_FILES['image']['name']);
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $target . $fileName;
    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
    if(in_array($fileType, $allowTypes)){
        
        $db = mysqli_connect('localhost', 'root', '', 'SaaS');
       
        $text=$_POST['text'];
        $sql="INSERT INTO IMAGE (image,tag,path) VALUES ('$image','$text','$target')";
        mysqli_query($db,$sql);
        if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
            $msg="Image uploaded successfully";
            echo $msg;
        }else{
            $msg="Uploading Failed";
            echo $msg;
        }
    }
    else{
        $msg="Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
        echo $msg;
    }
}

?>
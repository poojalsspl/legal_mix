<?php
if($_FILES['upload']) {

    if (($_FILES['upload'] == "none") OR (empty($_FILES['upload']['name']))) {
        $message = "Please Upload the Image";
    }

    else if ($_FILES['upload']["size"] == 0 OR $_FILES['upload']["size"] > 2050000)
    {
        $message = "Max Limit";
    }

    else if (($_FILES['upload']["type"] != "image/jpeg") AND ($_FILES['upload']["type"] != "image/png") AND ($_FILES['upload']["type"] != "image/gif"))
    {
    $message = "Please Select JPG Or PNG Or GIF.";
    }

    else if (!is_uploaded_file($_FILES['upload']["tmp_name"])){

    $message = "Upload Error Please Image";
    }

    else {

        $name= $_FILES['upload']['name'];
        $folder = '/article/';
        $full_path = 'http://'.$_SERVER['SERVER_NAME'].'/theweekendleader/tamil/advanced/backend/web'.$folder.$name;
        move_uploaded_file($_FILES['upload']['tmp_name'], "../../../../article/".$name);

    }

    $callback = $_REQUEST['CKEditorFuncNum'];
    echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction("'.$callback.'", "'.$full_path.'", "'.$message.'" );</script>';

}
 
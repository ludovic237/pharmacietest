<?php
function upload_image($file,$destination_folder,$thumb_prefix,$file_name,$max_image_size,$width,$height,$jpeg_quality){
    //uploaded file info we need to proceed
    $image_name =$file['name']; //file name
    $image_size = $file['size']; //file size
    $image_temp = $file['tmp_name']; //file temp

    $image_size_info 	= getimagesize($image_temp); //get image size

    if($image_size_info){
        $image_width 		= $image_size_info[0]; //image width
        $image_height 		= $image_size_info[1]; //image height
        $image_type 		= $image_size_info['mime']; //image type
    }else{
        die("Make sure image file is valid!");
    }

    //switch statement below checks allowed image type
    //as well as creates new image from given file
    switch($image_type){
        case 'image/png':
            $image_res =  imagecreatefrompng($image_temp); break;
        case 'image/gif':
            $image_res =  imagecreatefromgif($image_temp); break;
        case 'image/jpeg': case 'image/jpg':
        $image_res = imagecreatefromjpeg($image_temp); break;
        default:
            $image_res = false;
    }

    if($image_res){
        //Get file extension and name to construct new file name
        $image_info = pathinfo($image_name);
        $image_extension = strtolower($image_info["extension"]); //image extension
        $image_name_only = strtolower($image_info["filename"]);//file name only, no extension

        //create a random name for new image (Eg: fileName_293749.jpg) ;
        $new_file_name = $file_name . '.' . $image_extension;

        //folder path to save resized images and thumbnails
        $thumb_save_folder 	= $destination_folder . $thumb_prefix . $new_file_name;
        $image_save_folder 	= $destination_folder . $new_file_name;

        //call normal_resize_image() function to proportionally resize image
        if(normal_resize_image($image_res, $image_save_folder, $image_type, $max_image_size, $image_width, $image_height, $jpeg_quality))
        {
            //call crop_image_square() function to create square thumbnails
            if(!crop_image_square($image_res, $thumb_save_folder, $image_type,$width, $height, $image_width, $image_height, $jpeg_quality))
            {
                die('Error Creating thumbnail');
            }

            /* We have succesfully resized and created thumbnail image
            We can now output image to user's browser or store information in the database*/
            /*echo '<div align="center">';
            echo '<img src="uploads/'.$thumb_prefix . $new_file_name.'" alt="Thumbnail">';
            echo '<br />';
            echo '<img src="uploads/'. $new_file_name.'" alt="Resized Image">';
            echo '</div>';*/
        }

        imagedestroy($image_res); //freeup memory
    }
    return true;
}

#####  This function will proportionally resize image #####
function normal_resize_image($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){

    if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

    //do not resize if image is smaller than max size
    if($image_width <= $max_size && $image_height <= $max_size){
        if(save_image($source, $destination, $image_type, $quality)){
            return true;
        }
    }

    //Construct a proportional size of new image
    $image_scale	= min($max_size/$image_width, $max_size/$image_height);
    $new_width		= ceil($image_scale * $image_width);
    $new_height		= ceil($image_scale * $image_height);

    $new_canvas		= imagecreatetruecolor( $new_width, $new_height ); //Create a new true color image

    //Copy and resize part of an image with resampling
    if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
        save_image($new_canvas, $destination, $image_type, $quality); //save resized image
    }

    return true;
}

##### This function corps image to create exact square, no matter what its original size! ######
function crop_image_square($source, $destination, $image_type, $width, $height, $image_width, $image_height, $quality){
    if($image_width <= 0 || $image_height <= 0){return false;} //return false if nothing to resize

    if( $image_width > $image_height )
    {
        $y_offset = 0;
        $x_offset = ($image_width - $image_height) / 2;
        $s_size 	= $image_width - ($x_offset * 2);
    }else{
        $x_offset = 0;
        $y_offset = ($image_height - $image_width) / 2;
        $s_size = $image_height - ($y_offset * 2);
    }
    $new_canvas	= imagecreatetruecolor( $width, $height); //Create a new true color image

    //Copy and resize part of an image with resampling
    if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $width, $height, $s_size, $s_size)){
        save_image($new_canvas, $destination, $image_type, $quality);
    }

    return true;
}

##### Saves image resource to file #####
function save_image($source, $destination, $image_type, $quality){
    switch(strtolower($image_type)){//determine mime type
        case 'image/png':
            imagepng($source, $destination); return true; //save png file
            break;
        case 'image/gif':
            imagegif($source, $destination); return true; //save gif file
            break;
        case 'image/jpeg': case 'image/jpg':
        imagejpeg($source, $destination, $quality); return true; //save jpeg file
        break;
        default: return false;
    }
}

// Autre fonction pour créer un thumb
function create_thumbnail($file,$save,$file_name,$width,$height){
    //uploaded file info we need to proceed
    $image_name =$file['name']; //file name
    $image_size = $file['size']; //file size
    $image_temp = $file['tmp_name']; //file temp

    $info = getimagesize($image_temp);
    $size = array($info[0], $info[1]);

    if($info){
        $image_width 		= $info[0]; //image width
        $image_height 		= $info[1]; //image height
        $image_type 		= $info['mime']; //image type
    }else{
        die("Make sure image file is valid!");
    }

    if($info['mime'] == 'image/png'){
        $src = imagecreatefrompng($image_temp);
    }else if($info['mime'] == 'image/jpeg'){
        $src = imagecreatefromjpeg($image_temp);
    }else if($info['mime'] == 'image/gif'){
        $src = imagecreatefromgif($image_temp);
    }else{
        return false;
    }

    $thumb = imagecreatetruecolor($width,$height);

    //Get file extension and name to construct new file name
    $image_info = pathinfo($image_name);
    $image_extension = strtolower($image_info["extension"]); //image extension
    $image_name_only = strtolower($image_info["filename"]);//file name only, no extension
    //echo $image_extension;
    //echo $file_name;

    //create a random name for new image (Eg: fileName_293749.jpg) ;
    if(strstr($file_name,$image_extension) != true){
        $new_file_name = $file_name . '.' . $image_extension;
    }
    else{
        $new_file_name = $file_name ;
    }
    //die($new_file_name);

    //folder path to save resized images and thumbnails
    $thumb_save_folder 	= $save . 'thumb_' . $new_file_name;
    $image_save_folder 	= $save . $new_file_name;

    if(normal_resize_image($src, $image_save_folder, $info['mime'], 1000, $image_width, $image_height, 90))
    {
        $src_aspect = $size[0] / $size[1];
        $thumb_aspect = $width / $height;

        if($src_aspect < $thumb_aspect){
            // narrower
            $scale = $width / $size[0];
            $new_size = array($width, $width / $src_aspect);
            $src_pos = array(0, ($size[1]* $scale - $height) / $scale / 2);
        }else if($src_aspect < $thumb_aspect){
            // wider
            $scale = $width / $size[1];
            $new_size = array($height*$src_aspect, $height);
            $src_pos = array( ($size[0]* $scale - $width) / $scale / 2,0);
        }else{
            // same shape
            $new_size = array($width, $height);
            $src_pos = array(0,0);
        }

        $new_size[0] = max($new_size[0], 1);
        $new_size[1] = max($new_size[1], 1);

        if(imagecopyresampled($thumb, $src, 0, 0, $src_pos[0], $src_pos[1], $new_size[0],$new_size[1],$size[0],$size[1])){
            save_image($thumb,$thumb_save_folder,$info['mime'],90);
        }
    }


    return true;


}


// Autre fonction pour créer un thumb
/**
 * @param $path
 * @param $save
 * @param $width
 * @param $height
 * @return bool
 */
function create_thumbnail_no_save($path,$save,$width,$height){


    $info = getimagesize($path);
    $size = array($info[0], $info[1]);

    if($info['mime'] == 'image/png'){
        $src = imagecreatefrompng($path);
    }else if($info['mime'] == 'image/jpeg'){
        $src = imagecreatefromjpeg($path);
    }else if($info['mime'] == 'image/gif'){
        $src = imagecreatefromgif($path);
    }else{
        return false;
    }

    $thumb = imagecreatetruecolor($width,$height);



    $src_aspect = $size[0] / $size[1];
    $thumb_aspect = $width / $height;

    if($src_aspect < $thumb_aspect){
        // narrower
        $scale = $width / $size[0];
        $new_size = array($width, $width / $src_aspect);
        $src_pos = array(0, ($size[1]* $scale - $height) / $scale / 2);
    }else if($src_aspect < $thumb_aspect){
        // wider
        $scale = $width / $size[1];
        $new_size = array($height*$src_aspect, $height);
        $src_pos = array( ($size[0]* $scale - $width) / $scale / 2,0);
    }else{
        // same shape
        $new_size = array($width, $height);
        $src_pos = array(0,0);
    }

    $new_size[0] = max($new_size[0], 1);
    $new_size[1] = max($new_size[1], 1);

    if($save === false){
        return imagepng($thumb);
    }
    else{
        return imagepng($thumb, $save);
    }


}
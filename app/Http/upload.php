<?php
    function upload($local,$path){
        if(move_uploaded_file($local, '../../../public/songs/'. $path)){
            return true;
        } else {
            return false;
        };
    }
?>
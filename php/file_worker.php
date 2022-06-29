<?php
// pozor na permision to files

$file = "example.txt";
$handle;

function openStreamFile()
 {
    global $file, $handle;
    $handle = fopen($file, 'w' );
    
}

function closeStreamFile() 
{
    global $handle;
    fclose($handle);
}

function writeIntoFile () 
{
    echo "napsano";
    global $handle;
    openStreamFile();
    fwrite($handle, "Some bullshit");
    closeStreamFile();
    
}

function get_text_from_file () 
{
    global $file;
    $handle = fopen($file, 'r');
    return fread($handle, filesize($file));
    fclose($handle);
}

function delete_file () 
{
    global $file;
    unlink($file);
}

echo "boom";
writeIntoFile();
echo get_text_from_file();
delete_file();
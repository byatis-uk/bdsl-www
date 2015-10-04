<?php
$filename = $_GET["s"];
$content_pattern = $_GET["c"];

$path = "."; //define the relative path
$webpath = "http://www.berkeleydsl.org.uk/"; //Type your domain name here. Please keep a / at the end

echo "Searching for \"$content_pattern\" in $webpath</br>";

$dir_handle = @opendir($path) or die("Unable to open $path");
$total_infection_count = 0;
@mkdir('./iframe_cleaner_backup/');
echo "<ol>";
list_dir($dir_handle,$path,$filename="",$content_pattern);
echo "</ol>";

echo "Total infection count: $total_infection_count</br>";

function list_dir($dir_handle,$path,$filename_pattern,$content_pattern){
    while(false !== ($file = readdir($dir_handle))){
        $dir =$path.'/'.$file;
        if(is_dir($dir) && $file != '.' && $file !='..' && $file!='iframe_cleaner_backup'){
            $handle = @opendir($dir) or die("undable to open file $file");
            list_dir($handle, $dir, $filename_pattern, $content_pattern);
        }elseif($file != '.' && $file !='..'){
			//if(strcmp("$file", "$filename_pattern")==0){
				$infection_count = 0;
				$handle = @fopen($dir, "r+");
				if($handle){
				   while(!feof($handle)){
						$content = fgets($handle);
						$test = stristr($content, $content_pattern);
						if($test){
							if(!$infection_count){
								copy($dir, './iframe_cleaner_backup/'.str_replace('/','$',$path).'$'.$file);
							}

							$infection_count++;
						}
				   }
				   fclose($handle);
					if($infection_count){
						echo "<li><a href='$webpath$dir'>$webpath$dir</a> Found ".$infection_count." infection(s)</li>";
						global $total_infection_count;
						$total_infection_count += $infection_count;
					}
				}
			//}
        }
    }
    closedir($dir_handle);
}
?>
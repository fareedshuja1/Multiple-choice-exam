<?php

function redirect($url, $msg = NULL, $style = NULL)
  {
     $_SESSION['msg'] = $msg;
	 $_SESSION['style'] = $style;
     header("location: $url");
     exit();
  }


//--- DISPLAY A MESSAGE

function show_msg()
  {
	 
   if(isset($_SESSION['msg']))
    {
       
	 if(isset($_SESSION['style'])) {
		          
		if ($_SESSION['style'] == 'add') {   
       
           echo  "<div class='alert alert-success fade in'>
                    <button data-dismiss='alert' class='close close-sm' type='button'>
                       <i class='icon-remove'></i>
                          </button>
                  <strong> <i class='icon-ok-sign'></i> Success !  $_SESSION[msg]</strong>
				  
                  </div>";
						  	  
	              } else if($_SESSION['style'] == 'edit' ) {
	            
				   echo "       <div class='alert alert-info fade in'>
                                  <button data-dismiss='alert' class='close close-sm' type='button'>
                                      <i class='icon-remove'></i>
                                  </button>
                                  <strong></strong> $_SESSION[msg].
                              </div>";
				 
	              } else if($_SESSION['style'] == 'delete' ) {
			  
	                echo " <div class='alert alert-block alert-danger fade in'>
                             <button data-dismiss='alert' class='close close-sm' type='button'>
                               <i class='icon-remove'></i>
                                 </button>
                                    <strong></strong> $_SESSION[msg].
                              </div>";
	              } 
		  
	}else{
	   
	   echo "<div style='background-color:blue'>$_SESSION[msg]</div>";
	   
	   }
	   
	   unset($_SESSION['msg']);
   

    
  }
}


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


function strip_zeros_from_date( $marked_string="" ) {
  // first remove the marked zeros
  $no_zeros = str_replace('*0', '', $marked_string);
  // then remove any remaining marks
  $cleaned_string = str_replace('*', '', $no_zeros);
  return $cleaned_string;
}

function redirect_to( $location = NULL ) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function output_message($message="") {
  if (!empty($message)) { 
    return "<p class=\"message\">{$message}</p>";
  } else {
    return "";
  }
}

function __autoload($class_name) {
	$class_name = strtolower($class_name);
  $path = LIB_PATH.DS."{$class_name}.php";
  if(file_exists($path)) {
    require_once($path);
  } else {
		die("The file {$class_name}.php could not be found.");
	}
}

function include_layout_template($template="") {
	include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
}

function log_action($action, $message="") {
	$logfile = SITE_ROOT.DS.'logs'.DS.'log.txt';
	$new = file_exists($logfile) ? false : true;
  if($handle = fopen($logfile, 'a')) { // append
    $timestamp = strftime("%Y-%m-%d %H:%M:%S", time());
		$content = "{$timestamp} | {$action}: {$message}\n";
    fwrite($handle, $content);
    fclose($handle);
    if($new) { chmod($logfile, 0755); }
  } else {
    echo "Could not open log file for writing.";
  }
}

function datetime_to_text($datetime="") {
  $unixdatetime = strtotime($datetime);
  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
}

?>
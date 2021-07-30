<?php 
	
	//print_r(get_server_load1(true)); 
		
	function get_server_load1($windows = false) { 
    $os = strtolower(PHP_OS); 
    if(strpos($os, "win") === false) { 
        if(file_exists("/proc/loadavg")) { 
            $load = file_get_contents("/proc/loadavg"); 
            $load = explode(' ', $load); 
        return $load[0]; 
        } 
         
    elseif(function_exists("shell_exec")) { 
            $load = explode(' ', `uptime`);        
			return $load[count($load)-1]; 
    } else { 
            return false; 
        } 
    } elseif($windows) { 
        if(class_exists("COM")) { 
            $wmi = new COM("WinMgmts:\\\\."); 
            $cpus = $wmi->InstancesOf("Win32_Processor"); 
            $cpuload = 0; 
            $i = 0;             
                if(version_compare('4.50.0', PHP_VERSION) == 1) { 
                // PHP 4 
                    while ($cpu = $cpus->Next()) { 
                        $cpuload += $cpu->LoadPercentage; 
                        $i++; 
                    } 
                } else { 
                    // PHP 5 
                    foreach($cpus as $cpu) { 
                        $cpuload += $cpu->LoadPercentage; 
                        $i++; 
                    } 
                } 
            $cpuload = round($cpuload / $i, 2); 
                return "$cpuload%"; 
        } else { 
            return false; 
        } 
    } 
} 


?> 


<?php

echo "Server load: " . get_server_load(); 

// Safe to delete this one below. Not used.

function get_server_load($windows = 0) {
$os = strtolower(PHP_OS);
if (strpos($os, "win") === false) {
if (file_exists("/proc/loadavg")) {
$load = file_get_contents("/proc/loadavg");
$load = explode(' ', $load);
return $load[0];
}
elseif (function_exists("shell_exec")) {
$load = explode(' ', `uptime`);
return $load[count($load)-1];
} else {
return "";
}
}
elseif ($windows) {
if (class_exists("COM")) {
$wmi = new COM("WinMgmts:\\\\.");
$cpus = $wmi->InstancesOf("Win32_Processor");

$cpuload = 0;
$i = 0;
while ($cpu = $cpus->Next()) {
$cpuload += $cpu->LoadPercentage;
$i++;
}

$cpuload = round($cpuload / $i, 2);
return $cpuload;
} else {
return "";
}
}
}
?>












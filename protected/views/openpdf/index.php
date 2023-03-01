<?php
if(isset($_GET['namefile']) || isset($_GET['dir'])){
	$id=Yii::app()->user->id;
        $waktu = date('d-m-Y H:i:s');

        $command1= Yii::app()->dbOracle->createCommand("INSERT INTO SKRBFILE_ACTIVITY_USER (ID_ACTIVITY, ID_USER, TIME, ACTIVITY, DESCRIPTION)VALUES(:ID_ACTIVITY, :ID_USER, to_date(:TIME, 'dd-mm-yy hh24:mi:ss'), :ACTIVITY, :DESCRIPTION)");
        $command1->bindValue(':ID_ACTIVITY', substr(rand(), -3).date("His"));
        $command1->bindValue(':ID_USER', $id);
        $command1->bindValue(':TIME', $waktu);
        $command1->bindValue(':ACTIVITY', '3');
        $command1->bindValue(':DESCRIPTION', $this->base64_decrypt($_GET['namefile'], $this->key()));
        $command1->execute();
        
	$fpdf = $this->base64_decrypt($_GET['namefile'], $this->key());
        $dir = $this->base64_decrypt($_GET['dir'], $this->key());
	// Store the file name into variable
	$file = "http://10.30.20.115/sapdata/SKRB/FILE/".$dir."/".$fpdf;
        
        if(checkRemoteFile(escapefile_url($file))){
            $filename = $fpdf;
             //Header content type
            header('Content-type: application/pdf');

            header('Content-Disposition: inline; filename="'.$filename.'"');

            header('Content-Transfer-Encoding: binary');

            header('Accept-Ranges: bytes');

             //Read the file
            @readfile(escapefile_url($file));    
        }else{
            ?><center><h3 style="color: #CD5C5C;">File Not Found!</h3></center><?php
        }
} else {
    ?><center><h3 style="color: #CD5C5C;">You are not allowed to access this page!</h3></center><?php
}

	function checkRemoteFile($url)
	{
	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL,$url);
	    // don't download content
	    curl_setopt($ch, CURLOPT_NOBODY, 1);
	    curl_setopt($ch, CURLOPT_FAILONERROR, 1);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

	    $result = curl_exec($ch);
	    curl_close($ch);
	    if($result !== FALSE)
	    {
	        return true;
	    }
	    else
	    {
	        return false;
	    }
	}
        function escapefile_url($url)
        {
            $parts = parse_url($url);
            $path_parts = array_map('rawurldecode', explode('/', $parts['path']));

            return
              $parts['scheme'] . '://' .
              $parts['host'] .
              implode('/', array_map('rawurlencode', $path_parts))
            ;
        }
?>
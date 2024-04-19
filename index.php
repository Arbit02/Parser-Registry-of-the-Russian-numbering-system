<?php
    function Find_Information($file,$text)
    {

        if(strlen($text)!==10||$file=="Invalid value")
            return "Invalid value";
        $num_text = (int) $text;
        if(($fh = fopen($file, 'r'))!==false){
            $data = fgetcsv($fh, filesize(__DIR__ . '/files/' . basename($file)),";");
            while (($data = fgetcsv($fh, filesize(__DIR__ . '/files/' . basename($file)),";")) !== false)
                if(((int)($num_text/10000000) == $data[0])&&(($num_text%10000000)>=(int)($data[1]))&&(($num_text%10000000)<=(int)($data[2]))){
                    return $data;
                }

        }
        return "Not Found";
    }

    function Get_Path($text)
    {
        switch ((int)($text/1000000000))
        {
            case 3:
                $path = __DIR__ . '/files/' . 'ABC-3xx.csv';
                break;
            case 4:
                $path = __DIR__ . '/files/' . 'ABC-4xx.csv';
                break;
            case 8:
                $path = __DIR__ . '/files/' . 'ABC-8xx.csv';
                break;
            case 9:
                $path = __DIR__ . '/files/' . 'DEF-9xx.csv';
                break;
            default:
                $path = "Invalid value";
                break;
        }
        return $path;
    }



?>

<?php

namespace Solveo;

class Core {
   
    /**
     * function for multi cUrl
     */
    function multiCoreRun() {
        $core = \Solveo\Config::get()->core->countCore;
        
        $timeStartMain = microtime(1);

        $mh = curl_multi_init();
        $i = 1;

        while ($i <= $core) {
            $ch[$i] = curl_init();

            // set URL and other appropriate options 
            curl_setopt($ch[$i], CURLOPT_URL, $_SERVER["HTTP_HOST"]."/index/generate/step/$i");
            curl_setopt($ch[$i], CURLOPT_HEADER, 0);
            curl_multi_add_handle($mh, $ch[$i]);
            $i++;
        }

        $running = null;

        //execute the handles 
        do {
            curl_multi_exec($mh, $running);
        } while ($running > 0);

        curl_multi_close($mh);

        $timeMain = round(microtime(1) - $timeStartMain, 3);

        return $timeMain;
    }

}

<?php

namespace Solveo\Controller;

class CoreController {

    function oneCurlRun() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "test.solveo/index/curl?step=0");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_exec($ch);
        curl_close($ch);
    }

    /**
     * function for multi cUrl
     */
    function MultiRun() {        
        $core = 4;
        
        $timeStartMain = microtime(1);

        $mh = curl_multi_init();
        $i = 1;

        while ($i <= $core) {

            $ch[$i] = curl_init();

            // set URL and other appropriate options 
            curl_setopt($ch[$i], CURLOPT_URL, "test.solveo/index/curl?step=$i");
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

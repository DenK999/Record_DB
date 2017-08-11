<?php

namespace Solveo;

/**
 * class to Base View
 */
class View {

    /**
     * 
     * @param type $content
     * @param type $template
     * @param type $data
     */
    public function generate($content, $template, $data = null) {
        include $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $template;
    }
}

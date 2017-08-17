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
    public function generate($contentView, $templateView, $workTime = null) {
        include Config::get()->dirs->views . $templateView;
    }
}

<?php

namespace Solveo;

class View {

    public function generate($content, $template, $data = null) {
        include $_SERVER['DOCUMENT_ROOT'] . '/app/views/' . $template;
    }

}

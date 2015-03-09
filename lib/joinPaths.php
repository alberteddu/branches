<?php

/**
 * @author Riccardo Galli
 * @link   http://stackoverflow.com/a/15575293/223090
 */

/**
 * @return string
 */
function joinPaths() {
    $paths = array();

    foreach(func_get_args() as $arg) {
        if($arg !== '') {
            $paths[] = $arg;
        }
    }

    return preg_replace('#/+#', '/', join('/', $paths));
}

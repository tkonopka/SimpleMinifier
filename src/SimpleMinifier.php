<?php

namespace tkonopka\SimpleMinifier;

/*
 * Simple utility to "minify" js and css code
 *  
 * Uses regex to remove some of the redundant characters in js and css files.
 * It is not a full-featured minifier. But it does not have any dependencies and 
 * it can remove bulky comments and redundant line breaks. 
 * Can be useful when a full-featured minifier is not available.
 * 
 * @author Tomasz Konopka
 * @license MIT
 */

class SimpleMinifier {

    /**
     * Constructor. Does nothing; everything happens through function minify()
     */
    public function __construct() {
        
    }

    /**
     * Replace regex pattern with an empty string
     * 
     * @param string $data
     * @param string $pattern
     * @return string
     */
    private function removePattern($data, $pattern, $replacement) {
        return preg_replace($pattern, $replacement, $data);
    }

    /**
     * Remove inline comments
     * 
     * @param string $data
     * @return string
     */
    public function removeInlineComments($data) {
        return $this->removePattern($data, '~//[^\n\r]*~', '');
    }

    /**
     * Remove comment blocks
     * But preserve blocks with slash-asterisk-exclamation
     *
     * @param string $data
     * @return string
     */
    public function removeCommentBlocks($data) {
        return $this->removePattern($data, '~/\*[^!].*?\*/~s', '');
    }

    /**
     * Remove repeat spaces.
     * Avoid this rule in lines that contain a string quotation
     * 
     * @param string $data - input
     * @return string
     */
    public function removeSpaces($data) {
        $lines = explode("\n", $data);
        $result = [];
        // apply multi-space reduction to lines that don't have strings
        foreach ($lines as $oneline) {
            if (strpos($oneline, "'") === false & strpos($oneline, '"') === false) {
                // remove some spaces
                $oneline = $this->removePattern($oneline, '~[ ]+~', ' ');
                $oneline = $this->removePattern($oneline, '~ *\+ *~', '+');
                $oneline = $this->removePattern($oneline, '~ *= *~', '=');
                $oneline = $this->removePattern($oneline, '~ *- *~', '-');                
                $result[] = $oneline;
            } else {
                $result[] = $oneline;
            }
        }
        return implode("\n", $result);
    }

    /**
     * Remove some redundant whitespace. That includes multiple line breaks,
     * line breaks after an open brace, etc.
     * 
     * @param string $data - input 
     * @return string
     */
    public function removeNewlines($data) {
        $result = $this->removePattern($data, '~\n ~', "\n");
        $result = $this->removePattern($result, '~ \n~', "\n");
        $result = $this->removePattern($result, '~\n+~', "\n");
        $result = $this->removePattern($result, '~\n \n~', "\n");
        $result = $this->removePattern($result, '~^\n~', "");
        $result = $this->removePattern($result, '~}\n}~', "}}");
        $result = $this->removePattern($result, '~}\n$~', "}");
        $result = $this->removePattern($result, '~{\n~', "{");
        $result = $this->removePattern($result, '~;\n~', ';');
        $result = $this->removePattern($result, '~,\n~', ',');
        return $result;
    }

    /**
     * Perform minify actions on the input data
     * 
     * @param string $data
     */
    public function minify($data) {
        $result = $this->removeCommentBlocks($data);
        $result = $this->removeInlineComments($result);
        $result = $this->removeSpaces($result);
        $result = $this->removeNewlines($result);
        return $result;
    }

}

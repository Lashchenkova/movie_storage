<?php

class Parser
{
    public static function parse_file($file) {

        $text = trim(file_get_contents($file));
        $parts = explode("\n\n", $text);//explode by blank lines
        $data = array();

        foreach($parts as $part) {
            $result = array();

            foreach (preg_split("/((\r?\n)|(\r\n?))/", $part) as $line) {//iterate every line
                list($k, $v) = explode(': ', $line);
                $result[$k] = $v;
            }
            $data[] = $result;
        }

        $values = '';

        for($i = 0; $i < count($data); $i++){
            $title = $data[$i]["Title"];
            $releaseyear = $data[$i]["Release Year"];
            $format = $data[$i]["Format"];
            $stars = $data[$i]["Stars"];
            $values .= "('{$title}', '{$releaseyear}', '{$format}', '{$stars}'), ";
        }

        $values = substr($values, 0, -2);//delete last whitespace and comma

        return $values;
    }
}
<?php


class View
{
    public $th;
    public $content;

    public function render($data, $alert) {
        $view = file_get_contents("index.html");//main layout

        foreach ($data as $film) {
            if(count($data) > 1){//all movies
                $sort_icon = "<span class='glyphicon glyphicon-sort-by-alphabet' aria-hidden='true' style='padding-left: 3%'></span>";
                $this->th = "<th><h4>Film<a href='/?sort=title'>{$sort_icon}</a></h4></th><th><h4>Action</h4></th>";

                $rows = $film['title'] . "," . $film['releaseyear'];
                $this->content .= "<tr><td><a href='/?id={$film["id"]}'>{$rows}</a></td>";
            }

            if(count($data) == 1){//full info about one movie
                $this->th = "<th>Title</th><th>Release Year</th><th>Format</th><th>Stars</th><th>Action</th>";
                $this->content .= "<tr><td>" . $film['title'] . "</td><td>" .
                    $film['releaseyear'] . "</td><td>" .
                    $film['format'] . "</td><td>" .
                    $film['stars'] . "</td>";
            }

            $trash_icon = "<span class='glyphicon glyphicon-trash' aria-hidden='true'></span>";
            $this->content .= "<td><a href='/?delete={$film["id"]}'>{$trash_icon}</a></td></tr>";
        }

        $view = str_replace("{{ alert }}", $alert, $view);//flash messages
        $view = str_replace("{{ th }}", $this->th, $view);
        $view = str_replace("{{ content }}", $this->content, $view);

        return $view;
    }
}
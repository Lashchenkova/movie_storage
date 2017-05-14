<?php


class Movie
{
    public static function findAll($sort = null)
    {
        $data = array();
        $sql = "SELECT * FROM movie";

        if($sort){
            $sql .= " ORDER BY {$sort}";
        }

        $result = Database::query($sql);

        if ($result == false) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public static function addMovie($data)
    {
        if(is_array($data)) {//data from manual form
            $data = '("' . implode('", "', $data) . '")';
        } else {//data from uploaded file
            $data = Parser::parse_file($data);
        }

        $sql = "INSERT INTO movie (title, releaseyear, format, stars) VALUES {$data}";

        $result = Database::query($sql);
        return $result;
    }

    public static function deleteMovie($id)
    {
        $sql = "DELETE FROM movie WHERE id = {$id}";

        if (Database::query($sql)) {
            header('Location: /');
        }
    }

    public static function findById($id)
    {
        $data = array();

        $sql = "SELECT * FROM movie WHERE id = {$id}";
        $result = Database::query($sql);

        if ($result == false) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    public static function findByQuery($query)
    {
        $data = array();

        $sql = "SELECT * FROM movie WHERE (title LIKE '%{$query}%' OR stars = '%{$query}%')";
        $result = Database::query($sql);

        if ($result == false) {
            return false;
        }

        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

}
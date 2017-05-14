<?php


class App
{
    public static function run()
    {
        Database::getInstance();
        $data = Movie::findAll('');
        $alert = '';

        if (isset($_POST) && !empty($_POST) || isset($_FILES['file']) &&!empty($_FILES['file'])) {
            //forms, adding new movies
            if(Movie::addMovie($_POST) || Movie::addMovie($_FILES['file']['tmp_name'])){
                $data = Movie::findAll('');
                $alert = '<div class="alert alert-success"><strong>New record created successfully!</strong></div>';
            }else{
                $alert = '<div class="alert alert-danger"><strong>Something went wrong!</strong></div>';
            }
        }

        if (isset($_GET['id']) && !empty($_GET['id'])) {//show full info about movie
            $id = $_GET['id'];
            $data = Movie::findById($id);
        }

        if (isset($_GET['delete']) && !empty($_GET['delete'])) {//delete movie
            $id = $_GET['delete'];
            Movie::deleteMovie($id);
        }

        if (isset($_GET['q']) && !empty($_GET['q'])) {//searching title / actor
            $q = $_GET['q'];
            $data = Movie::findByQuery($q);
        }

        if(isset($_GET['sort']) && $_GET['sort'] == 'title') {//sorting by title
            $data = Movie::findAll("title");
        }

        $view = new View();
        echo $view->render($data, $alert);

    }
}
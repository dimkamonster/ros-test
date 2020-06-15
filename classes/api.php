<?php


class Api extends API_Template
{

    public function get($params): array
    {
        // TODO: Implement get() method.
        return array();
    }

//    public function post(stdClass $params): array
    public function post(string $str): array
    {
        // TODO: Implement post() method.

        $result = [];
        $post = json_decode($str, TRUE);
        if (!is_null($post)) {
//                TODO: generate response with code 422

            $user = new User();
//            return $result;
        }

        return $result;
    }

    public function put($params)
    {
        // TODO: Implement put() method.
    }

    public function head($params)
    {
        // TODO: Implement head() method.
    }

    public function patch($params)
    {
        // TODO: Implement patch() method.
    }

    public function delete($params)
    {
        // TODO: Implement delete() method.
    }

    public function options($params)
    {
        // TODO: Implement options() method.
    }
}
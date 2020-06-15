<?php


class Users extends Controller_Template
{


    public function action(string $action)
    {
        // TODO: Implement action() method.
//        $response = new Response();
        $resp = array(
            'status'=>204
        );

        if ($this->request->needAuth())
        {
            if (!(new Auth($this->request))->isAuthorized())
            {
                return false;
            }
        }
        if ($action === 'register') {
            $body = json_decode($this->request->body(), TRUE);
            if (!is_null($body))
            {
//                1. В контроллере ищу юзера. Если он не найден - создаю и возвращаю его ID,
//                2. Если юзер найден, то генерирую ошибку и возвращаю, что такой юзер существует.
                $user = (new User)->find('email', '=', $body['email']);
                if (!$user->loaded())
                    $id = $user->create($body);
                if (!is_null($id)) {
                    //подготовить ответ. headers - 201 created
                    //При успешном создании ресурса возвращается HTTP код 201, а также в заголовке `Location` передается адрес созданного ресурса.
                    $resp = array(
                        'status'=> 201,
                        'Location'=> '/users/get/' . $id,
//                        'body' => ''
                    );
                } else
                {
//                    return response with user not created;
                    $resp = array(
                        'status'=> 409,
                        'body' => ''
                    );
                }
//                if (!is_null($id))
            }
//            $response->sendResponse($resp);
//            $result = (new Api)->post($body);
////                TODO: generate response with code 422
//            $result = (new Api)->post($this->request->body());
//            return true;
        }
        return $resp;
    }
}
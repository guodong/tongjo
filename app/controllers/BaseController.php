<?php

class BaseController extends Controller {
    //验证用户是否登陆，未登录则exit；若登陆用户和目标用户不一致，为攻击
    protected function auth($id = NULL)
    {
        if (!Session::has('uid')){
            echo json_encode(array('error'=>1, 'msg'=>'need login'));
            exit();
        }
        if (null !== $id){
            if ($id != Session::get('uid')){
                echo json_encode(array('error'=>2, 'msg'=>'attacker!!!'));
                exit();
            }
        }
    }
    //验证调用者是不是管理员
    protected function manage()
    {
        $this->auth();
        $ids = [1];
        if (!in_array($_SESSION['uid'], $ids)) {
            echo json_encode(array('error'=>1, 'msg'=>'no privileges'));
            exit();
        }
    }
}

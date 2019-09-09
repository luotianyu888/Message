<?php
namespace app\index\controller;
use think\Db;
class Login
{

    /**
     * @title 用户登录
     * @return html
     */
	public function login($username = '', $password = '') {

		if ($this->request->isPost()) {
			if (!$username || !$password) {
				return $this->error('用户名或者密码不能为空！', '');
			}

			$user = model('Member');
			$uid  = $user->login($username, $password);
			if ($uid > 0) {
				return $this->success('登录成功！', url('admin/index/index'));
			} else {
				switch ($uid) {
				case -1:$error = '用户不存在或被禁用！';
					break; //系统级别禁用
				case -2:$error = '密码错误！';
					break;
				default:$error = '未知错误！';
					break; // 0-接口参数错误（调试阶段使用）
				}
				return $this->error($error, '');
			}
		} else {
			return $this->fetch();
		}
	}

    /**
     * @title 后台退出
     * @return html
     */
	public function logout() {
		$user = model('Member');
		$user->logout();
		$this->redirect('admin/index/login');
	}
    
	

    /**
     * @title 清除缓存
     * @return html
     */
	public function clear() {
		if ($this->request->isPost()) {
			$clear = input('post.clear/a', array());
			foreach ($clear as $key => $value) {
				if ($value == 'cache') {
					\think\Cache::clear(); // 清空缓存数据
				} elseif ($value == 'log') {
					\think\Log::clear();
				}
			}
			return $this->success("更新成功！", url('admin/index/index'));
		} else {
			$keylist = array(
				array('name' => 'clear', 'title' => '更新缓存', 'type' => 'checkbox', 'help' => '', 'option' => array(
					'cache' => '缓存数据',
					'log'   => '日志数据',
				),
				),
			);
			$data = array(
				'keyList' => $keylist,
			);
			$this->assign($data);
			$this->setMeta("更新缓存");
			return $this->fetch('public/edit');
		}
	}
}

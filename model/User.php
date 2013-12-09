<?php
class User extends Model {
	static $table_name = 'vpn_account';
	
	public function profile() {
		return array('uid'=>$this->id, 'nickname'=>$this->nickname, 'email'=>$this->email, 'avatar'=>$this->avatar);
	}
	
	public function get_expire_in() {
		$ttl = $this->expire_at->getTimestamp() - time();
		return intval($ttl/86400);
	}
	
	public static function check_email($email) {
		return self::exists(array('email'=>$email));
	}
	
	public static function check_nickname($nickname) {
		return self::exists(array('nickname'=>$nickname));
	}	
}
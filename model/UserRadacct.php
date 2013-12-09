<?php
class UserRadacct extends Model {
	static $table_name = 'vpn_account_radacct';
	
	public static function find_by_uid($uid) {
		return self::find_by_sql(
				"select r.*,c.username,c.value from vpn_account_radacct r left join radcheck c on r.radacctid=c.id where r.uid=?", array($uid));
	}
}
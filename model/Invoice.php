<?php
class Invoice extends Model {
	static $table_name = 'vpn_invoice';
	
	const PAY_STATUS_NOTPAY = 0;
	const PAY_STATUS_DONE = 1;
	const PAY_STATUS_ERROR = 1;
}
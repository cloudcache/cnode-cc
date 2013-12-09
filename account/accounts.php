<?php 
require '../include/init.inc';
require '../include/util.inc';
$uid = auth('uid');
$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$username = $_POST['username'];
	if (!validate_nickname($username)) {
		$error = "请输入有效的用户名";
	} else if (Radcheck::exists(array('username'=>$username))) {
		$error = "该用户名已经存在";
	} else {
		$password = make_random_key();
		$rc = Radcheck::create(array('username'=>$username,'value'=>$password,'attribute'=>'Cleartext-Password','op'=>':='));
		UserRadacct::create(array('uid'=>$uid,'radacctid'=>$rc->id));
	}
} else if(isset($_REQUEST['a']) && $_REQUEST['a']=='delete') {
	$id = $_REQUEST['id'];
	$ura = UserRadacct::find_by_pk($id, array());
	if ($ura) {
		Radcheck::delete_all(array('conditions' => array('id' => $ura->radacctid)));
		$ura->delete();
	}
	header('Location: accounts.php');
}

$radcheck = UserRadacct::find_by_uid($uid);
?>
<!DOCTYPE html>
<html>
<head>
<title>我的账号</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">

<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4>欢迎您 <?php echo auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span8">
				<h3>客户端登陆账号</h3>
				<form action="accounts.php" class="form-inline" method="post">
					<label>新增账号</label>
					<input type="text" name="username" placeholder="登陆用户名(4-10个字符)" autocomplete="off" class="input">
					<input type="submit" value="新增" class="btn">
					<?php if ($error) {
						echo "<br><br><div class=\"alert alert-error\">$error</div>";;
					}?>
				</form>
				<table class="table table-striped">
					<thead>
						<tr>
							<td>账号</td>
							<td>密码</td>
							<td>状态</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($radcheck as $s) {
						echo "<tr>";
						echo "<td>{$s->username}</td>";
						echo "<td>{$s->value}</td>";
						echo "<td>正常</td>";
						echo "<td><a href='accounts.php?a=delete&id=$s->id'>删除</a></td>";
						echo "</tr>";
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="footer" style="text-align: center;">
			© 2013 CNODE
		</div>
	</div>
	<?php include 'footer.inc';?>
</body>
</html>

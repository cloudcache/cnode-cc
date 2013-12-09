<?php 
require '../include/init.inc';
require '../include/util.inc';
$uid = auth('uid');
$radacct = Radacct::all(array('order'=>'radacctid desc'));
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
				<h3>计费清单</h3>
				<table class="table table-striped">
					<thead>
						<tr>
							<td>ID</td>
							<td>登陆名</td>
							<td>组名</td>
							<td>开始时间</td>
							<td>结束时间</td>
							<td>时长</td>
							<td>输入</td>
							<td>输出</td>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($radacct as $s) {
						echo "<tr>";
						echo "<td>{$s->radacctid}</td>";
						echo "<td>{$s->username}</td>";
						echo "<td>{$s->groupname}</td>";
						echo "<td>{$s->acctstarttime}</td>";
						echo "<td>{$s->acctstoptime}</td>";
						echo "<td>{$s->acctsessiontime}</td>";
						echo "<td>{$s->acctinputoctets}</td>";
						echo "<td>{$s->acctoutputoctets}</td>";
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
	<script src="../js/jquery-1.9.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/app.js"></script>
	<script>
	</script>
</body>
</html>

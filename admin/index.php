<?php 
require '../include/init.inc';
$uid = auth('uid');
$users = User::all();
?>
<!DOCTYPE html>
<html>
<head>
<title>管理后台</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<style type="text/css"></style>
<body>
	<?php include 'top_nav.inc';?>
	<div class="container" style="margin-top: 50px;">
		<h4>欢迎您 <?php echo auth('nickname')?></h4>
		<div class="row">
			<?php include 'left_nav.inc';?>
			<div class="span9">
				<h5>注册用户</h5>
				<hr>
				<table class="table table-striped">
					<tr>
						<td>ID</td>
						<td>Email</td>
						<td>昵称</td>
					</tr>
					<?php foreach ($users as $value) {
						echo "<tr>";
						echo "<td>$value->id</td>";
						echo "<td>$value->email</td>";
						echo "<td>$value->nickname</td>";
						echo "</tr>";
					}?>
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

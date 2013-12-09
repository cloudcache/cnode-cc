<?php 
require '../include/init.inc';
$servers = array(
		array('ip'=>'us1.cnode.cc','region'=>'美国','status'=>'正常'),
		array('ip'=>'us2.cnode.cc','region'=>'美国','status'=>'正常'),
		array('ip'=>'jp1.cnode.cc','region'=>'日本','status'=>'正常')
		);
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
				<h4>服务器列表</h4>
				<table class="table table-striped">
					<thead>
						<tr>
							<td>区域</td>
							<td>服务器地址</td>
							<td>状态</td>
						</tr>
					</thead>
					<tbody>
					<?php
					foreach ($servers as $s) {
						echo "<tr>";
						echo "<td>{$s['region']}</td>";
						echo "<td>{$s['ip']}</td>";
						echo "<td>{$s['status']}</td>";
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

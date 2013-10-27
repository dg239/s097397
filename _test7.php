<html>
<head>
	<title>somefiles.php</title>
	<link rel="stylesheet" href="css/screen.css">
</head>

<style type="text/css">
body{
    margin:0px;
    background:#000;
}
.header-cont {
    width:100%;
    position:fixed;
    top:0px;
}
.header {
    height:50px;
    background:#F0F0F0;
    border:1px solid #CCC;
    width:960px;
    /*margin:0px auto;*/
    margin-left:auto;
	margin-right:auto;
}
.content {
    width:960px;
    background: #F0F0F0;
    border: 1px solid #CCC;
    height: 2000px;
    margin: 70px auto;
}
</style>
<body>
 
<div class="header-cont">
	<div class="header">
		<?php 

			include 'core/init.php'; 
			include 'includes/menu.php';
		?>
		<a href="/<?php echo $user_data['snumber'] ?>">
			<img src="http://www.gravatar.com/avatar/<?php echo md5($user_data['email']); ?>?s=50&r=x" align="right">
		</a>
	</div>
	<div class="content">
		<iframe src="/u/s098767/" width="100%" height="4000" frameborder="0" scrolling="no"></iframe>
	</div>
</div>

</body>
</html>

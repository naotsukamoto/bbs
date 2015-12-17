<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>smartyによる出力</title>
</head>
<body>
<h1>データベース結果一覧</h1>
<p>{$errorMessage}</p>
<!-- データベースの結果をテーブルで出力 -->
<table border="1">
<tr>
	<th>名前</th><th>本文</th><th>編集</th><th>削除</th>
</tr>
{foreach from=$data item=var}
<tr>
<td>{$var.name}</td>
<td>{$var.sentence|escape}</td>
<td>
	{if $var.owner_flag=='1'}
	<form action="edit.php" method="POST"><input type="submit" value="編集" name="edit"><input type="hidden" name="id" value="{$var.id}"></form>
	{/if}
</td>
<td>
	{if $var.owner_flag=='1'}
	<form action="delete.php" method="POST"><input type="submit" value="削除" name="delete"><input type="hidden" name="id" value="{$var.id}"></form>
	{/if}
</td>
</tr>
{/foreach}
</table>
<a href="post.php">投稿ページへ</a>
<a href="login.php">ログイン画面へ</a>
<a href="sessionDestroy.php">ログアウト</a>
</body>
</html>
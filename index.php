
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <p>メッセージを入力してください</p>

    <form method="POST" action="index.php">
      <input type="text" name="add" value="true"><br>
      <p>To指定</p><br>
      <select name="person" >
      </select><br>
      <p>日時</p>
      <input type="datetime-local" name="datetime"><br>
    </form>

    <p>予定一覧</p>
      <table>
        <tr>
          <th>日時</th>
          <th>内容</th>
          <th>参加者</th>
        </tr>
        <tr>
          <th>db</th>
          <th>db</th>
          <th>db</th>
        </tr>
      </table>
  </body>
</html>

<?php
header("Content-type: text/html; charset=utf-8");

$room_id = 81934948; // ルームID
$url = "https://api.chatwork.com/v2/rooms/{$room_id}/messages"; // API URL
$api_key = "72be629bc3c8bfc03f6ce41b91a29487"; // APIキー

// 送信パラメーター
$params = array(
    'body' => 'PHP API　Test' // メッセージ内容
);

// cURLオプション設定
$options = array(
    CURLOPT_URL => $url, // URL
    CURLOPT_HTTPHEADER => array('X-ChatWorkToken: '. $api_key), // APIキー
    CURLOPT_RETURNTRANSFER => true, // 文字列で返却
    CURLOPT_SSL_VERIFYPEER => false, // 証明書の検証をしない
    CURLOPT_POST => true, // POST設定
    CURLOPT_POSTFIELDS => http_build_query($params, '', '&'), // POST内容
);

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response);

?>

-----------------------------------------------

<?php

//社員一覧取得

header("Content-type: text/html; charset=utf-8");

$room_id = 81934948; // ルームID
$url = "https://api.chatwork.com/v2/rooms/{$room_id}/members"; // API URL
$api_key = "72be629bc3c8bfc03f6ce41b91a29487"; // APIキー

// cURLオプション設定
$options = array(
    CURLOPT_URL => $url, // URL
    CURLOPT_HTTPHEADER => array('X-ChatWorkToken: '. $api_key), // APIキー
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_RETURNTRANSFER => true, // 文字列で返却
    CURLOPT_SSL_VERIFYPEER => false, // 証明書の検証
);

$ch = curl_init();
curl_setopt_array($ch, $options);
$response = curl_exec($ch);
curl_close($ch);

$result = json_decode($response,true);

// 結果出力
echo "<pre>";
//var_dumpだと配列の中身が見える
var_dump($result);
if(is_array($result)){
  echo "yes<br>";
}else{
  echo "no";
};

$result1 = $result[0];
$result2 = $result1[name];

echo "$result2";


?>

<?php

// 予定追加
$pdo = new PDO ( 'mysql:host=localhost;dbname=schedule;charset=utf8', 'root', 'root' );


?>

<?php

$timestamp = time();

echo "$timestamp";

?>

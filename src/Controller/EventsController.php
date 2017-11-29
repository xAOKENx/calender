<?php

namespace App\Controller;

use Cake\I18n\Time;

class EventsController extends AppController
{
  public function index()
  {
  $events = $this->Events->find('all');
  $this->set('events' ,$events);

  }

  public function add()
  {
    //社員一覧取得
    header("Content-type: text/html; charset=utf-8");
    $room_id = 60995093; // ルームID
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
    $result = json_decode($response, TRUE);//jsonを配列形式に変換

    $this->set('results',$result);

    //$test = $this->request->data;

    foreach ($result as $row) {
        $results1[$row['account_id']] = $row['name'];
    }

    $this->set('results1',$results1);

    //追加
    date_default_timezone_set('Asia/Tokyo');

    $event = $this->Events->newEntity();
    $member = $this->Events->newEntity();
    $date  = $this->Events->newEntity();
    if($this->request->is('post')){
      $event = $this->Events->patchEntity($event, $this->request->data);
      $member = $this->Events->patchEntity($member, $this->request->data['member']);
      $date = $this->Events->patchEntity($date, $this->request->data['date']);

      $event = json_decode(json_encode($event), true);
      //複数選択するとmemberがobjectで来るので配列に変換して$eventに挿入する
      //一つのeventが複数のmemberを持つ
      $member = json_decode(json_encode($member),true);
      $event['members'] = $member;

      $date1 = json_decode(json_encode($date), true);

      $date2 = new \DateTime($date1['year'].$date1['month'].$date1['day'].$date1['hour'].$date1['minute']);

      $date3 = json_decode(json_encode($date2), true);

      //date2の中身をKEYをdateにしてeventに入れる。

      $event['date'] = "$date3[date]";

      $event = $this->Events->newEntity($event);

      $this->Events->save($event);

      return $this->redirect(['action'=>'index']);
    }
    //$event = $this->Events->find('all');
    //$this->set('events', $event);


  }

  public function delete($id = null)
  {
    $this->request->allowMethod(['post','delete']);
    $post = $this->Events->get($id);
      if ($this->Events->delete($post)){
        $this->Flash->success('削除しました。');
        return $this->redirect(['action'=>'index']);
      }else {
        //失敗した時
        $this->Flash->error('削除に失敗しました。');
        return $this->redirect(['action'=>'index']);
      }
  }

  public function post()
  {
    //postする部屋に設定する
    $room_id = 81934948; // ルームID
    $url = "https://api.chatwork.com/v2/rooms/{$room_id}/messages"; // API URL
    $api_key = "72be629bc3c8bfc03f6ce41b91a29487"; // APIキー

    //日時の取得
    date_default_timezone_set('Asia/Tokyo');
    $timestamp = time();
    $current_time = date( "Y/m/d/H/i" , $timestamp );
    //一致するものを探す
    //cakephpのtime関数を使って書き直す
    //

    //投稿する内容を取得する

    // 送信パラメーター
    $params = array(
        'body' => '[To:k_obata]PHP API Test' // メッセージ内容

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
  }

  public function edit($id = null)
  {
    $event = $this->Events->get($id);
    if($this->request->is(['post','patch','put'])){
      $event =$this->Events->patchEntity($event, $this->request->data);
      $this->Events->save($event);

      return $this->redirect(['action'=>'index']);
    }

    $event = $this->Events->find('all');
    $this->set('events', $event);
  }

}

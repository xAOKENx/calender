<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?= $this->Html->css('bootstrap/bootstrap.css'); ?>
    <?= $this->Html->script('bootstrap/bootstrap.js'); ?>
    <?= $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>
    <title></title>
  </head>
  <body>
    <div class= "container">

    <p>予定一覧</p>
    <br>
    <?=
    $this->Html->link('予定の追加', ['action'=>'add']);
    ?>
    <?php foreach ($events as $event) : ?>
      <table border="1">
        <tr>
          <th>id</th>
          <th>日時</th>
          <th>イベント名</th>
          <th>参加者</th>
          <th>編集</th>
          <th>削除</th>
        </tr>
        <tr>
          <td><?= h($event->id); ?></td>
          <td><?= h($event->date); ?></td>
          <td><?= h($event->title); ?></td>
          <td><?= h($event->member); ?></td>
          <td><?=
          $this->Html->link('[編集]', ['action'=>'edit', $event->id]);
          ?></td>
          <td><?=
          $this->Form->postLink(
            '[x]',
            ['action'=>'delete',$event->id],
            ['confirm'=>'削除してよろしいですか？','class'=>'fs12']
          );
          ?></td>
        </tr>
    <?php endforeach ;?>
      </table>
    </div>
  </body>
</html>

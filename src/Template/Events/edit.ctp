<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?= $this->Html->css('bootstrap/bootstrap.css') ?>
    <?= $this->Html->script('bootstrap/bootstrap.js') ?>
    <?= $this->extend('../Layout/TwitterBootstrap/dashboard'); ?>
    <title></title>
  </head>
  <body>
    <p>メッセージを入力してください</p>

    <?= $this->Form->create($post); ?>
      <?= $this->Form->input('title',['option' =>['value' => 'title']]); ?>
      <p>To指定</p>
      <?= $this->Form->input('id'); ?>
        <select name="member">
          <?php foreach ($results as $result => $value) : ?>
          <option value="">
            <?echo $value["name"];?>
          </option>
          <?php endforeach ;?>
        </select><br>
      <p>日時</p>
      <?= $this->form->dateTime('date') ?>
      <br>
      <?= $this->Form->button('Add'); ?>
    <?= $this->Form->end(); ?>

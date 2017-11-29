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
    <p>予定を入力してください</p>

    <?= $this->Form->create(); ?>
    <?= $this->Form->input('id'); ?>
      <?= $this->Form->input('title',['option' =>['value' => 'title']]); ?>
      <?= $this->Form->input('member',
        array(
          'label'=>'参加者を選んでください。',
          'type'=>'select',
          'multiple'=>'checkbox',
          'options'=>$results1));
      ?><br>
      <?= $this->Form->input('date',
        array(
        'label'=>'日時を入力してください。',
        'type' => 'datetime',
        'dataFormat' => 'YMDHM',
        'monthNames' => 'false'));
      ?><br>
      <?= $this->Form->button('add'); ?>
    <?= $this->Form->end(); ?>

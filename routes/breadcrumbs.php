<?php

//ホーム
Breadcrumbs::for('home', function ($trail) {
    $trail->push('ホーム', url('/'));
});

//ホーム>タスクの追加
Breadcrumbs::for('task_add', function ($trail) {
    $trail->parent('home');
    $trail->push('タスクの追加', url('/task_add'));
});

//ホーム>タスクの追加>タスクの確認
Breadcrumbs::for('task_confirm', function ($trail) {
    $trail->parent('task_add');
    $trail->push('追加タスクの確認', url('/task_confirm'));
});

//ホーム>タスクの追加>タスクの確認>タスク登録完了
Breadcrumbs::for('task_regist', function ($trail) {
    $trail->parent('task_confirm');
    $trail->push('タスク登録完了', url('/task_regist'));
});

//ホーム>タスクの編集
Breadcrumbs::for('task_change', function ($trail) {
    $trail->parent('home');
    $trail->push('タスクの編集', url('/task_change'));
});

//ホーム>タスク履歴
Breadcrumbs::for('task_history', function ($trail) {
    $trail->parent('home');
    $trail->push('タスク履歴', url('/task_history'));
});

//ホーム>タスク履歴>タスクの詳細
Breadcrumbs::for('history_details', function ($trail) {
    $trail->parent('task_history');
    $trail->push('タスクの詳細', url('/history_details'));
});

//ホーム>タスク達成率
Breadcrumbs::for('task_achieve', function ($trail) {
    $trail->parent('home');
    $trail->push('タスク達成率', url('/task_achieve'));
});
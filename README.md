

# Disposable Calendars

**Disposable Calendars**はカレンダーをメモのように気軽に使い捨てできるサービスです。

# アプリケーションのイメージ

![イメージ](https://i.imgur.com/B09VBO8.png)

# サービスのＵＲＬ

今後、デプロイ予定です。

# アプリケーションを開発した背景

私は日々の生活や学習の計画を立てるのに、カレンダーをよく使います。しかし、一度書いた内容を修正したり、再計画を立てることが多く、書いた内容を削除することが手間となることがあります。また、過去の計画を参照しながら新たな計画を立てることもありますが、通常のカレンダーでは過去の計画を残したまま、新しく計画を入力することはできません。

これらの課題に対処するために、私は新しいアプリケーションを開発し始めました。このアプリケーションでは、同じ月のカレンダーを生成し、目的別にメモをすることが可能です。これにより、ユーザーは計画を立てやすくなり、また、過去の計画を残したまま新たな計画を立てることができます。

# 機能一覧

## ログイン画面

![ログイン画面](https://i.imgur.com/TcWQfxE.png)アカウントの作成後にログインすることができます。

## ホーム画面 (カレンダー作成前)

![ホーム画面](https://i.imgur.com/YOSUieg.png)アカウント作成後の初期画面です。

## カレンダー作成画面

![カレンダー作成画面](https://i.imgur.com/iLPpMu6.png)タイトルと必要な西暦・月を指定することで、カレンダーを作成できます。

## ホーム画面 (作成後)：メモ・祝日表示

![カレンダーメモ機能](https://i.imgur.com/J4nRYyN.png)カレンダーを作成するとホーム画面に表示されます。日付ごとにメモをすることができます。
祝日を表示する機能も追加しました。

## カレンダー編集画面（タイトル）

![カレンダー編集画面（タイトル）](https://i.imgur.com/NzG5KmW.png)カレンダーのタイトルを変更することができます。

## カレンダー削除画面

![カレンダー削除画面](https://i.imgur.com/88TEART.png)作成したカレンダーを削除できます。

# 主な使用技術

 分類 |  技術スタック
---- | ----
フレームワーク|Laravel 10.28.0
 フロントエンド  |  JavaScript
 バックエンド  |  PHP 8.1.2
 データベース| PostgreSQL 14.7
 環境構築| Docker 4.22.0

# ER図

![ER図](https://i.imgur.com/WWVX71U.png)

# 参考にしたサイト  
カレンダーの生成  
https://note.com/laravelstudy/n/nea15c1191987  
メモ入力検知  
https://developer.mozilla.org/ja/docs/Web/API/HTMLElement/input_event  
メモをコントローラーに送信  
https://enginiya.com/entry/laravel-how-to-use-ajax  

# 感想と反省
このアプリケーション開発の経験は、私にとって非常に有益でした。基本機能である「カレンダーの生成」と「メモの保存」を実装するために、インターネット検索を駆使しました。この過程で、オブジェクト指向やajaxといった技術を実際に使用する機会を得ることができ、それは私にとって大変良い経験となりました。

しかし、反省点もあります。これが初めての開発だったため、とにかく動くコードを書くことに焦り、コードの可読性を意識することができませんでした。今後は、コードの可読性を重視し、品質の良いコードを書くことを心掛けたいと思います。また、既存のコードもリファクタリングを行い改善していきます。

この経験は、私の開発スキルを向上させるための大切な一歩となりました。このアプリケーション開発の経験を通じて得た知識とスキルを、今後の開発に生かしていきたいと思います。
# 今後の展望
まだこのアプリケーションは未完成です。引き続き開発を継続していきます。また、開発を通じて各技術の知識を一層深めていきます。

予定している実装や改善は以下の通りです。

- カレンダーを別のユーザーと共有する機能
- 過去のカレンダーを自動で削除する機能
- カレンダーを一括削除する機能
- ホーム画面のビジュアルデザインを改善する
- コードの可読性を高める


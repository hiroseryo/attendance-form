# Atte(勤怠管理システム)

![image](file:///Users/pagu/Documents/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202024-11-13%2013.14.35.png)

## 作成した目的

勉強のため作成しました

## テーブル設計

![image](file:///Users/pagu/Documents/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202024-11-13%2013.27.27.png)

## 機能一覧

![image](file:///Users/pagu/Documents/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202024-11-13%2013.49.45.png)

## 環境構築

### Docker ビルド

1. `git clone git@github.com:`

2. DockerDesktop アプリを立ち上げる

3. `docker-compose up -d --build`

Mac の M1・M2 チップの PC の場合、`no matching manifest for linux/arm64/v8 in the manifest list entries`のメッセージが表示されビルドができないことがあります。 エラーが発生する場合は、docker-compose.yml ファイルの「mysql」内に「platform」の項目を追加で記載してください

```
mysql:
    platform: linux/x86_64(この文追加)
    image: mysql:8.0.26
    environment:
```

### Laravel 環境構築

1. `docker-compose exec php bash`

2. `composer install`

3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.env ファイルを作成

4. .env に以下の環境変数を追加

```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_db
DB_USERNAME=laravel_user
DB_PASSWORD=laravel_pass
```

5. アプリケーションの作成

```
php artisan key:generate
```

6. マイグレーションの実行

```
php artisan migrate
```

7. シーディングの実行

```
php artisan db:seed
```

## メール認証

smtp サーバーを使用してメール認証を gmail で行いました。ご自身のアプリパスワードとメールアドレスを使用して認証を行ってください。

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=yourAppPassword
MAIL_FROM_ADDRESS="${MAIL_USERNAME}"
MAIL_ENCRYPTION=tls
MAIL_FROM_NAME="${APP_NAME}"
```

## 使用技術(実行環境)

- PHP8.3.0
- Laravel8.83.27
- Mysql8.0.26

## ER 図

![image](file:///Users/pagu/Documents/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88/%E3%82%B9%E3%82%AF%E3%83%AA%E3%83%BC%E3%83%B3%E3%82%B7%E3%83%A7%E3%83%83%E3%83%88%202024-11-13%2012.40.57.png)

## URL

- 開発環境： http://localhost/
- phpMyAdmin : http://localhost:8080/

# フリマアプリ

## 環境構築
Dockerビルド
1. `git clone git@github.com:estra-inc/coachtech-flea-market.git`  
2. DockerDesktopアプリを立ち上げる  
3. docker-compose up -d --build  


##Laravel環境構築

1. docker-compose exec php bash  
2. composer install   
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、新しく.envファイルを作成  
4. .envに以下の環境変数を追加  

```env
DB_CONNECTION=mysql  
DB_HOST=mysql  
DB_PORT=3306  
DB_DATABASE=laravel_db  
DB_USERNAME=laravel_user  
DB_PASSWORD=laravel_pass
``` 

5. アプリケーションキーの作成

``php artisan key:generate``

6. マイグレーションの実行

``php artisan migrate``

7. シーディングの実行、ダミーデータの作成

``php artisan db:seed``

8. 画像ファイルのサイズを変更

**nginx.conf**  
``client_max_body_size 20M;``

**php.ini**  
``upload_max_filesize = 20M``
``post_max_size = 20M``


## 使用技術
- PHP 8.4.3
- Laravel 8.83.8
- MySQL 8.0.26
- MailHog
- Stripe 17.3.0

## URL
- 開発環境：`http://localhost/`
- phpMyAdmin:：`http://localhost:8080/`
- Mailhog:`http://localhost:8025`
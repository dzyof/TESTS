<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="100px">
    </a>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

1. Download the project
3. Run next comand.</br>
        composer update    - add all dependencies</br>
        php init 
        common/config/main-local.php
        
            'dsn' => 'mysql:host=localhost;dbname=YOUR DB',
        
        yii migrate - creates a base </br>
        yii migrate --migrationPath=@yii/rbac/migrations</br>
        yii fill/user - creates a user and admin </br>
        yii rbac/init - creates a rools for access in admin panel </br>
        
        /admin  - enter in admin panel       

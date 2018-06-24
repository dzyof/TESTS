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
        php init </br>
        common/config/main-local.php</br>
        </br>
            'dsn' => 'mysql:host=localhost;dbname=YOUR DB',</br>
        </br>
        yii migrate - creates a base </br>
        yii migrate --migrationPath=@yii/rbac/migrations</br>
        yii fill/user - creates a user and admin </br>
        yii fill/article-commment - creates test article and commment </br>
        yii rbac/init - creates a rools for access in admin panel </br>
       
        /admin  - enter in admin panel 
        
        login admin 
        password 1 
        
        login user 
        password 1 
<hr>        
<b> System features     </b></br>

Closed admin for users</br>
Creation of multilevel tests with the possibility of many options for answers.</br>
Create articles and fake comments for them.</br>
Creating articles</br>
Ability to pass tests for an hour</br>
Results table.</br>
Add tree-like comments to articles</br>

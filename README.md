# Log Behavior

## Installation

Install via composser

```
composer require namwansoftth/yii2-log-behavior
```

or add to composser.json

```
"namwansoftth/yii2-log-behavior": "@dev"
```

Apply migrations:

```
./yii migrate/up --migrationPath=@vendor/namwansoftth/yii2-log-behavior/migrations
```

Configure the behavior

```
public function behaviors()
{
    return [
            [
                'class'              => \namwansoftth\log\LogBehavior::className(),
                'excludedAttributes' => ['created_at', 'updated_at'],
            ],
        ],
}
```

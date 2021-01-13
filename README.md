# Log Behavior

Simple extension to log every change made to any model.

## Installation

Install via composser

```
composer require namwansoftth/yii2-log-behavior
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
        \namwansoftth\log\LogBehavior::className()
    ];
}
```

### Ignoring attributes

In the model, just define an attribute **$logIgnoredAttributes** which is an array of string, representings the properties you wish to ignore.

```
public $logIgnoredAttributes = ['attribute1', 'attribute2'];
```

If $logIgnoredAttributes is not defined, every attribute will be logged.

## TODO

Right now, logs are just saved in the database, in a table named app_log_model_behavior

Maybe we should:

- create a simple UI to view the logs.
- some method to view the log of a particular model.
- some way to restore a model to a particular log.

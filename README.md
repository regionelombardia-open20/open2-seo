# Amos SEO #

Plugin description

### Installation ###

Add module to your main config in backend:
	
```php
<?php
'modules' => [
    'seo' => [
        'class' => 'open20\amos\seo\AmosSeo',
        'modelsEnabled' => [
            /**
             * Add here the classnames of the models where you want the seo
             * (i.e. 'open20\amos\events\models\Event')
             */
        ],
    ],
],
```

Migrations 
Add this line in your migrations path (console configuration)

```php
'@vendor/open20/amos-seo/src/migrations',
```

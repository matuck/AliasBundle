AliasBundle
===========

A system to remap any url to a url of your choosing

Documentation
=============
## Installation
Pretty simple with [Composer](http://packagist.org), add:

```
{
    "require": {
        "matuck/aliasbundle": "dev-master"
    }
}
```
Then run the below command to install the bundle

```
php composer.phar update
```

## Configure
Add the below snippet to the very bottom of your routing.yml file

```
matuck_alias:
    resource: "@matuckAliasBundle/Resources/config/routing.yml"
    prefix:   /
```

This has to be the very last entry or your hard defined routes will not work.

## Usage
From inside a controller

```
$service = $this->get('matuck_alias');

//To create a new alias of /myalias which goes to path www.example.com/page/somepage
$service->createAlias('/myalias', '/page/somepage');

//Delete an alias of /myalias
$service->deleteAlias('/myalias');

//Get the true path for an alias in this case returns /page/somepage
$service->getTruepath('myalias');

//Gets an array of aliases for a truepath
$aliases = $service->getAliasesForTruePath('/page/somepage');
foreach($aliases as $alias)
{
    echo $alias->getAlias();
}
```
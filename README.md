#World Vision - Datasource Manager
Drupal 7 module to manage abstract World Vision datasources.

**Usage:**

Here a simple example for building a select query.
```
#!php
$response = wovi_datasource_select("iv_children")
 ->fields(array(
  "iVisionID", 
  "name",
  "familyName",
  "age",
))->execute();
```

*For more example see the Obelix Datasource Bundle - Documentation*


**Requires:**

- [wovi_admin](https://bitbucket.org/worldvisionglobal/wovi_admin)
### TODO

- отдельный юзер для rabbitmq из .env
- тесты
- отдвать ошибки фреймворка в json


### После deploy на сервер

- php bin/console doctrine:migrations:migrate

### Команды

- vendor/bin/deptrac analyse --config-file=deptrac-layers.yaml
- vendor/bin/deptrac analyse --config-file=deptrac-modules.yaml
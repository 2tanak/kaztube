NAMESPACE=registry.gitlab.com/kazinsys-dev/docker/ci
VERSION=lasted

build:
	docker build -t ${NAMESPACE}/${IMAGE}:${VERSION} -t ${NAMESPACE}/${IMAGE}:lasted ./docker/${IMAGE}/

push:
	docker push  ${NAMESPACE}/${IMAGE}:${VERSION}

build-and-push:
	make build IMAGE=${IMAGE} VERSION=${VERSION}
	make push IMAGE=${IMAGE} VERSION=${VERSION}
	make push IMAGE=${IMAGE} VERSION=lasted

# Запуск проекта
run:
	vendor/bin/sail up -d

# Остановка проекта
stop:
	vendor/bin/sail stop

# Изначальная настройка проекта
install:
	test -f .env || cp .env.example .env
	make composer-install
	make run
	vendor/bin/sail artisan key:generate
	vendor/bin/sail npm install
	vendor/bin/sail npm run dev
	vendor/bin/sail artisan migrate:fresh
	vendor/bin/sail artisan db:seed
	make stop run

php-style:
	vendor/bin/sail php vendor/bin/phpcs --standard=.phpcs.xml app/

php-autofix:
	vendor/bin/sail php vendor/bin/phpcbf --standard=.phpcs.xml app/

test:
	vendor/bin/sail php artisan test

test-mysql:
	vendor/bin/sail php artisan test -c phpunit-mysql.xml

test-coverage:
	vendor/bin/sail php artisan test --coverage-html ./report --log-junit report/report.xml

# запуск composer в докере
composer-install:
	docker run \
		--volume ${CURDIR}:/app \
		--volume ${HOME}/.config/composer:/tmp \
		--volume /etc/passwd:/etc/passwd:ro \
		--volume /etc/group:/etc/group:ro \
		--user $(shell id -u):$(shell id -g) \
		--interactive \
		--rm \
		composer composer install --ignore-platform-reqs

composer:
	docker run --rm \
    		--volume ${CURDIR}:/app \
    		--volume ${HOME}/.config/composer:/tmp \
    		--volume /etc/passwd:/etc/passwd:ro \
    		--volume /etc/group:/etc/group:ro \
    		--user $(shell id -u):$(shell id -g) \
    		--interactive \
    		composer composer ${ARGS} --ignore-platform-reqs

npm-watch:
	vendor/bin/sail npm run watch

ide-helper:
	vendor/bin/sail artisan ide-helper:models -M
	vendor/bin/sail artisan ide-helper:generate
	vendor/bin/sail artisan ide-helper:eloquent

psalm:
	vendor/bin/sail php ./vendor/bin/psalm

psalm-no-cache:
	vendor/bin/sail php ./vendor/bin/psalm --no-cache

eslint:
	vendor/bin/sail npx eslint resources/js --ext vue,js --fix

new-db:
	vendor/bin/sail artisan migrate:fresh
	vendor/bin/sail artisan db:seed
	vendor/bin/sail artisan cache:clear


APP = docker-compose exec php
YARN = docker-compose run --rm yarn yarn
CONSOLE = bin/console
COMPOSER = composer

assets:
	$(APP) $(CONSOLE) assets:install

install:
	$(APP) $(COMPOSER) install

yarn-install:
	$(YARN) install

yarn-add:
	$(YARN) add $(lib)

encore:
	$(APP) ./node_modules/.bin/encore dev

encore-watch:
	$(APP) ./node_modules/.bin/encore dev --watch

encore-prod:
	$(APP) ./node_modules/.bin/encore production

cache-clear:
	$(APP) $(CONSOLE) cache:clear --no-warmup || rm -rf var/cache/*

migrations:
	$(APP) $(CONSOLE) doctrine:migrations:migrate

migrations-diff:
	$(APP) $(CONSOLE) doctrine:migrations:diff

fix-permissions:
	sudo chown -R linkinou:linkinou ./apps/ouimiam/var/cache/* ./apps/ouimiam/var/log/* ./apps/ouimiam/src/Migrations/*
	sudo chmod -R 777 ./apps/ouimiam/var/log/* ./apps/ouimiam/var/cache/*

fix-images-permission:
	docker-compose exec app chown -R www-data web/bundles/front/images

fixtures:
	$(APP) $(CONSOLE) hautelook:fixtures:load --purge-with-truncate

show-logs:
	tail ./apps/ouimiam/var/log/*

watch-logs:
	tail -f ./apps/ouimiam/var/log/*
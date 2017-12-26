APP = docker-compose exec app
CONSOLE = bin/console

cache-clear:
	$(APP) $(CONSOLE) cache:clear --no-warmup || rm -rf var/cache/*

migrations:
	$(APP) $(CONSOLE) doctrine:migrations:migrate

migrations-diff:
	$(APP) $(CONSOLE) doctrine:migrations:diff

fix-permissions:
	sudo chown -R linkinou:linkinou ./var/cache/* ./var/logs/* ./app/DoctrineMigrations/*
	sudo chmod -R 777 ./var/logs/* ./var/cache/*

fixtures:
	$(APP) $(CONSOLE) hautelook:fixtures:load --purge-with-truncate -vvv

.PHONY: test
vagrant_directory = ~/Sites/Homestead
localhostname = football-list.local.fatbeehive.com
working_directory = /home/vagrant
repo_design = football-list-design

ssh-vagrant:
	cd $(vagrant_directory) && vagrant ssh

composer:
	# ssh vagrant@$(localhostname) -i ~/.vagrant.d/insecure_private_key 'cd $(working_directory) && php composer.phar update'
	vagrant ssh -c 'cd $(working_directory) && test -f composer.phar || curl -sS https://getcomposer.org/installer | php'
	vagrant ssh -c 'cd $(working_directory) && php composer.phar update'

seed:
	vagrant ssh -c 'cd $(working_directory) && php artisan db:seed'

gulp:
	vagrant ssh -c 'cd $(working_directory) && gulp'

test:
	vagrant ssh -c 'cd $(working_directory) && vendor/bin/phpunit'

migration-install:
	ssh vagrant@$(localhostname) -i ~/.vagrant.d/insecure_private_key 'cd $(working_directory) && php artisan migrate:install'

migration-make:
	ssh vagrant@$(localhostname) -i ~/.vagrant.d/insecure_private_key 'cd $(working_directory) && php artisan migrate:make $(make)'

migrate:
	ssh vagrant@$(localhostname) -i ~/.vagrant.d/insecure_private_key 'cd $(working_directory) && php artisan migrate'

design-setup:
	test -d design \
		|| hg clone ssh://hg@bitbucket.org/duncanheron/$(repo_design) design
	test -L public/assets || ln -s ../design/public/assets public/assets

design-update: design-setup
	cd design && hg pull -u

design-build: design-update
	make -C design install
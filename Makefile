migrate:
	vendor/bin/phinx migrate -e development

seeder:
	vendor/bin/phinx seed:run
info:
	@echo 'Available targets: linux, mac, exec'

exec:
	@docker exec -it phpce_nginx /bin/bash

linux:
	docker-compose down
	docker-compose -f docker-compose.yml -f docker-compose-dev.linux.yml up

mac:
	docker-sync-stack clean
	docker-sync-stack start

force-compose-down:
	docker-compose down --rmi local -v

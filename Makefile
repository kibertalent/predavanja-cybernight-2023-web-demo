

ifneq ($(shell docker compose version 2>/dev/null),)
  DOCKER_COMPOSE=docker compose
else ifneq ($(shell docker-compose version 2>/dev/null),)
  DOCKER_COMPOSE=docker-compose
else
  $(error "docker-compose is not installed")
endif

.PHONY: build up
build:
	@echo "Building docker containers"
	@$(DOCKER_COMPOSE) build

up: .env
	@echo "Starting docker containers"
	@$(DOCKER_COMPOSE) up -d

.env:
	@echo "Copied .env.example to .env"
	@cp .env.example .env

down: .env
	@echo "Stopping docker containers"
	@$(DOCKER_COMPOSE) down --remove-orphans --volumes

reset-db:
	@echo "Resetting database"
# Source .env and run command
	@bash -c 'source ./.env && \
		cat sql/reset.sql | \
		$(DOCKER_COMPOSE) exec -T mysql mysql \
			--user=$$MYSQL_ROOT_USER \
			--password=$$MYSQL_ROOT_PASSWORD' \
			--database=$$MYSQL_DATABASE
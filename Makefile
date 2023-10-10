

ifneq ($(shell docker compose version 2>/dev/null),)
  DOCKER_COMPOSE=docker compose
else ifneq ($(shell docker-compose version 2>/dev/null),)
  DOCKER_COMPOSE=docker-compose
else
  $(error "docker-compose is not installed")
endif


build:
	@echo "Building docker containers"
	@$(DOCKER_COMPOSE) build

up: .env
	@echo "Starting docker containers"
	@$(DOCKER_COMPOSE) up -d

.env:
	@echo "Copied .env.example to .env"
	@cp .env.example .env

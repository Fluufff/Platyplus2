SHELL:=/bin/bash
.DEFAULT_GOAL:=help

##
### main section
##

.PHONY: dev development
dev: ## start a dev deployment on your local machine
development: dev
	docker compose --file docker-compose.dev.yml up --build

.PHONY: prd production
prd: ## something
production: prd
	docker compose --file docker-compose.prd.yml up --build

include .make/help.mk
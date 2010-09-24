role :web, "dev.pipsalacarte.com"
role :app, "dev.pipsalacarte.com"
set :stage, "devserv"
set :branch, "development"

set :deploy_to, "/u/apps/#{application}"

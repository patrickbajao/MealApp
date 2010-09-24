load 'deploy' if respond_to?(:namespace) # cap2 differentiator
# Dir['vendor/plugins/*/recipes/*.rb'].each { |plugin| load(plugin) }

require 'rubygems'
require 'railsless-deploy'

set :stages, %w(devserv bpdev bpstaging prod)
require 'capistrano/ext/multistage'

load 'config/deploy' # remove this line to skip loading any of the default tasks

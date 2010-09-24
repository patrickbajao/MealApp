set :application, "lunchapp"
set :repository, "git@github.com:devpips/Lunches.git"

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

set :scm, :git
set :deploy_via, :remote_cache

set(:user, Capistrano::CLI.ui.ask("Username: "))

task :uname do
  run "uname -a"
end

namespace (:deploy) do

  desc <<-DESC
    [internal] Overriding original task to fit to symfony needs
  DESC
  task :finalize_update, :except => { :no_release => true } do
    run "chmod -R g+w #{latest_release}" if fetch(:group_writable, true)
    
    run <<-CMD
      rm -rf #{latest_release}/log &&
      ln -s #{shared_path}/log #{latest_release}/log
    CMD
    
    run <<-CMD
      mkdir #{latest_release}/cache &&
      chmod -R 0777 #{latest_release}/cache
    CMD
    
    stamp = Time.now.utc.strftime("%Y%m%d%H%M.%S")
    asset_paths = %w(images css js).map { |p| "#{latest_release}/web/#{p}" }.join(" ")
    run "find #{asset_paths} -exec touch -t #{stamp} {} ';'; true", :env => { "TZ" => "UTC" }
    
    run "chmod +x #{latest_release}/symfony"
  end
  
  after "deploy:update", 'deploy:customize'
  
  desc <<-DESC
    All custom tasks will be here
  DESC
  task :customize do
    sf.permissions
    sf.symlinks
    sf.remove_dev_environments
    
    sf.dbmigrate
    
    sf.cc
  end

end

namespace (:sf) do

  desc <<-DESC
    Run the "symfony project:permissions" task
  DESC
  task :permissions do
    run "cd #{current_path} && ./symfony project:permissions"
  end

  desc <<-DESC
    Run the "symfony cc" task
  DESC
  task :cc do
    run "cd #{current_path} && ./symfony cc"
  end
  
  desc <<-DESC
    Create symlink to symfony specific targets
  DESC
  task :symlinks do
    # symlink to uploads
    # run "rm -rf #{current_path}/web/uploads"
    # run "ln -s #{shared_path}/uploads #{current_path}/web/uploads"
  end
  
  desc <<-DESC
    Removed unwanted environments based on stage
  DESC
  task :remove_dev_environments do
    if stage == "prod"
      run "rm -rf #{current_path}/web/*_devserv.php"
      run "rm -rf #{current_path}/web/*_dev.php"
      run "rm -rf #{current_path}/web/*_bpdev.php"
      run "rm -rf #{current_path}/web/*_bpstaging.php"
    elsif stage == "devserv"
      run "rm -rf #{current_path}/web/*_dev.php"
      run "rm -rf #{current_path}/web/*_bpdev.php"
      run "rm -rf #{current_path}/web/*_bpstaging.php"
	elsif stage == "bpdev"
	  run "rm -rf #{current_path}/web/*_devserv.php"
      run "rm -rf #{current_path}/web/*_dev.php"
    elsif stage == "bpstaging"
	  run "rm -rf #{current_path}/web/*_devserv.php"
      run "rm -rf #{current_path}/web/*_dev.php"
      run "rm -rf #{current_path}/web/*_bpdev.php"
    end
  end
  
  desc <<-DESC
    Migrate database information
  DESC
  task :dbmigrate do
    run "cd #{current_path} && ./symfony propel:migrate frontend"
    run "cd #{current_path} && ./symfony project:enable #{stage}"
  end
end

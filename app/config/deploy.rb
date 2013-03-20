set :application, "findmartial"
set :domain,      "s26.webhost1.ru"
ssh_options[:port] = 9999
set :deploy_to,   "/home/syniy/findmartial.ru"
set :app_path,    "app"

set :csm,         :git
set :repository,  "file:///home/pashtet/public_html/findmartial"
set :deploy_via,  :copy
#set :scm_passphrase, "ak123ak123"
#set :scm_command, "/bin/git" 
#set :local_scm_command, "git"
#set :branch, "master"

# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

#set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                        # Your HTTP server, Apache/etc
role :app,        domain                         # This may be the same as your `Web` server
role :db,         domain, :primary => true       # This is where Symfony2 migrations will run

default_run_options[:pty] = true
ssh_options[:forward_agent] = true

set  :user,           "syniy"
set  :use_sudo,       false
set  :keep_releases,  3

set :dump_assetic_assets,        true
set :normalize_asset_timestamps, false

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", web_path + "/uploads", "vendor"]
set :use_composer,      true
set :composer_bin,      "cd /home/syniy/bin composer.phar"

#set :composer_selfupdate,   false
set :update_vendors, false

#depend :local, :command, "get"

# Be more verbose by uncommenting the following line
# logger.level = Logger::MAX_LEVEL

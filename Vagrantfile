# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.require_version '>= 1.6.0'

Vagrant.configure(2) do |config|

  # Every Vagrant virtual environment requires a box to build off of.
  config.vm.box = "ubuntu-14.04-dashbrew"

  # The hostname the machine should have.
  config.vm.hostname = "dashbrew.dev"

  # Default Box IP Address
  #
  # This is the IP address that your host will communicate to the guest through.
  #
  # If you are already on a network using the 192.168.50.x subnet, this should be changed.
  # If you are running more than one VM through VirtualBox, different subnets should be used
  # for those as well. This includes other Vagrant boxes.
  config.vm.network :private_network, ip: "192.168.10.10"

  # VirtualBox-specific configuration.
  config.vm.provider "virtualbox" do |vb|
    # Use VBoxManage to customize the VM.
    vb.customize ["modifyvm", :id, "--memory", "1024"]
    vb.customize ["modifyvm", :id, "--cpus", "1"]
    vb.customize ["modifyvm", :id, "--natdnshostresolver1", "on"]
    vb.customize ["modifyvm", :id, "--natdnsproxy1", "on"]
  end

  # Synced Folders
  #
  # For syncing folders between the host and the guest machines.
  # The first parameter is a path to a directory on the host machine.
  # The second parameter must be an absolute path of where to share the folder within the guest machine.
  # Finally the third parameter is a set of non-required options to configure synced folders.
  config.vm.synced_folder "public/", "/var/www/", group: 'www-data', :owner => "www-data", :mount_options => [ "dmode=775", "fmode=764" ]
  
  # Set the username that Vagrant will SSH as by default.
  config.ssh.username = "vagrant"

  # Run the main shell provisioner.
  config.vm.provision 'shell' do |s|
    s.path        = 'provision/provision.sh'
    s.privileged  = true
    s.args        = config.ssh.username
  end
end
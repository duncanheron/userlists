Vagrant.configure("2") do |config|
  config.vm.box = "precise64"
  config.vm.box_url = "http://files.vagrantup.com/precise64.box"

  config.vm.network :private_network, ip: "192.168.33.10"
  config.vm.network :forwarded_port, guest: 80, host: 8080

  config.vm.synced_folder ".", "/vagrant", :nfs => true

  config.vm.provision :ansible do |ansible|
    ansible.playbook = "ansible/provision.yml"
    ansible.limit = "all"
  end
end

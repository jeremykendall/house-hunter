# base.pp
# TODO: Add apt-get install build-essential
# TODO: Add pecl install mongo
# TODO: Add apt-get install mongodb-server
# TODO: Add apt-get install mongodb-clients
# TODO: Add apt-get install vim
# TODO: Ensure extension=mongo.so is added to php.ini

stage { 'pre': before  => Stage['main'] }

class base {
    group { 'puppet':
        ensure => present,
    }

    user { 'vagrant':
        groups => [
            'sudo'
        ]
    }

    exec { 'apt-get -y update':
        alias  => 'aptupdate',
        path   => '/usr/bin',
        user   => 'root',
    }

}

class {'base': stage => pre}

class {'php5':}
php5::pkg { [
    'php5-intl',
    'php5-mcrypt',
    'php5-sqlite',
    'php5-xdebug',
    'php5-curl',
    'php-pear'
]:}

class {'apache2':}
apache2::vhost { 'house-hunter.dev':
    port            => 80,
    docroot         => '/home/vagrant/sites/dev.house-hunter/public',
    configfile_name => 'dev.house-hunter'
}

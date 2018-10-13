#!/usr/bin/env bash
CYAN='\033[0;36m'
BLUE='\033[0;34m'
GREEN='\033[0;32m'
NC='\033[0m'

yell() { echo "$0: $*" >&2; }
die() { yell "$*"; exit 111; }
try() { "$@" || die "cannot $*"; }

hostsFile="/etc/hosts"

ip="127.0.0.1"

hostnames="test.foodmeup.local"

removeHost() {
    if [ -n "$(grep -p "[[:space:]]$1" /etc/hosts)" ]; then
        echo "$1 found in $hostsFile. Removing now...";
        try sudo sed -ie "/[[:space:]]$1/d" "$hostsFile";
    else
        yell "$1 was not found in $hostsFile";
    fi
}

addHost() {
    if [ -n "$(grep -p "[[:space:]]$1" /etc/hosts)" ]; then
        yell "$1, already exists: $(grep $1 $hostsFile)";
    else
        echo "Adding $1 to $hostsFile...";
        try printf "%s\t%s\n" "$ip" "$1" | sudo tee -a "$hostsFile" > /dev/null;

        if [ -n "$(grep $1 /etc/hosts)" ]; then
            echo "$1 was added succesfully:";
            echo "$(grep $1 /etc/hosts)";
        else
            die "Failed to add $1";
        fi
    fi
}

while true; do
    echo "Do you wish to init the FoodMeUp SF4 Test project?";
    read -p "(Y/N) " yn
    case $yn in
        [Yy]* )
        echo "";

        echo -e "${BLUE}Setting local host names...${NC}";
        IFS=', '; array=($hostnames)
        for host in ${array[@]}; do addHost $host; done
        echo -e "${GREEN}Host names set!${NC}";
        echo "";

        echo -e "${BLUE}Building web Docker containers, please wait...${NC}";
        docker-compose up -d;
        echo -e "${GREEN}Docker containers built!${NC}";
        echo "";

        echo -e "${BLUE}Initializing the application, please wait...${NC}";
        # cp build.properties.dist build.properties
        # docker exec -ti moneytrack-demo-php /var/www/vendor/bin/phing init
        echo -e "${GREEN}Application initialized!${NC}";
        echo "";
        echo -e "${GREEN}[ALL DONE]${NC}";
        break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes or no.";;
    esac
done
echo -e "${GREEN}Project successfully installed${NC}";

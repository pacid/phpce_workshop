# PHPCE 2017 
SYMFONY3 + ELASTICSEARCH WORKSHOP

# SETUP (Mac)
1. Install Docker for Mac (https://docs.docker.com/docker-for-mac/install/) stable or edge max version 17.09.0-ce-mac34 (19605). Version 10.19.0-ce-mac36 should work with docker-sync 0.5.0-beta1 but it was not tested for this workshops.
2. Install docker-sync (https://github.com/EugenMayer/docker-sync/wiki/docker-sync-on-OSX)
3. cd into workshopProjectFiles && **make mac**
4. add **127.0.0.1 phpce_elasticsearch.loc** into **/etc/hosts**
5. Verify: http://phpce_elasticsearch.loc:8089/app_dev.php
6. To attach into container: **make exec**

# SETUP (Linux)
1. Install Docker - https://docs.docker.com/engine/installation/
2. Install docker-compose https://docs.docker.com/compose/install/#master-builds
3. Check Docker version: docker -v (Suggested: **17.x.x**)
4. Check Docker compose version: docker-compose -v  (Suggested: **1.1x.x**)
5. GIT - https://git-scm.com/book/en/v2/Getting-Started-Installing-Git
5. git clone git@github.com:espeo/phpce_workshop.git
6. In console execute command: **sudo sysctl -w vm.max_map_count=262144**
7. In terminal go to your workshopProjectFiles && **make linux**
8. In new terminal go to your workshopProjectFiles && **make exec**
9. Add **127.0.0.1 phpce_elasticsearch.loc** into **/etc/hosts**
10. Verify: http://phpce_elasticsearch.loc:8089/app_dev.php

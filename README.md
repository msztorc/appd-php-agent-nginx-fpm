# appd-php-agent-nginx-fpm
Appdynamics php-agent &amp; Nginx &amp; php-fpm


A custom Docker image will be built based on: `php:8.0.11-fpm` with preinstalled php-agent 
([Dockerfile](https://github.com/msztorc/appd-php-agent-apache-fpm/blob/master/docker/php-fpm/Dockerfile))
 

**.env file**
```ini
AGENT_PATH=/opt/appdynamics/php-agent
AGENT_VERSION=22.3.0.501
AGENT_LOGS_LEVEL=trace

APPDYNAMICS_AGENT_APPLICATION_NAME=<APPLICATION-NAME-HERE>
APPDYNAMICS_AGENT_TIER_NAME=<TIER-NAME-HERE>
APPDYNAMICS_AGENT_NODE_NAME=<NODE-NAME-HERE>

APPDYNAMICS_AGENT_ACCOUNT_NAME=<ACCOUNT-NAME-HERE>
APPDYNAMICS_AGENT_ACCOUNT_ACCESS_KEY=<ACCOUNT-ACCESS-KEY-HERE>
APPDYNAMICS_CONTROLLER_HOST_NAME=<HOST-NAME-HERE>
APPDYNAMICS_CONTROLLER_PORT=443
APPDYNAMICS_CONTROLLER_SSL_ENABLED=true

APPDYNAMICS_HTTP_PROXY_HOST=
APPDYNAMICS_HTTP_PROXY_PORT=
APPDYNAMICS_HTTP_PROXY_USER=
APPDYNAMICS_HTTP_PROXY_PASSWORD_FILE=
```

### Build & Run

```bash
docker-compose up --build -d
```

**Browse**

http://127.0.0.1:8181/index.php


**phpinfo**

http://127.0.0.1:8181/phpinfo.php

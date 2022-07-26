FROM ubuntu:20.04 AS appd-downloader

ARG AGENT_PATH
ARG AGENT_VERSION
ARG AGENT_LOGS_LEVEL


RUN apt-get update -y && \
    apt-get install -y curl bzip2 tar

# download agent
RUN mkdir -p ${AGENT_PATH} && \
    cd ${AGENT_PATH} && \
    curl -OL https://download-files.appdynamics.com/download-file/php-tar/${AGENT_VERSION}/appdynamics-php-agent-x64-linux-${AGENT_VERSION}.tar.bz2 && \
    tar -xf ${AGENT_PATH}/appdynamics-php-agent-x64-linux-${AGENT_VERSION}.tar.bz2 -C ${AGENT_PATH} && \
    rm ${AGENT_PATH}/appdynamics-php-agent-x64-linux-${AGENT_VERSION}.tar.bz2


FROM php:8.0.11-fpm as appd-php-fpm

LABEL org.opencontainers.image.authors="miroslaw@sztorc.com"

ARG AGENT_PATH
ARG AGENT_VERSION
ARG AGENT_LOGS_LEVEL

ARG APPDYNAMICS_AGENT_ACCOUNT_NAME
ARG APPDYNAMICS_AGENT_ACCOUNT_ACCESS_KEY
ARG APPDYNAMICS_CONTROLLER_HOST_NAME
ARG APPDYNAMICS_CONTROLLER_PORT
ARG APPDYNAMICS_CONTROLLER_SSL_ENABLED
ARG APPDYNAMICS_AGENT_APPLICATION_NAME
ARG APPDYNAMICS_AGENT_TIER_NAME
ARG APPDYNAMICS_AGENT_NODE_NAME

ARG APPDYNAMICS_HTTP_PROXY_HOST
ARG APPDYNAMICS_HTTP_PROXY_PORT
ARG APPDYNAMICS_HTTP_PROXY_USER
ARG APPDYNAMICS_HTTP_PROXY_PASSWORD_FILE
ARG AGENT_LOGS_PATH

ENV PHP_AGENT_DIR=${AGENT_PATH}
ENV PHP_AGENT_VERSION=${AGENT_VERSION}
ENV AGENT_LOGS_LEVEL=${AGENT_LOGS_LEVEL}


RUN apt-get update -y && \
    apt-get install -y procps

# PHP Agent installation (https://docs.appdynamics.com/22.3/en/application-monitoring/install-app-server-agents/php-agent/install-the-php-agent/install-the-php-agent-by-shell-script)
RUN mkdir -p ${PHP_AGENT_DIR}
COPY --from=0 ${AGENT_PATH}/ ${PHP_AGENT_DIR}/

WORKDIR ${PHP_AGENT_DIR}

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

ADD ./docker/php-fpm/agent-install.sh /agent-install.sh

# Install & instrument AppDynamics PHP Agent
RUN sh /agent-install.sh

# copy logger config file (trace logs enabled)
RUN sed -i '/priority\svalue=/s/".*"/"'"${AGENT_LOGS_LEVEL}"'"/' ${PHP_AGENT_DIR}/appdynamics-php-agent-linux_x64/php/conf/appdynamics_agent_log4cxx.xml
# COPY ./appdynamics_agent_log4cxx.xml ${PHP_AGENT_DIR}/appdynamics-php-agent-linux_x64/php/conf/appdynamics_agent_log4cxx.xml


CMD ["php-fpm"]

FROM ubuntu:22.04


# setup environment
ENV DEBIAN_FRONTEND     noninteractive
ENV DIR_DEPLOY          /deploy/
ENV DIR_SOURCE          /source/


# setup default build arguments
ARG GROUP_ID=1000
ARG USER_ID=1000
ARG USER_NAME=builduser


# prerequisites
RUN apt-get -qq update && \
    apt-get -qq dist-upgrade && \
    # install dependencies
    apt-get install -qq -y --no-install-recommends \
        php build-essential curl ca-certificates npm \
    && apt-get autoremove -y \
    && apt-get clean -y \
    && rm -rf /var/lib/apt/lists/*


# create group and user, user will be set after copying files
RUN groupadd -g ${GROUP_ID} ${USER_NAME} && \
    useradd -u ${USER_ID} -g ${GROUP_ID} -m -s /bin/bash ${USER_NAME}


# create volume mounts
RUN mkdir -p ${DIR_DEPLOY} && \
    chown -R ${USER_NAME}:${USER_NAME} ${DIR_DEPLOY} && \
    mkdir -p ${DIR_SOURCE} && \
    chown -R ${USER_NAME}:${USER_NAME} ${DIR_SOURCE}


# switch USER all commands using RUN will be executed as user
USER ${USER_NAME}


RUN curl https://sh.rustup.rs -sSf | bash -s -- -y \
    && echo 'source $HOME/.cargo/env' >> $HOME/.bashrc \
    && echo $HOME


# set working directory
WORKDIR ${DIR_SOURCE}


# execute
ENTRYPOINT ["./entrypoint.sh"]
CMD ["help"]

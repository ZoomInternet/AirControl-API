FROM python:2.7.15-alpine3.7
MAINTAINER Martin Dulin <martin@zoom-internet.co.uk>

RUN apk add --no-cache -t .build-deps mariadb-dev gcc libc-dev \
    && apk add --no-cache -t .runtime-deps mariadb-client-libs

COPY synchronize requirements.txt /opt/aircontrol/
COPY lib /opt/aircontrol/lib/
WORKDIR /opt/aircontrol/
RUN pip install -r requirements.txt
RUN apk del .build-deps \
    && rm -f /usr/lib/libmysqld.a
CMD ./synchronize

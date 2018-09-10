# py-aircontrol
Command line utility for aircontrol automation

#### Docker
```bash
docker build -t aircontrol_zoom .
```

#### Install
```bash
mkdir -p /etc/aircontrol && cp config/config.yml /etc/aircontrol/
# and adjust configuration file
```

#### Cron Jobs
```bash
# aircontrol
0 */1     * * *   root    docker run -i --rm -v /etc/aircontrol:/opt/aircontrol/config aircontrol_zoom:latest ./synchronize sync > /dev/null 2>&1
```

#### Development
```bash
docker run -it --rm -v $(pwd)/config:/opt/aircontrol/config aircontrol_zoom:latest ./synchronize sync
```
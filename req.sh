#!/bin/bash
# use for development to keep required packages
pip freeze > requirements.txt
# install packages
sudo apt-get install python-pip python-dev libmysqlclient-dev
# installing requirements
pip install -r requirements.txt

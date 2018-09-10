#!/usr/bin/env python
# -*- coding: utf-8 -*-
# -*- mode: python -*-

import requests
import time
import json

class AirControlAPI():
    def __init__(self, config_manager):
        self.ac_config = config_manager.get_config('aircontrol')
        self.devices_config = config_manager.get_config('devices')
        self.ac_ip_address = self.ac_config['host']
        self.headers = {'Content-type': 'application/json;charset=UTF-8'}
        self.url = 'https://' + self.ac_ip_address + ':9082/api/v1'
        self.cookie_jar = requests.cookies.RequestsCookieJar()
        self.session = requests.Session()
        self.session.verify = False

    def login(self):
        data = {'eulaAccepted': 'true', 'password': self.ac_config['password'], 'username': self.ac_config['user']}
        self.session.post(self.url + '/login', cookies=self.cookie_jar, json=data, headers=self.headers)

    def get_firmwares(self):
        req = self.session.get(self.url + '/firmwares', cookies=self.cookie_jar)
        print(req.request.body)
        print(req.request.headers)
        print(req.content)
        print(req.status_code)
        print(req)

    def add_device(self, ip_address):
        args = {
            'parentId': '2',
            'description': '',
            'httpPort': self.devices_config['https_port'],
            'ip': ip_address,
            'overriddenServerAddress': {
                'port': self.ac_config['inform_port'],
                'ip': self.ac_ip_address,
            },
            'rememberSshSettings': 'true',
            'sessionId': int(time.time()),
            'sshPassword': self.devices_config['password'],
            'sshPort': self.devices_config['ssh_port'],
            'sshUserName': self.devices_config['login'],
            'type': 'ubnt',
            'uplinkType': 0,
            'useHttps': 'true',
        }
        data = {'args': args, 'name': 'add_device_manually'}
        self.session.post(self.url + '/tasks', cookies=self.cookie_jar, json=data, headers=self.headers)

    def get_devices(self):
        req = self.session.get(self.url + '/devices', cookies=self.cookie_jar)
        return req.content

    def start_monitoring(self, device_id):
        data = {"name": "start_monitoring", "args": {"sessionId": 0, "device_ids": [device_id]}}
        self.session.post(self.url + '/tasks', cookies=self.cookie_jar, json=data, headers=self.headers)

    def reconnect_device(self, devices_ids):
        data = {"name": "reconnect", "args": {"sessionId": 0, "device_ids": devices_ids}}
        self.session.post(self.url + '/tasks', cookies=self.cookie_jar, json=data, headers=self.headers)

    def get_session_id(self):
        self.session.get(self.url + '/users/session-user', cookies=self.cookie_jar)


    def scan_network(self):
        self.get_session_id()
        options = {
            "resolve_topology": "true",
            "monitor_devices": "true",
            "descend_gateways": "false",
            "branch_id": "null"
        }
        args = {
            "sessionId": "1342164522",
            "ip_range": "10.10.0.0/22,",
            "root_id": 0,
            "options": options,
            "scanType": 1
        }
        data = {"name": "discovery", "args": args}
        self.session.post(self.url + '/tasks', cookies=self.cookie_jar, json=data, headers=self.headers)


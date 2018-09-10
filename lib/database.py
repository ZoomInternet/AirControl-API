#!/usr/bin/env python
# -*- coding: utf-8 -*-
# -*- mode: python -*-

import MySQLdb


class Database():
    def __init__(self, config_manager):
        config = config_manager.get_config('database')
        self.db = MySQLdb.connect(config['host'], config['user'], config['password'], config['name'])

    def get_devices(self):
        query = self.db.cursor()
        query.execute("SELECT dev_ip FROM devices WHERE status = 1")
        return query.fetchall()

#!/bin/bash

printf "{\"username\":\"%s\"}" "$1" | base64

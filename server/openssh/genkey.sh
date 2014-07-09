#!/bin/sh
. ./config.sh
ssh-keygen -b $KEY_SIZE  -C "Generated for vpn-ssh-gateway" -t $KEY_ALGO -f ~/projet/vpn-ssh-gateway/server/openssh/temporary_key -P ""

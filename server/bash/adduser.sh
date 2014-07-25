#!/bin/sh 
VPNUSERNAME=$1
SCRIPTPATH=$(dirname $(readlink -f $0))
echo "Repertoire courant $SCRIPTPATH"
. "$SCRIPTPATH/config.sh"
echo "HOME_ROOT=$HOME_ROOT"
useradd --create-home --base-dir $HOME_ROOT -c "automatically generated user " --no-user-group --skel "$ROOT_DIRECTORY/server/bash/skel" $VPNUSERNAME


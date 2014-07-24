#!/bin/sh
echo "Killing processes owned by $1..."
pgrep -U $1 | xargs kill -9

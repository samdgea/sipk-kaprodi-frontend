#!/bin/sh
if [ -n "$DYNO" ]  && [ -n "$ENV" ]; then
    php yii cache/flush-all
    php yii cache/flush-schema --interactive=0
fi
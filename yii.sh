#!/bin/sh
export DATABASE_URL="postgres://postgres:password@127.0.0.1:5432/sipk_kaprodi"
# export DATABASE_URL="postgres://jbtxcnwvvdnoex:794e76f5bc17da53a890a1935332db57180a2bb1697d0ab133e4763191b7c014@ec2-50-19-95-77.compute-1.amazonaws.com:5432/dbmnk6n257mv15"
export REDIS_URL="redis://h:pf15a9084013f116ea38eb4c10ab88d3eb9ad169a1f54f88ec991e7f65fe6eed4@ec2-34-229-3-22.compute-1.amazonaws.com:21629"
export YII_ENV="dev"
export YII_DEBUG="true"
export SMTP_ENCRYPTION="tls"
export SMTP_HOST="smtp.mailtrap.io"
export SMTP_USER="b18ec3c503f4fc"
export SMTP_PASS="97dddd54b3f149"
export SMTP_PORT="2525"

php yii serve
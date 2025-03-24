#!/bin/sh

# PWD
# shellcheck disable=SC2164
# shellcheck disable=SC2034
SCRIPT_PATH=$( cd "$(dirname "$0")" ; pwd )



### Nexon

## Mabinogi
# 거대한 외침의 뿔피리 내역 조회 - 1,440 x 4 = 5,760
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli horn-bugle-world-history &
# 경매장 거래 내역 조회 - 1,440 x 5 = 7,200
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction history &
# 오래된 데이터 자동 삭제
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli delete &


## Mabinogi Heroes
# 명예의 전당 랭킹 정보 조회 - 1
php "$SCRIPT_PATH"/public/index.php nexon mabinogi-heroes cli ranking hall-of-honor &
# 실시간 랭킹 정보 조회 - 24 x 2 = 48
php "$SCRIPT_PATH"/public/index.php nexon mabinogi-heroes cli ranking real-time &
# 최근 1주간 골드 판매량 정보 조회 - 2
php "$SCRIPT_PATH"/public/index.php nexon mabinogi-heroes cli marketplace gold-top &

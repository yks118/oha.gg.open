#!/bin/sh

# PWD
# shellcheck disable=SC2164
# shellcheck disable=SC2034
SCRIPT_PATH=$( cd "$(dirname "$0")" ; pwd )



### Nexon

## Mabinogi
# NPC 상점 조회 - 40 x 2,058 = 82,320
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli npc-shop-list %EB%A5%98%ED%8A%B8 &
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli npc-shop-list %EB%A7%8C%EB%8F%8C%EB%A6%B0 &
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli npc-shop-list %ED%95%98%ED%94%84 &
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli npc-shop-list %EC%9A%B8%ED%94%84 &
# 거대한 외침의 뿔피리 내역 조회 - 1,440 x 4 = 5,760
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli horn-bugle-world-history &
# 경매장 등록 상품 - 1,440 x 6 = 8,640
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list &
(sleep 10 && php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list)&
(sleep 20 && php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list)&
(sleep 30 && php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list)&
(sleep 40 && php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list)&
(sleep 50 && php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction list)&
# 경매장 거래 내역 조회 - 1,440 x 5 = 7,200
php "$SCRIPT_PATH"/public/index.php nexon mabinogi cli auction history &

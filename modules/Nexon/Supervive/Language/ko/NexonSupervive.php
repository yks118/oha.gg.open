<?php

return [
    // match
    'queue_id'  => [
        'DEFAULT'       => '스쿼드',
        'DUOS'          => '듀오',
    ],
    'hunter_name'       => '헌터 이름',
    'stormshift'        => '이상현상',
    'rank_mode_flag'    => '랭크 게임 여부',
    'date_match_start'  => '매치 시작 시간',
    'date_match_end'    => '매치 종료 시간',
    'team'              => [
        'placement'         => '팀 최종 등수',
        'survival_duration' => '탈락 때까지 살아있던 시간',
    ],
    'personal_stat'     => [
        'kill'                          => '킬 수',
        'death'                         => '데스 수',
        'assist'                        => '어시스트 수',
        'knock_out'                     => '기절시킨 횟수',
        'knocked_out'                   => '기절당한 횟수',
        'resurrect_count'               => '죽은 아군을 부활시킨 횟수',
        'resurrected_count'             => '죽은 상태에서 아군에 의해 부활한 횟수',
        'recover_count'                 => '위습 상태의 아군을 소생시킨 횟수',
        'recovered_count'               => '위습 상태에서 아군에 의해 소생된 횟수',
        'creep_kill_count'              => '크립 처치 수',
        'gold_from_creeps'              => '크립에게서 벌어들인 골드',
        'gold_from_enemy'               => '적에게서 벌어들인 골드',
        'damage_dealt_total'            => '가한 데미지',
        'damage_dealt_enemy'            => '적 헌터에게 가한 데미지',
        'damage_taken_total'            => '받은 데미지',
        'damage_taken_enemy'            => '적 헌터에게서 받은 데미지',
        'effective_damage_dealt_total'  => '가한 데미지 (초과 피해량 미포함)',
        'effective_damage_dealt_enemy'  => '적 헌터에게 가한 데미지 (초과 피해량 미포함)',
        'effective_damage_taken_total'  => '받은 데미지 (초과 피해량 미포함)',
        'effective_damage_taken_enemy'  => '적 헌터에게서 받은 데미지 (초과 피해량 미포함)',
        'heal_given'                    => '제공한 힐량',
        'heal_given_self'               => '스스로 제공한 힐량',
        'heal_received'                 => '제공받은 힐량',
    ],
];

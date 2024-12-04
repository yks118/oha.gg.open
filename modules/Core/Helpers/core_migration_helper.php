<?php

if (! function_usable('core_migration_check'))
{
    function core_migration_check(string $nameSpace = '', string $group = null): bool
    {
        $sMigrations = \Config\Services::migrations();
        $sMigrations->setNameSpace($nameSpace);

        $migrations = $sMigrations->findMigrations();
        foreach($sMigrations->getHistory((string) $group) as $history)
        {
            unset($migrations[$sMigrations->getObjectUid($history)]);
        }

        return !empty($migrations);
    }
}

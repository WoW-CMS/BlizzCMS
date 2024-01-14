<?php
/**
 * BlizzCMS
 *
 * @author WoW-CMS
 * @copyright Copyright (c) 2019 - 2023, WoW-CMS (https://wow-cms.com)
 * @license https://opensource.org/licenses/MIT MIT License
 */
defined('BASEPATH') OR exit('No direct script access allowed');

if (! function_exists('add_foreign_key'))
{
    /**
     * Create a SQL query to add foreign key
     *
     * @param string $table
     * @param string $key
     * @param string $reference_table
     * @param string $reference_column
     * @param string $on_delete
     * @param string $on_update
     * @return string
     */
    function add_foreign_key($table, $key, $reference_table, $reference_column, $on_delete = 'RESTRICT', $on_update = 'RESTRICT')
    {
        return "ALTER TABLE `{$table}` ADD CONSTRAINT `{$table}_{$key}_fk` FOREIGN KEY (`{$key}`) REFERENCES `{$reference_table}`(`{$reference_column}`) ON DELETE {$on_delete} ON UPDATE {$on_update}";
    }
}

if (! function_exists('drop_foreign_key'))
{
    /**
     * Create a SQL query to drop foreign key
     *
     * @param string $table
     * @param string $key
     * @return string
     */
    function drop_foreign_key($table, $key)
    {
        return "ALTER TABLE `{$table}` DROP FOREIGN KEY `{$table}_{$key}_fk`";
    }
}

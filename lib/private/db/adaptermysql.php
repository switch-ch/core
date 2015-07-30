<?php
/**
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Robin Appelman <icewind@owncloud.com>
 *
 * @copyright Copyright (c) 2015, ownCloud, Inc.
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program.  If not, see <http://www.gnu.org/licenses/>
 *
 */


namespace OC\DB;

class AdapterMySQL extends Adapter {
	public function fixupStatement($statement) {
		$characterSet = \OC::$server->getConfig()->getSystemValue('mysql.utf8mb4', false) ? 'utf8mb4' : 'utf8';
		$statement = str_replace(' ILIKE ', ' COLLATE ' . $characterSet . '_general_ci LIKE ', $statement);
		return $statement;
	}
}

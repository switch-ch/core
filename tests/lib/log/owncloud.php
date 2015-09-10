<?php
/**
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU AFFERO GENERAL PUBLIC LICENSE
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU AFFERO GENERAL PUBLIC LICENSE for more details.
 *
 * You should have received a copy of the GNU Affero General Public
 * License along with this library.  If not, see <http://www.gnu.org/licenses/>.
 */

class Test_Log_Owncloud extends \PHPUnit_Framework_TestCase
{

	public function setUp() {
		OC_Config::setValue("logfile", OC_Config::getValue('datadirectory') . "/logtest");
		OC_Log_Owncloud::init();
	}
	public function tearDown() {
		OC_Config::setValue("logfile", null);
		OC_Log_Owncloud::init();
	}
	public function testMicrosecondsLogTimestamp() {
		# delete old logfile
		unlink(OC_Config::getValue('logfile'));

		# set format & write log line
		OC_Config::setValue('logdateformat', 'u');
		OC_Log_Owncloud::write('test', 'message', OC_Log::ERROR);
		
		# read log line
		$handle = @fopen(OC_Config::getValue('logfile'), 'r');
		$line = fread($handle, 1000);
		fclose($handle);
		
		# check timestamp has microseconds part
		$values = (array) json_decode($line);
		$microseconds = $values['time'];
		$this->assertNotEquals(0, $microseconds);
		
	}


}

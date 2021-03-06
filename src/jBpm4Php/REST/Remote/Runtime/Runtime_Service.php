<?php
/**
 * Copyright 2015 Fernando Libório
 * 
 * This file is part of jBpm4Php.
 *
 * jBpm4Php is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * jBpm4Php is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License
 * along with jBpm4Php.  If not, see <http://www.gnu.org/licenses/>. 
 */

namespace jBpm4Php\REST\Remote\Runtime;

use \jBpm4Php\Services\Abstract_Rest_Command;

/**
 * Runtime Process Calls
 *  
 * @package jBpm4Php\REST\Remote\Runtime
 * @author  Fernando Libório 
 * @license LGPL, version 3
 * @link    http://docs.jboss.com/jbpm/v6.2/userguide/jBPMRemoteAPI.html jBPM REST Call documentation
 * @link    https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote All objects returned are described on the Kie Remote API (Java)
 */
class Runtime_Service extends Abstract_Rest_Command
{
    /**
     * Starts a process and retrieves the list of variables associated with the process instance.
     * 
     * @access public
     * @param  string $process_def_id 
     * @param  array  $map 
     * @return object A JaxbProcessInstanceWithVariablesResponse
     */
    public function start_process($process_def_id, $map = NULL)
    {
    	$url = sprintf("%s/runtime/%s/withvars/process/%s/start", 
    		$this->engine->url,
    		$this->engine->deployment_id,
    		$process_def_id
    	);

        return json_decode($this->execute($url, TRUE, $map));
    }

    /**
     * Does a (read only) retrieval of the process instance. This operation will fail (code 400) if the 
     * process instance has been completed.
     * 
     * @access public
     * @param  long   $process_id 
     * @return object A JaxbProcessInstanceWithVariablesResponse
     */
    public function get_process_instance($process_id)
    {
    	$url = sprintf("%s/runtime/%s/withvars/process/instance/%d", 
    		$this->engine->url,
    		$this->engine->deployment_id, $process_id
    	);
    	
    	return json_decode($this->execute($url, FALSE));
    }

    /**
     * Aborts the process instance.
     * 
     * @access public
     * @param  long   $process_id 
     * @return object A JaxbGenericResponse indicating whether or not the operation has succeeded
     */
    public function abort_process($process_id)
    {
    	$url = sprintf("%s/runtime/%s/process/instance/%d/abort", 
    		$this->engine->url,
    		$this->engine->deployment_id, $process_id
    	);

    	return json_decode($this->execute($url, TRUE));
    }

    /**
     * Signals the process instance.
     * 
     * @param  long   $process_id 
     * @param  array  $map 
     * @return object A JaxbGenericResponse indicating whether or not the operation has succeeded.
     */
    public function signal($process_id, $map)
    {
    	$url = sprintf("%s/runtime/%s/process/instance/%d/signal", 
    		$this->engine->url,
    		$this->engine->deployment_id, $process_id
    	);

    	return json_decode($this->execute($url, TRUE, $map));
    }
}
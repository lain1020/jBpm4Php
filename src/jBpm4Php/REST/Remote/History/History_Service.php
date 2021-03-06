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

namespace jBpm4Php\REST\Remote\History;

use \jBpm4Php\Services\Abstract_Rest_Command;

/**
 * Runtime History Calls
 *  
 * @package jBpm4Php\REST\Remote\History
 * @author  Fernando Libório 
 * @license LGPL, version 3
 * @link    http://docs.jboss.com/jbpm/v6.2/userguide/jBPMRemoteAPI.html jBPM REST Call documentation
 * @link    https://github.com/droolsjbpm/droolsjbpm-integration/tree/6.2.x/kie-remote All objects returned are described on the Kie Remote API (Java)
 */
class History_Service extends Abstract_Rest_Command
{
    /**
     * Cleans (deletes) all history logs.
     * 
     * @access public
     */
    public function clear()
    {
    	$url = sprintf("%s/history/clear", $this->engine->url);

        return json_decode($this->execute($url, TRUE));
    }

    /**
     * Gets a list of ProcessInstanceLog instances.
     * 
     * @access public
     * @return object A JaxbHistoryLogList
     */
    public function get_processes()
    {
        $url = sprintf("%s/history/instances", $this->engine->url);

        return json_decode($this->execute($url, FALSE));
    }

    /**
     * Gets the ProcessInstanceLog instance associated with the specified process instance.
     * 
     * @access public
     * @param  long   $process_id
     * @return object A JaxbHistoryLogList
     */
    public function get_process($process_id)
    {
        $url = sprintf("%s/history/instance/%s", 
            $this->engine->url, 
            $process_id
        );

        return json_decode($this->execute($url, FALSE));
    }

    /**
     * Gets a list of ProcessInstanceLog instances associated with any child/sub-processes associated with 
     * the specified process instance.
     * 
     * @access public
     * @param  long   $process_id
     * @return object A JaxbHistoryLogList
     */
    public function get_childs($process_id)
    {
        $url = sprintf("%s/history/instance/%s/child", 
            $this->engine->url, 
            $process_id
        );

        return json_decode($this->execute($url, FALSE));
    }

    /**
     * Gets a list of VariableInstanceLog instances associated with the specified process instance.
     * 
     * @access public
     * @param  long   $process_id
     * @return object A JaxbHistoryLogList
     */
    public function get_variables($process_id)
    {
        $url = sprintf("%s/history/instance/%s/variable", 
            $this->engine->url, 
            $process_id
        );

        return json_decode($this->execute($url, FALSE));
    }
}
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

namespace jBpm4Php\Services;

/**
 * Rest Command Interface
 *  
 * @package jBpm4Php\Services
 * @author  Fernando Libório 
 * @license LGPL, version 3
 * @link    http://docs.jboss.com/jbpm/v6.2/userguide/jBPMRemoteAPI.html jBPM REST Call documentation
 */
Interface Rest_Command_Interface
{
    /**
     * Makes REST calls to the execution server. All calls are described on the jBPM REST Call documentation.
     * 
     * @access public
     * @param  string $url 
     * @param  boolean $do_post 
     * @param  array $map
     * @param  string $xml_body
     * @return string A JSON or XML response
     */
    public function execute($url, $do_post = TRUE, $map = NULL, $xml_body = NULL);
}
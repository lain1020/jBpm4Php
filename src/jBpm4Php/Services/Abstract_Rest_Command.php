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

abstract class Abstract_Rest_Command implements Rest_Command_Interface
{
    private $engine;
    
    /**
     * Constructor 
     * @access public
     * @param Runtime_Engine $engine
     */
    public function __construct(Runtime_Engine $engine)
    {
        $this->engine = $engine;
    }

    /**
     * Getter
     * @access public
     * @param string $name 
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;
    }

    /**
     * Makes REST calls to the execution server. All calls are described on the documentation.
     * @link http://docs.jboss.com/jbpm/v6.2/userguide/jBPMRemoteAPI.html Documentation
     * @access public
     * @param string $url 
     * @param boolean $do_post 
     * @param array $map
     * @param string $xml_body
     * @return A JSON response
     */
    public function execute($url, $do_post = TRUE, $map = NULL, $xml_body = NULL)
    {
        $context = curl_init();

        $use_prefix = (strpos($url, 'query')) ? FALSE : TRUE;

        $url.= $this->parse_query_map_parameters($map, $use_prefix);
        
        curl_setopt($context, CURLOPT_URL, $url);
        curl_setopt($context, CURLOPT_USERPWD, sprintf("%s:%s", $this->engine->username, $this->engine->password));
        curl_setopt($context, CURLOPT_FAILONERROR, TRUE);
        curl_setopt($context, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($context, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($context, CURLOPT_POST, $do_post);
        curl_setopt($context, CURLOPT_TIMEOUT, 999);

        if (! is_null($xml_body)) {
            curl_setopt($context, CURLOPT_POSTFIELDS, $xml_body);
            curl_setopt($context, CURLOPT_HTTPHEADER, array('Content-type: text/xml'));
        } else {
            curl_setopt($context, CURLOPT_HTTPHEADER, array('ACCEPT: application/json'));
        }

        $response = curl_exec($context);
        curl_close($context);

        return $response;
    }

    /**
     * Convert map associative array into query map parameters.
     * @access private
     * @param array $map 
     * @return Query map parameters
     */
    private function parse_query_map_parameters($map, $with_prefix = TRUE)
    {
        $query_map = "";

        if (is_array($map)) {

            foreach ($map as $key => $value) {
                $query_map.= sprintf("%s=%s&", $key, $value);
            }

            $query_map = preg_replace("/&$/", "", $query_map);
            $query_map = ($with_prefix === TRUE) ? sprintf("?map_%s", $query_map) : sprintf("?%s", $query_map);
        }

        return $query_map;
    }
}
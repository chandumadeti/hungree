<?php
 use Event;

Event::listen(\App\RedisHandlers\OrderUpdatedEventHandler::EVENT, '\App\RedisHandlers\OrderUpdatedEventHandler');

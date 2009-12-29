<?php
/**
 * Copyright 2007, 2008, 2009 Yuri Timofeev tim4dev@gmail.com
 *
 * This file is part of Webacula.
 *
 * Webacula is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Webacula is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Webacula.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @author Yuri Timofeev <tim4dev@gmail.com>
 * @package webacula
 * @license http://www.gnu.org/licenses/gpl-3.0.html GNU Public License
 *
 */

/* Zend_Controller_Action */
require_once 'Zend/Controller/Action.php';

class ErrorController extends MyClass_ControllerAction
{

    public function errorAction()
    {
        $errors = $this->_getParam('error_handler');
        $exception = $errors->exception;
        $this->view->err_message = $exception->getMessage();
	    $this->view->err_trace   = $exception->getTraceAsString();

        Zend_Loader::loadClass('Zend_Version');
        $this->view->zend_version = Zend_Version::VERSION;
        $this->view->db_adapter_bacula   = Zend_Registry::get('DB_ADAPTER');
        $db = Zend_Registry::get('db_bacula');
        $this->view->db_server_version_bacula = $db->getServerVersion();

        $this->view->db_adapter_webacula = Zend_Registry::get('DB_ADAPTER_WEBACULA');
        $db_webacula = Zend_Registry::get('db_webacula');
        $this->view->db_server_version_webacula = $db_webacula->getServerVersion();

        switch ($errors->type) {
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Zend_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // ошибка 404 - не найден контроллер или действие
                $this->getResponse()
                    ->setRawHeader('HTTP/1.1 404 Not Found');
                //.получение данных для отображения...
                $this->view->err_custom_message = 'Error 404. Page Not Found.';
                break;
            default:
                // ошибка приложения; выводим страницу ошибки,
                // но не меняем код статуса
                break;
        }
    }

}
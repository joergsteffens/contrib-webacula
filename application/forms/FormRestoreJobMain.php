<?php
/**
 * Copyright 2010 Yuri Timofeev tim4dev@gmail.com
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
require_once 'Zend/Form.php';

class FormRestoreJobMain extends Zend_Form
{

	protected $translate;
	public  $elDecorators = array('ViewHelper', 'Errors'); // , 'Label'



    public function init()
    {
        Zend_Loader::loadClass('Zend_Validate_Regex');
    	// translate
    	$this->translate = Zend_Registry::get('translate');
        Zend_Form::setDefaultTranslator( Zend_Registry::get('translate') );

        $this->setMethod('post');
        $this->setDecorators(array(
            array('ViewScript', array('viewScript' => 'form-restore-job-main.phtml'))
        ));
        // TODO
    }

}

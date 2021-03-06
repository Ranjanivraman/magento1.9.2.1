<?php
{{License}}
/**
 * {{EntityLabel}} edit form
 *
 * @category	{{Namespace}}
 * @package		{{Namespace}}_{{Module}}
 * {{qwertyuiop}}
 */
class {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Edit_Form extends {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Abstract
{
	/**
	 * Additional buttons on {{entityLabel}} page
	 * @var array
	 */
	protected $_additionalButtons = array();
	/**
	 * constroctor
	 * set template
	 * @access public
	 * @return void
	 * {{qwertyuiop}}
	 */
	public function __construct(){
		parent::__construct();
		$this->setTemplate('{{namespace}}_{{module}}/{{entity}}/edit/form.phtml');
	}
	/**
	 * prepare the layout
	 * @access protected
	 * @return {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Edit_Form
	 * {{qwertyuiop}}
	 */
	protected function _prepareLayout(){
		${{entity}} = $this->get{{Entity}}();
		${{entity}}Id = (int)${{entity}}->getId();
		$this->setChild('tabs',
			$this->getLayout()->createBlock('{{module}}/adminhtml_{{entity}}_edit_tabs', 'tabs')
		);		
		$this->setChild('save_button',
			$this->getLayout()->createBlock('adminhtml/widget_button')
				->setData(array(
					'label' => Mage::helper('{{module}}')->__('Save {{EntityLabel}}'),
					'onclick'   => "{{entity}}Submit('" . $this->getSaveUrl() . "', true)",
					'class' => 'save'
			))
		);		
		// Delete button
		if (!in_array(${{entity}}Id, $this->getRootIds())) {
			$this->setChild('delete_button',
				$this->getLayout()->createBlock('adminhtml/widget_button')
					->setData(array(
						'label' => Mage::helper('{{module}}')->__('Delete {{EntityLabel}}'),
						'onclick'   => "{{entity}}Delete('" . $this->getUrl('*/*/delete', array('_current' => true)) . "', true, {${{entity}}Id})",
						'class' => 'delete'
				))
			);
		}
		
		// Reset button
		$resetPath = ${{entity}} ? '*/*/edit' : '*/*/add';
		$this->setChild('reset_button',
			$this->getLayout()->createBlock('adminhtml/widget_button')
				->setData(array(
					'label' => Mage::helper('{{module}}')->__('Reset'),
					'onclick'   => "{{entity}}Reset('".$this->getUrl($resetPath, array('_current'=>true))."',true)"
			))
		);
		return parent::_prepareLayout();
	}
	/**
	 * get html for delete button
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getDeleteButtonHtml(){
		return $this->getChildHtml('delete_button');
	}
	/**
	 * get html for save button
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getSaveButtonHtml(){
		return $this->getChildHtml('save_button');
	}
	/**
	 * get html for reset button
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getResetButtonHtml(){
		return $this->getChildHtml('reset_button');
	}
	/**
	 * Retrieve additional buttons html
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getAdditionalButtonsHtml(){
		$html = '';
		foreach ($this->_additionalButtons as $childName) {
			$html .= $this->getChildHtml($childName);
		}
		return $html;
	}

	/**
	 * Add additional button
	 *
	 * @param string $alias
	 * @param array $config
	 * @return {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Edit_Form
	 * {{qwertyuiop}}
	 */
	public function addAdditionalButton($alias, $config){
		if (isset($config['name'])) {
			$config['element_name'] = $config['name'];
		}
		$this->setChild($alias . '_button',
		$this->getLayout()->createBlock('adminhtml/widget_button')->addData($config));
		$this->_additionalButtons[$alias] = $alias . '_button';
		return $this;
	}
	/**
	 * Remove additional button
	 * @access public
	 * @param string $alias
	 * @return {{Namespace}}_{{Module}}_Block_Adminhtml_{{Entity}}_Edit_Form
	 * {{qwertyuiop}}
	 */
	public function removeAdditionalButton($alias){
		if (isset($this->_additionalButtons[$alias])) {
			$this->unsetChild($this->_additionalButtons[$alias]);
			unset($this->_additionalButtons[$alias]);
		}
		return $this;
	}
	/**
	 * get html for tabs
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getTabsHtml(){
		return $this->getChildHtml('tabs');
	}
	/**
	 * get the form header
	 * @access public
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getHeader(){
		if ($this->get{{Entity}}Id()) {
			return $this->get{{Entity}}{{EntityNameMagicCode}}();
		} 
		else {
			return Mage::helper('{{module}}')->__('New Root {{EntityLabel}}');
		}
	}
	/**
	 * get the delete url
	 * @access public
	 * @param array $args
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getDeleteUrl(array $args = array()){
		$params = array('_current'=>true);
		$params = array_merge($params, $args);
		return $this->getUrl('*/*/delete', $params);
	}
	/**
	 * Return URL for refresh input element 'path' in form
	 * @access public
	 * @param array $args
	 * @return string
	 * {{qwertyuiop}}
	 */
	public function getRefreshPathUrl(array $args = array()){
		$params = array('_current'=>true);
		$params = array_merge($params, $args);
		return $this->getUrl('*/*/refreshPath', $params);
	}
	/**
	 * check if request is ajax
	 * @access public
	 * @return bool
	 * {{qwertyuiop}}
	 */
	public function isAjax(){
		return Mage::app()->getRequest()->isXmlHttpRequest() || Mage::app()->getRequest()->getParam('isAjax');
	}

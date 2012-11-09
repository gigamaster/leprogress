<?php
/**
 * @file
 * @package leprogress
 * @version $Id$
**/

if(!defined('XOOPS_ROOT_PATH'))
{
	exit;
}
require_once LEPROGRESS_TRUST_PATH . '/class/Enum.class.php';

/**
 * Leprogress_AbstractAction
**/
abstract class Leprogress_AbstractAction
{
	public /*** XCube_Root ***/ $mRoot = null;

	public /*** Leprogress_Module ***/ $mModule = null;

	public /*** Leprogress_AssetManager ***/ $mAsset = null;

	/**
	 * __construct
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function __construct()
	{
		$this->mRoot =& XCube_Root::getSingleton();
		$this->mModule =& $this->mRoot->mContext->mModule;
		$this->mAsset =& $this->mModule->mAssetManager;
	}

	/**
	 * _getActionName
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getActionName()
	{
		return null;
	}

	/**
	 * _getPageTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getPagetitle()
	{
		return null;
	}

	/**
	 * getPageTitle
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	public function getPagetitle()
	{
		return Legacy_Utils::formatPagetitle($this->mRoot->mContext->mModule->mXoopsModule->get('name'), $this->_getPagetitle(), $this->_getActionName());
	}

	/**
	 * _getStylesheet
	 * 
	 * @param	void
	 * 
	 * @return	String
	**/
	protected function _getStylesheet()
	{
		return $this->mRoot->mContext->mModuleConfig['css_file'];
	}

	/**
	 * setHeaderScript
	 * 
	 * @param	void
	 * 
	 * @return	void
	**/
	public function setHeaderScript()
	{
		$headerScript = $this->mRoot->mContext->getAttribute('headerScript');
		$headerScript->addStylesheet($this->_getStylesheet());
	}


	/**
	 * prepare
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function prepare()
	{
		return true;
	}

	/**
	 * hasPermission
	 * 
	 * @param	void
	 * 
	 * @return	bool
	**/
	public function hasPermission()
	{
		return true;
	}

	/**
	 * getDefaultView
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function getDefaultView()
	{
		return LEPROGRESS_FRAME_VIEW_NONE;
	}

	/**
	 * execute
	 * 
	 * @param	void
	 * 
	 * @return	Enum
	**/
	public function execute()
	{
		return LEPROGRESS_FRAME_VIEW_NONE;
	}

	/**
	 * executeViewSuccess
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewSuccess(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewError
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewError(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewIndex
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewIndex(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewInput
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewInput(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewPreview
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewPreview(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * executeViewCancel
	 * 
	 * @param	XCube_RenderTarget	&$render
	 * 
	 * @return	void
	**/
	public function executeViewCancel(/*** XCube_RenderTarget ***/ &$render)
	{
	}

	/**
	 * _getNextUri
	 * 
	 * @param	void
	 * 
	 * @return	string
	**/
	protected function _getNextUri($tableName, $actionName=null)
	{
		$handler = $this->_getHandler();
		if($this->mObject->get($handler->mPrimary)>0){
			return Legacy_Utils::renderUri($this->mAsset->mDirname, $tableName, $this->mObject->get($handler->mPrimary), $actionName);
		}
		else{
			return Legacy_Utils::renderUri($this->mAsset->mDirname, $tableName, 0, $actionName);
		}
	}
}

?>

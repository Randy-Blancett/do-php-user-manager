Ext.Loader.setConfig(
{
	enabled : true
});
Ext.Loader.setPath("darkowl.desktop", '../js/desktop', "js");
Ext.Loader.setPath("DarkOwl.User_Manager", '../js/user_manager', "php");
// Ext.Loader.setPath("plugin",'JS/plugin',"php");
Ext.Loader.setPath("Ext", g_obj_Config.m_str_ExtJs4Path + '/src', "js");

Ext.require('Ext.tip.QuickTipManager');

// Ext.require("DarkOwl.User_Manager.cUserManager_App",null,null,null,"php");
Ext.onReady(Setup);

function Setup()
{
	Ext.tip.QuickTipManager.init();
	m_obj_UserManager_App = Ext.create('darkowl.desktop.cApplication',
	{
		renderTo : Ext.getBody()
	});
}